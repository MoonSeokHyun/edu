<?php
/**
 * SEO 및 구조화 데이터 설정
 * 우선순위: 컨트롤러 SEO > academy > daycare > fallback
 */

// 기본 OG 이미지 경로 (변수로 관리하여 쉽게 변경 가능)
$ogImage = $ogImage ?? base_url('assets/images/og-default.png');
$ogImageUrl = $ogImage; // 절대 URL 보장

// SEO 변수 초기화
$seoTitle = $seoTitle ?? null;
$seoDescription = $seoDescription ?? null;
$seoKeywords = $seoKeywords ?? null;
$jsonLd = $jsonLd ?? null;
$ogType = 'website'; // 기본값

// 우선순위 1: 컨트롤러에서 SEO 변수가 모두 제공된 경우 (홈페이지, 목록 페이지 등)
if (!empty($seoTitle) && !empty($seoDescription)) {
    // 이미 설정됨, 추가 처리 불필요
    // 목록 페이지는 컨트롤러에서 검색어/페이지 번호를 포함한 고유한 SEO 제공
    $seoKeywords = $seoKeywords ?? '에듀허브, 어린이집, 유치원, 초등학교, 학원, 교육기관, 공공데이터';
    
// 우선순위 2: 학원 상세 페이지
} elseif (!empty($academy)) {
    $academyName = esc($academy['academy_name'] ?? '학원명');
    $administrativeArea = esc($academy['administrative_area'] ?? '');
    $academyType = esc($academy['academy_type_name'] ?? '');
    $roadAddress = trim($academy['road_address'] ?? '');
    $roadAddressDetail = trim($academy['road_address_detail'] ?? '');
    $fullAddress = trim($roadAddress . ' ' . $roadAddressDetail);
    $phone = trim($academy['phone_number'] ?? '');
    $postalCode = esc($academy['road_postal_code'] ?? '');
    $latitude = !empty($academy['latitude']) ? floatval($academy['latitude']) : null;
    $longitude = !empty($academy['longitude']) ? floatval($academy['longitude']) : null;
    $registrationStatus = esc($academy['registration_status'] ?? '');
    
    // SEO 메타: 지역과 핵심 속성 포함하여 검색 친화적으로 개선
    $locationPart = !empty($administrativeArea) ? " {$administrativeArea}" : '';
    $typePart = !empty($academyType) ? " ({$academyType})" : '';
    $seoTitle = "{$academyName}{$typePart}{$locationPart} - 에듀허브 학원 정보";
    
    $descParts = [];
    if (!empty($administrativeArea)) $descParts[] = $administrativeArea;
    if (!empty($academyType)) $descParts[] = $academyType;
    $locationInfo = !empty($descParts) ? implode(' ', $descParts) . ' ' : '';
    $seoDescription = "{$academyName} 학원{$locationInfo}위치, 연락처, 교육과정, 수강료 등 상세 정보를 제공합니다.";
    
    $seoKeywords = "{$academyName}, 학원, {$administrativeArea}, {$academyType}, 연락처, 교육과정, 에듀허브";
    $ogType = 'article'; // 상세 페이지는 article이 더 적합 (검색엔진이 콘텐츠 페이지로 인식)
    
    // JSON-LD: 조건부 필드만 포함
    $jsonLd = [
        "@context" => "https://schema.org",
        "@type" => "EducationalOrganization",
        "name" => $academyName,
        "url" => current_url()
    ];
    
    // 주소: road_address + road_address_detail 합치기 (빈 값 처리)
    if (!empty($fullAddress)) {
        $jsonLd["address"] = [
            "@type" => "PostalAddress",
            "streetAddress" => $fullAddress,
            "addressCountry" => "KR"
        ];
        if (!empty($administrativeArea)) {
            $jsonLd["address"]["addressLocality"] = $administrativeArea;
        }
        if (!empty($postalCode)) {
            $jsonLd["address"]["postalCode"] = $postalCode;
        }
    }
    
    // 전화번호: 비어있으면 생략
    if (!empty($phone)) {
        $jsonLd["telephone"] = $phone;
    }
    
    // 위도/경도: 둘 다 있을 때만 geo 추가
    if ($latitude !== null && $longitude !== null && $latitude != 0 && $longitude != 0) {
        $jsonLd["geo"] = [
            "@type" => "GeoCoordinates",
            "latitude" => $latitude,
            "longitude" => $longitude
        ];
    }
    
// 우선순위 3: 어린이집 상세 페이지
} elseif (!empty($daycare)) {
    $daycareName = esc($daycare['Daycare_Name'] ?? '어린이집명');
    $district = esc($daycare['City_County_District'] ?? '');
    $province = esc($daycare['Province'] ?? '');
    $address = esc($daycare['Address'] ?? '');
    $phone = trim($daycare['Daycare_Phone_Number'] ?? '');
    $operationStatus = esc($daycare['Operation_Status'] ?? '');
    $postalCode = esc($daycare['Postal_Code'] ?? '');
    $daycareType = esc($daycare['Daycare_Type'] ?? '');
    $latitude = !empty($daycare['Latitude']) ? floatval($daycare['Latitude']) : null;
    $longitude = !empty($daycare['Longitude']) ? floatval($daycare['Longitude']) : null;
    
    // SEO 메타: 지역과 핵심 속성 포함
    $locationPart = '';
    if (!empty($province) && !empty($district)) {
        $locationPart = " {$province} {$district}";
    } elseif (!empty($district)) {
        $locationPart = " {$district}";
    } elseif (!empty($province)) {
        $locationPart = " {$province}";
    }
    $typePart = !empty($daycareType) ? " ({$daycareType})" : '';
    $seoTitle = "{$daycareName}{$typePart}{$locationPart} - 에듀허브 어린이집 정보";
    
    $descParts = [];
    if (!empty($district)) $descParts[] = $district;
    if (!empty($daycareType)) $descParts[] = $daycareType;
    $locationInfo = !empty($descParts) ? implode(' ', $descParts) . ' ' : '';
    $statusInfo = !empty($operationStatus) ? " ({$operationStatus})" : '';
    $seoDescription = "{$daycareName}{$statusInfo} 어린이집{$locationInfo}위치, 연락처, 정원, 운영상태 등 상세 정보를 제공합니다.";
    
    $keywords = [$daycareName, '어린이집'];
    if (!empty($district)) $keywords[] = $district;
    if (!empty($province)) $keywords[] = $province;
    if (!empty($daycareType)) $keywords[] = $daycareType;
    $keywords[] = '에듀허브';
    $seoKeywords = implode(', ', $keywords);
    $ogType = 'article'; // 상세 페이지는 article
    
    // JSON-LD: ChildCare 타입
    $jsonLd = [
        "@context" => "https://schema.org",
        "@type" => "ChildCare",
        "name" => $daycareName,
        "url" => current_url()
    ];
    
    // 주소
    if (!empty($address)) {
        $jsonLd["address"] = [
            "@type" => "PostalAddress",
            "streetAddress" => $address,
            "addressCountry" => "KR"
        ];
        if (!empty($district)) {
            $jsonLd["address"]["addressLocality"] = $district;
        }
        if (!empty($province)) {
            $jsonLd["address"]["addressRegion"] = $province;
        }
        if (!empty($postalCode)) {
            $jsonLd["address"]["postalCode"] = $postalCode;
        }
    }
    
    // 전화번호: 비어있으면 생략
    if (!empty($phone)) {
        $jsonLd["telephone"] = $phone;
    }
    
    // 위도/경도: 둘 다 있을 때만 geo 추가
    if ($latitude !== null && $longitude !== null && $latitude != 0 && $longitude != 0) {
        $jsonLd["geo"] = [
            "@type" => "GeoCoordinates",
            "latitude" => $latitude,
            "longitude" => $longitude
        ];
    }
    
    // openingHours: 실제 시간 정보가 없으면 생략 (상태값으로 억지로 넣지 않음)
    // 실제 운영시간 데이터가 있을 때만 추가하는 것이 SEO에 유리
    
// 우선순위 4: Fallback (홈/기본)
} else {
    $seoTitle = '에듀허브 - 어린이집, 유치원, 초등학교, 학원 정보 검색 서비스';
    $seoDescription = '에듀허브는 어린이집, 유치원, 초등학교, 학원에 대한 신뢰할 수 있는 공공데이터를 무료로 제공합니다. 위치, 연락처, 운영 상태 등 상세한 교육기관 정보를 한눈에 확인하세요.';
    $seoKeywords = '에듀허브, 어린이집, 유치원, 초등학교, 학원, 교육기관, 공공데이터, 어린이집 정보, 유치원 정보, 초등학교 정보, 학원 정보';
    $ogType = 'website'; // 홈페이지는 website
    
    $jsonLd = [
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => "에듀허브",
        "url" => base_url(),
        "description" => $seoDescription,
        "potentialAction" => [
            "@type" => "SearchAction",
            "target" => base_url('daycare') . "?search={search_term_string}",
            "query-input" => "required name=search_term_string"
        ]
    ];
}

