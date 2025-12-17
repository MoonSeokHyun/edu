<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DaycareModel;
use App\Models\NaverApiModel;

class Daycare extends BaseController
{
    public function index()
    {
        $model = new DaycareModel();
    
        $search = $this->request->getGet('search');
        $page = $this->request->getGet('page') ?? 1;
    
        if ($search) {
            // 예: 어린이집명 또는 주소에 검색어 포함된 데이터 조회
            $model->like('Daycare_Name', $search)
                  ->orLike('Address', $search);
        }
    
        $data['daycares'] = $model->paginate(10);
        $data['pager'] = $model->pager;
        $data['search'] = $search;
        
        // SEO 변수 설정 (각 목록 페이지마다 고유한 title/description)
        $searchPart = !empty($search) ? " '{$search}' 검색 결과 - " : '';
        $pagePart = $page > 1 ? " ({$page}페이지) - " : ' - ';
        $data['seoTitle'] = "어린이집 목록{$searchPart}{$pagePart}에듀허브";
        $data['seoDescription'] = !empty($search) 
            ? "어린이집 '{$search}' 검색 결과입니다. 위치, 연락처, 운영 상태 등 상세 정보를 확인하세요."
            : "전국 어린이집 정보를 한눈에 확인하세요. 위치, 연락처, 정원, 운영 상태 등 상세 정보를 무료로 제공합니다.";
        $data['seoKeywords'] = !empty($search) 
            ? "{$search}, 어린이집, 검색, 에듀허브"
            : "어린이집 목록, 어린이집 정보, 전국 어린이집, 에듀허브";
    
        return view('daycare/index', $data);
    }
    

    public function detail($id)
    {
        $model = new DaycareModel();
        $naverApi = new NaverApiModel();

        $daycare = $model->find($id);

        if (!$daycare) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("어린이집 정보를 찾을 수 없습니다: ID {$id}");
        }

        // 검색 키워드는 어린이집 이름 기준
        $keyword = $daycare['Daycare_Name'];

        // 블로그 검색
        $blogJson = $naverApi->blog($keyword);
        $blog = !empty($blogJson) ? json_decode($blogJson, true) : ['items' => []];

        // 이미지 검색
        $imageJson = $naverApi->image($keyword);
        $images = !empty($imageJson) ? json_decode($imageJson, true) : ['items' => []];

        return view('daycare/detail', [
            'daycare' => $daycare,
            'blog' => $blog,
            'images' => $images,
        ]);
    }
}
