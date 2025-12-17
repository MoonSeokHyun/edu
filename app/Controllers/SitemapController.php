<?php

namespace App\Controllers;

use App\Models\DaycareModel;
use App\Models\AcademyModel;
use CodeIgniter\Controller;

class SitemapController extends Controller
{
    protected $perPage = 10000;

    // 사이트맵 인덱스
    public function index()
    {
        helper('url');

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        // 정적 페이지 사이트맵
        $xml .= "  <sitemap>\n";
        $xml .= "    <loc>" . base_url("sitemap/static") . "</loc>\n";
        $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        $xml .= "  </sitemap>\n";

        // 어린이집 사이트맵
        $daycareModel = new DaycareModel();
        $daycareTotal = $daycareModel->countAll();
        $daycarePages = (int) ceil($daycareTotal / $this->perPage);

        for ($i = 1; $i <= $daycarePages; $i++) {
            $loc  = base_url("sitemap/generate/daycare/{$i}");
            $xml .= "  <sitemap>\n";
            $xml .= "    <loc>{$loc}</loc>\n";
            $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        // 학원 사이트맵
        $academyModel = new AcademyModel();
        $academyTotal = $academyModel->countAll();
        $academyPages = (int) ceil($academyTotal / $this->perPage);

        for ($i = 1; $i <= $academyPages; $i++) {
            $loc  = base_url("sitemap/generate/academy/{$i}");
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

    // 정적 페이지 사이트맵
    public function static()
    {
        helper('url');

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        // 홈페이지
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . base_url() . "</loc>\n";
        $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        $xml .= "    <changefreq>daily</changefreq>\n";
        $xml .= "    <priority>1.0</priority>\n";
        $xml .= "  </url>\n";

        // 어린이집 목록 페이지
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . base_url("daycare") . "</loc>\n";
        $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        $xml .= "    <changefreq>daily</changefreq>\n";
        $xml .= "    <priority>0.9</priority>\n";
        $xml .= "  </url>\n";

        // 학원 목록 페이지
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . base_url("academy") . "</loc>\n";
        $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        $xml .= "    <changefreq>daily</changefreq>\n";
        $xml .= "    <priority>0.9</priority>\n";
        $xml .= "  </url>\n";

        $xml .= "</urlset>";

        return $this->response
                    ->setHeader('Content-Type', 'application/xml; charset=utf-8')
                    ->setBody($xml);
    }

    // 개별 사이트맵 생성
    public function generate($type = 'daycare', $pageNumber = 1)
    {
        helper('url');

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        if ($type === 'daycare') {
            $daycareModel = new DaycareModel();
            $offset = ($pageNumber - 1) * $this->perPage;

            $items = $daycareModel->orderBy('id', 'ASC')
                                 ->findAll($this->perPage, $offset);

            foreach ($items as $item) {
                $url = base_url("daycare/{$item['id']}");

                // lastmod는 License_Date 있으면 사용, 없으면 updated_at 또는 오늘 날짜
                $lastmod = date('Y-m-d');
                if (!empty($item['License_Date'])) {
                    $lastmod = date('Y-m-d', strtotime($item['License_Date']));
                } elseif (!empty($item['updated_at'])) {
                    $lastmod = date('Y-m-d', strtotime($item['updated_at']));
                }

                // 운영 상태에 따라 priority 조정
                $priority = 0.7;
                if (!empty($item['Operation_Status']) && $item['Operation_Status'] === '운영') {
                    $priority = 0.8;
                }

                $xml .= "  <url>\n";
                $xml .= "    <loc>" . htmlspecialchars($url, ENT_XML1, 'UTF-8') . "</loc>\n";
                $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
                $xml .= "    <changefreq>weekly</changefreq>\n";
                $xml .= "    <priority>{$priority}</priority>\n";
                $xml .= "  </url>\n";
            }
        } elseif ($type === 'academy') {
            $academyModel = new AcademyModel();
            $offset = ($pageNumber - 1) * $this->perPage;

            $items = $academyModel->orderBy('id', 'ASC')
                                 ->findAll($this->perPage, $offset);

            foreach ($items as $item) {
                $url = base_url("academy/{$item['id']}");

                // lastmod는 registration_date 있으면 사용, 없으면 updated_at 또는 오늘 날짜
                $lastmod = date('Y-m-d');
                if (!empty($item['registration_date'])) {
                    $lastmod = date('Y-m-d', strtotime($item['registration_date']));
                } elseif (!empty($item['updated_at'])) {
                    $lastmod = date('Y-m-d', strtotime($item['updated_at']));
                }

                // 등록 상태에 따라 priority 조정
                $priority = 0.7;
                if (!empty($item['registration_status']) && $item['registration_status'] === '등록') {
                    $priority = 0.8;
                }

                $xml .= "  <url>\n";
                $xml .= "    <loc>" . htmlspecialchars($url, ENT_XML1, 'UTF-8') . "</loc>\n";
                $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
                $xml .= "    <changefreq>weekly</changefreq>\n";
                $xml .= "    <priority>{$priority}</priority>\n";
                $xml .= "  </url>\n";
            }
        } else {
            return $this->response
                        ->setStatusCode(404)
                        ->setBody('Invalid sitemap type.');
        }

        $xml .= "</urlset>";

        return $this->response
                    ->setHeader('Content-Type', 'application/xml; charset=utf-8')
                    ->setBody($xml);
    }
}