// 최종 안전장치: null 체크
$seoTitle = $seoTitle ?? '에듀허브';
$seoDescription = $seoDescription ?? '에듀허브 교육기관 정보 서비스';
$seoKeywords = $seoKeywords ?? '에듀허브';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
  <!-- 기본 SEO 메타 -->
  <title><?= esc($seoTitle) ?></title>
  <meta name="description" content="<?= esc($seoDescription) ?>" />
  <meta name="keywords" content="<?= esc($seoKeywords) ?>" />
  <meta name="author" content="에듀허브" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="<?= current_url() ?>" />
  <link rel="sitemap" type="application/xml" href="<?= base_url('sitemap') ?>" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="<?= esc($ogType) ?>" />
  <meta property="og:title" content="<?= esc($seoTitle) ?>" />
  <meta property="og:description" content="<?= esc($seoDescription) ?>" />
  <meta property="og:url" content="<?= current_url() ?>" />
  <meta property="og:site_name" content="에듀허브" />
  <meta property="og:locale" content="ko_KR" />
  <meta property="og:image" content="<?= esc($ogImageUrl) ?>" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <meta property="og:image:alt" content="<?= esc($seoTitle) ?>" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= esc($seoTitle) ?>" />
  <meta name="twitter:description" content="<?= esc($seoDescription) ?>" />
  <meta name="twitter:image" content="<?= esc($ogImageUrl) ?>" />

  <!-- JSON-LD 구조화 데이터 -->
  <?php if (!empty($jsonLd)): ?>
  <script type="application/ld+json">
  <?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
  </script>
  <?php endif; ?>

  <!-- 외부 리소스 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- 애드센스 사전 연결 (성능 최적화) -->
  <link rel="preconnect" href="https://pagead2.googlesyndication.com">
  <link rel="dns-prefetch" href="https://pagead2.googlesyndication.com">
  <link rel="preconnect" href="https://googleads.g.doubleclick.net">
  <link rel="dns-prefetch" href="https://googleads.g.doubleclick.net">
  
  <!-- 애드센스 스크립트 (한 번만 로드) -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script>
  console.log('[jquery check]', 'jQuery:', typeof jQuery, '$:', typeof $, 'ver:', (window.jQuery && jQuery.fn && jQuery.fn.jquery));
