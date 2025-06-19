<?php

namespace App\Controllers;

use App\Models\DaycareModel;
use CodeIgniter\Controller;

class SitemapController extends Controller
{
    protected $perPage = 10000;

    // 사이트맵 인덱스 (여기선 DaycareModel만 처리)
    public function index()
    {
        helper('url');

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        $daycareModel = new DaycareModel();
        $total = $daycareModel->countAll();
        $pages = (int) ceil($total / $this->perPage);

        for ($i = 1; $i <= $pages; $i++) {
            $loc  = base_url("sitemap/generate/daycare/{$i}");
            $xml .= "  <sitemap>\n";
            $xml .= "    <loc>{$loc}</loc>\n";
            $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        $xml .= "</sitemapindex>";

        return $this->response
                    ->setHeader('Content-Type', 'application/xml; charset=utf-8')
                    ->setBody($xml);
    }

    // 개별 사이트맵 생성 (Daycare 데이터)
    public function generate($type = 'daycare', $pageNumber = 1)
    {
        if ($type !== 'daycare') {
            return $this->response
                        ->setStatusCode(404)
                        ->setBody('Invalid sitemap type.');
        }

        helper('url');

        $daycareModel = new DaycareModel();

        $offset = ($pageNumber - 1) * $this->perPage;

        // Daycare 데이터를 페이징해서 가져오기
        $items = $daycareModel->orderBy('id', 'ASC')
                             ->findAll($this->perPage, $offset);

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach ($items as $item) {
            // URL 생성 예: daycare/detail/{id} (상세 페이지 URL 맞춰서 변경 가능)
            $url = base_url("daycare/detail/{$item['id']}");

            // lastmod는 License_Date 있으면 사용, 없으면 오늘 날짜
            $lastmod = !empty($item['License_Date']) 
                        ? date('Y-m-d', strtotime($item['License_Date']))
                        : date('Y-m-d');

            $xml .= "  <url>\n";
            $xml .= "    <loc>{$url}</loc>\n";
            $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.7</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= "</urlset>";

        return $this->response
                    ->setHeader('Content-Type', 'application/xml; charset=utf-8')
                    ->setBody($xml);
    }
}
