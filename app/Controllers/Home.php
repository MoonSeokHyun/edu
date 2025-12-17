<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // SEO 변수 설정
        $data = [
            'seoTitle' => '에듀허브 - 어린이집, 유치원, 초등학교 정보 검색 서비스',
            'seoDescription' => '에듀허브는 어린이집, 유치원, 초등학교에 대한 신뢰할 수 있는 공공데이터를 무료로 제공합니다. 위치, 연락처, 운영 상태 등 상세한 교육기관 정보를 한눈에 확인하세요.',
            'seoKeywords' => '에듀허브, 어린이집, 유치원, 초등학교, 교육기관, 공공데이터, 어린이집 정보, 유치원 정보, 초등학교 정보, 교육기관 검색',
            'jsonLd' => [
                "@context" => "https://schema.org",
                "@type" => "WebSite",
                "name" => "에듀허브",
                "alternateName" => "Eduhub",
                "url" => base_url(),
                "description" => "어린이집, 유치원, 초등학교 정보를 제공하는 교육기관 검색 서비스",
                "potentialAction" => [
                    "@type" => "SearchAction",
                    "target" => base_url('daycare') . "?search={search_term_string}",
                    "query-input" => "required name=search_term_string"
                ],
                "publisher" => [
                    "@type" => "Organization",
                    "name" => "문딜로지스틱스",
                    "legalName" => "문딜로지스틱스 (MoonDilogistics)"
                ]
            ]
        ];
        
        return view('welcome_message', $data);
    }
}