</script>

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
      font-family: 'Noto Sans KR', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; 
      background: white !important; 
      color: #333; 
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    a { text-decoration: none; color: inherit; }
    ul { list-style: none; }

    .top-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ddd;
      padding: 12px 24px;
      background: #fff;
    }

    .logo {
      font-size: 20px;
      font-weight: bold;
      color: #00b15d;
    }

    .center-nav {
      display: flex;
      align-items: center;
      gap: 24px;
      position: relative;
    }

    .menu-group {
      position: relative;
    }

    .menu-group > a {
      font-size: 14px;
      font-weight: 500;
      color: #333;
      padding: 6px;
      cursor: pointer;
    }

    .menu-group:hover .sub-menu {
      display: block;
    }

    .sub-menu {
      display: none;
      position: absolute;
      top: 30px;
      left: 0;
      background: white;
      border: 1px solid #ccc;
      border-radius: 6px;
      min-width: 160px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      z-index: 999;
    }

    .sub-menu li a {
      display: block;
      padding: 10px 14px;
      font-size: 13px;
      color: #2f7f5f;
      white-space: nowrap;
    }

    .sub-menu li a:hover {
      background-color: #f2fcf6;
    }

    .top-nav .right a {
      margin-left: 18px;
      font-size: 14px;
      color: #555;
    }

    .search-bar {
      display: flex;
      justify-content: center;
      margin: 20px auto;
      max-width: 720px;
      padding: 0 16px;
    }

    .search-box {
      display: flex;
      align-items: center;
      border: 2px solid #00b15d;
      border-radius: 8px;
      padding: 8px 12px;
      width: 100%;
      background: #fff;
    }

    .search-box input {
      border: none;
      flex: 1;
      padding: 6px 8px;
      font-size: 14px;
      color: #333;
      background: transparent;
    }

    .search-box input::placeholder {
      color: #aaa;
    }

    .search-box .icon {
      margin-right: 8px;
      font-size: 16px;
      color: #00b15d;
    }

    /* 애드센스 최적화 스타일 */
    .ad-container {
      margin: 20px auto;
      text-align: center;
      min-height: 100px;
      max-width: 100%;
      overflow: hidden;
    }

    .ad-container.above-content {
      margin-top: 0;
      margin-bottom: 30px;
    }

    .ad-container.between-content {
      margin: 30px auto;
    }

    .ad-container.sticky {
      position: sticky;
      top: 20px;
    }

    .adsbygoogle {
      display: block;
      width: 100%;
    }

    /* 모바일에서 광고 최적화 */
    @media (max-width: 768px) {
      .ad-container {
        margin: 15px auto;
        min-height: 50px;
      }
    }

    /* 광고 로딩 최적화 */
    .ad-container {
      background: #f9f9f9;
      border-radius: 4px;
    }
  </style>

</head>
<body>

<!-- 상단 내비게이션 -->
<div class="top-nav">
  <div class="logo"><a href="/">Eduhub</a></div>
  <ul class="center-nav">
    <li class="menu-group">
      <a href="#" class="dropdown-toggle">어린이 ▾</a>
      <ul class="sub-menu">
        <li><a href="/daycare">💇 어린이집 정보</a></li>
      </ul>
    </li>
    <li class="menu-group">
      <a href="#" class="dropdown-toggle">학원 ▾</a>
      <ul class="sub-menu">
        <li><a href="/academy">📚 학원 정보</a></li>
      </ul>
    </li>
  </ul>
</div>

<!-- 검색창 -->
<div class="search-bar">
  <form action="/daycare" method="get" style="width: 100%;">
    <div class="search-box">
      <span class="icon">🔍</span>
      <input
        type="text"
        name="search"
        id="searchInput"
        placeholder="어린이집명, 학원명, 주소 등 검색"
        value="<?= esc($search ?? '') ?>"
      />
    </div>
    <button type="submit" style="display: none;">Search</button>
  </form>
</div>

<!-- 여기에 컨텐츠 영역 -->

</body>
</html>
