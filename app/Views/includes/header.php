<?php
if (!empty($company)) {
    $companyName = esc($company['Company Name (Korean)']);
    $companyDesc = esc($company['One-liner Description']);
    $companyIndustry = esc($company['Industry Classification']);
    $seoTitle = "{$companyName} - 잡허브";
    $seoDescription = $companyDesc;
    $seoKeywords = "{$companyName}, 기업 리뷰, {$companyIndustry}, 잡허브";
} elseif (!empty($business)) {
    $facilityName = esc($business['business_name'] ?? '사업장명');
    $zipCode = esc($business['zip_code'] ?? '');
    $landLotAddress = esc($business['landlot_address'] ?? '');
    $streetAddress = esc($business['street_address'] ?? '');
    $businessType = esc($business['business_type'] ?? '');
    $owners = esc($business['number_of_owners'] ?? '');

    preg_match('/([가-힣]+구|[가-힣]+읍|[가-힣]+면)/', $landLotAddress, $m);
    $district = $m[0] ?? '지역';

    $seoTitle = esc("{$facilityName} 상세정보 – {$district} 사업장 주소・업종・사업자 수");
    $seoDescription = esc("{$facilityName} 사업장의 상세 주소, 업종, 사업자 수 등 정확한 정보를 제공합니다. {$district} 지역 사업장 관련 최신 정보 확인하기.");
    $seoKeywords = esc("{$facilityName}, 사업장, {$district}, 업종, 주소, 사업자 수, {$businessType}");
} else {
    $seoTitle = '기업 정보/면접 리뷰/기업 리뷰는 잡 허브에서!';
    $seoDescription = '기업 정보/면접 리뷰/기업 리뷰는 잡 허브에서!';
    $seoKeywords = '기업 정보/면접 리뷰/기업 리뷰는 잡 허브에서!';
}
?>


<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $seoTitle ?></title>
  <meta name="description" content="<?= $seoDescription ?>" />
  <meta name="keywords" content="<?= $seoKeywords ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background:white !important; color: #333; }
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
      color: #00b15d;
      font-size: 16px;
    }
  </style>
</head>
<body>

<!-- ✅ 상단 내비게이션 -->
<div class="top-nav">
  <div class="logo"><a href="/">Eduhub</a></div>
  <ul class="center-nav">
    <li class="menu-group">
      <a href="#" class="dropdown-toggle"> 어린이 ▾</a>
      <ul class="sub-menu">
        <li><a href="/daycare">💇 어린이집 정보</a></li>
        <li><a href="/">🏢 유치원 정보</a></li>
      </ul>
    </li>
    <li class="menu-group">
      <a href="#" class="dropdown-toggle">학생정보 ▾</a>
      <ul class="sub-menu">
        <li><a href="/">💼 초등학교</a></li>
        <li><a href="/">🚀 중학교</a></li>
        <li><a href="/">🚀 고등학교</a></li>
      </ul>
    </li>
  </ul>
</div>

<!-- ✅ 검색창 -->
<div class="search-bar">
  <form action="/daycare" method="get" style="width: 100%;">
    <div class="search-box">
      <span class="icon">🔍</span>
      <input
        type="text"
        name="search"
        id="searchInput"
        placeholder="어린이집명, 주소 등 검색"
        value="<?= esc($search ?? '') ?>"
      />
    </div>
    <button type="submit" style="display: none;">Search</button>
  </form>
</div>
