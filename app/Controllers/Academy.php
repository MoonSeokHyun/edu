<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AcademyModel;
use App\Models\NaverApiModel;

class Academy extends BaseController
{
    public function index()
    {
        $model = new AcademyModel();
    
        $search = $this->request->getGet('search');
        $page = $this->request->getGet('page') ?? 1;
    
        if ($search) {
            // 학원명 또는 주소에 검색어 포함된 데이터 조회
            $model->like('academy_name', $search)
                  ->orLike('road_address', $search)
                  ->orLike('administrative_area', $search);
        }
    
        $data['academies'] = $model->paginate(10);
        $data['pager'] = $model->pager;
        $data['search'] = $search;
        
        // SEO 변수 설정 (각 목록 페이지마다 고유한 title/description)
        $searchPart = !empty($search) ? " '{$search}' 검색 결과 - " : '';
        $pagePart = $page > 1 ? " ({$page}페이지) - " : ' - ';
        $data['seoTitle'] = "학원 목록{$searchPart}{$pagePart}에듀허브";
        $data['seoDescription'] = !empty($search) 
            ? "학원 '{$search}' 검색 결과입니다. 위치, 연락처, 교육과정, 수강료 등 상세 정보를 확인하세요."
            : "전국 학원 정보를 한눈에 확인하세요. 위치, 연락처, 교육과정, 수강료 등 상세 정보를 무료로 제공합니다.";
        $data['seoKeywords'] = !empty($search) 
            ? "{$search}, 학원, 검색, 에듀허브"
            : "학원 목록, 학원 정보, 전국 학원, 에듀허브";
    
        return view('academy/index', $data);
    }
    

    public function detail($id)
    {
        $model = new AcademyModel();
        $naverApi = new NaverApiModel();

        $academy = $model->find($id);

        if (!$academy) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("학원 정보를 찾을 수 없습니다: ID {$id}");
        }

        // 위도/경도 확인 - DB에 저장된 값이 있으면 사용, 없으면 geocoding 1회만 호출하여 저장
        $latitude = null;
        $longitude = null;
        
        // DB에 위도/경도가 이미 저장되어 있는지 확인
        if (!empty($academy['latitude']) && !empty($academy['longitude']) && 
            floatval($academy['latitude']) != 0 && floatval($academy['longitude']) != 0) {
            // DB에 저장된 값 사용
            $latitude = floatval($academy['latitude']);
            $longitude = floatval($academy['longitude']);
        } elseif (!empty($academy['road_address'])) {
            // DB에 위도/경도가 없을 때만 geocoding 호출 (1회만)
            try {
                $geocodeResult = $naverApi->map($academy['road_address']);
                if (!empty($geocodeResult['x']) && !empty($geocodeResult['y']) && 
                    floatval($geocodeResult['x']) != 0 && floatval($geocodeResult['y']) != 0) {
                    $longitude = floatval($geocodeResult['x']);
                    $latitude = floatval($geocodeResult['y']);
                    
                    // DB에 위도/경도 저장 (다음번에는 geocoding 호출 안 함)
                    try {
                        $model->update($id, [
                            'latitude' => $latitude,
                            'longitude' => $longitude
                        ]);
                    } catch (\Exception $updateException) {
                        // 컬럼이 없거나 업데이트 실패 시 로그만 남기고 계속 진행
                        log_message('warning', 'Failed to save geocoding result to DB for academy ID: ' . $id . ' - ' . $updateException->getMessage());
                    }
                }
            } catch (\Exception $e) {
                // Geocoding 실패 시 무시하고 계속 진행
                log_message('error', 'Geocoding failed for academy: ' . $academy['academy_name'] . ' - ' . $e->getMessage());
            }
        }

        // 검색 키워드는 학원 이름 기준
        $keyword = $academy['academy_name'];

        // 블로그 검색
        $blogJson = $naverApi->blog($keyword);
        $blog = !empty($blogJson) ? json_decode($blogJson, true) : ['items' => []];

        // 이미지 검색
        $imageJson = $naverApi->image($keyword);
        $images = !empty($imageJson) ? json_decode($imageJson, true) : ['items' => []];

        return view('academy/detail', [
            'academy' => $academy,
            'blog' => $blog,
            'images' => $images,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}
