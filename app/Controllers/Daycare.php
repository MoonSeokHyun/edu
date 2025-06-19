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
    
        if ($search) {
            // 예: 어린이집명 또는 주소에 검색어 포함된 데이터 조회
            $model->like('Daycare_Name', $search)
                  ->orLike('Address', $search);
        }
    
        $data['daycares'] = $model->paginate(10);
        $data['pager'] = $model->pager;
        $data['search'] = $search;
    
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
