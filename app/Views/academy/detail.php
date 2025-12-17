<style>
  body { background: #f5f5f5; font-family: 'Noto Sans KR', sans-serif; color: #333; margin:0; padding:0; }
  a { color:#0078ff; text-decoration:none; }
  .container{ max-width:800px; margin:2rem auto; padding:0 1rem; }
  .content-title{ font-size:2rem; margin-bottom:.5rem; border-bottom:2px solid #0078ff; padding-bottom:.3rem; }
  .breadcrumb{ font-size:.9rem; color:#555; margin-bottom:1.5rem; }
  .section{ background:#fff; border-radius:8px; box-shadow:0 1px 4px rgba(0,0,0,0.1); margin-bottom:1.5rem; padding:1.5rem; }
  .section h2{ font-size:1.2rem; margin-bottom:1rem; color:#0078ff; border-left:4px solid #0078ff; padding-left:.5rem; }
  ul.detail-list { list-style:none; margin:0; padding:0; }
  ul.detail-list li { display:flex; justify-content:space-between; padding:.75rem 0; border-bottom:1px solid #eee; }
  ul.detail-list li:last-child { border-bottom:none; }
  ul.detail-list li strong { font-weight:600; color:#333; }
  ul.detail-list li div.value { color:#555; text-align:right; }
  .blog-list, .image-list {
    display: grid;
    gap: 1.2rem;
  }
  .blog-list {
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  }
  .image-list {
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
  }
  .blog-item, .image-item {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    padding: 1rem;
    color: #333;
    text-decoration: none;
  }
  .blog-item:hover, .image-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }
  .blog-item > div.title {
    font-weight: 600;
    font-size: 1rem;
    color: #1b5e20;
    margin-bottom: .5rem;
  }
  .blog-item > div.desc {
    font-size: 0.9rem;
    color: #555;
    margin-bottom: .5rem;
  }
  .blog-item > div.meta {
    font-size: 0.8rem;
    color: #999;
  }
  .image-item img {
    width: 100%;
    display: block;
    border-radius: 8px 8px 0 0;
    object-fit: cover;
    height: 140px;
  }
  .image-item div.caption {
    padding: 0.5rem;
    font-size: 0.85rem;
    color: #444;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  p.back-link {
    margin-top: 2rem;
    font-size: 1rem;
  }
  #map {
    width: 100%;
    height: 300px;
    border-radius: 8px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    margin-top: 1rem;
  }
</style>

<?php include APPPATH . 'Views/includes/header.php'; ?>

<div class="container">
  <h1 class="content-title"><?= esc($academy['academy_name']) ?> 상세정보</h1>
  <div class="breadcrumb">
    <a href="<?= site_url() ?>">홈</a> &gt;
    <a href="<?= site_url('academy') ?>">학원 목록</a> &gt;
    상세정보
  </div>
  
  <!-- 상단 광고 (최적화) -->
  <div class="ad-container above-content">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"
         data-loading="lazy"></ins>
  </div>
  <script>
       (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
  <!-- 기본정보 -->
  <div class="section">
    <h2>기본정보</h2>
    <ul class="detail-list">
      <li><strong>학원명:</strong> <div class="value"><?= esc($academy['academy_name']) ?></div></li>
      <li><strong>학원 유형:</strong> <div class="value"><?= esc($academy['academy_type_name'] ?? '') ?></div></li>
      <li><strong>등록 상태:</strong> <div class="value"><?= esc($academy['registration_status'] ?? '') ?></div></li>
      <li><strong>인가번호:</strong> <div class="value"><?= esc($academy['academy_license_number'] ?? '') ?></div></li>
      <li><strong>개원일:</strong> <div class="value"><?= esc($academy['open_date'] ?? '') ?></div></li>
      <li><strong>등록일:</strong> <div class="value"><?= esc($academy['registration_date'] ?? '') ?></div></li>
      <li><strong>정원:</strong> <div class="value"><?= esc($academy['total_capacity'] ?? '') ?>명</div></li>
      <li><strong>임시 정원:</strong> <div class="value"><?= esc($academy['temporary_capacity'] ?? '') ?>명</div></li>
      <li><strong>휴원 시작일:</strong> <div class="value"><?= esc($academy['suspension_start_date'] ?? '') ?></div></li>
      <li><strong>휴원 종료일:</strong> <div class="value"><?= esc($academy['suspension_end_date'] ?? '') ?></div></li>
    </ul>
  </div>

  <!-- 교육 정보 -->
  <div class="section">
    <h2>교육 정보</h2>
    <ul class="detail-list">
      <li><strong>분야명:</strong> <div class="value"><?= esc($academy['field_name'] ?? '') ?></div></li>
      <li><strong>교습 과목:</strong> <div class="value"><?= esc($academy['teaching_category'] ?? '') ?></div></li>
      <li><strong>과정 목록:</strong> <div class="value"><?= esc($academy['course_list_name'] ?? '') ?></div></li>
      <li><strong>과정명:</strong> <div class="value"><?= esc($academy['course_name'] ?? '') ?></div></li>
      <li><strong>1인당 수강료:</strong> <div class="value"><?= esc($academy['fee_per_person'] ?? '') ?>원</div></li>
      <li><strong>수강료 공개 여부:</strong> <div class="value"><?= esc($academy['fee_disclosure_yn'] ?? '') ?></div></li>
      <li><strong>기숙 학원 여부:</strong> <div class="value"><?= esc($academy['boarding_academy_yn'] ?? '') ?></div></li>
    </ul>
  </div>
  
  <!-- 콘텐츠 사이 광고 1 (최적화) -->
  <div class="ad-container between-content">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"
         data-loading="lazy"></ins>
  </div>
  <script>
       (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
  
  <!-- 연락처 -->
  <div class="section">
    <h2>연락처</h2>
    <ul class="detail-list">
      <li><strong>전화번호:</strong> <div class="value"><?= esc($academy['phone_number'] ?? '') ?></div></li>
    </ul>
  </div>

  <!-- 주소 및 위치 -->
  <div class="section">
    <h2>주소 및 위치</h2>
    <ul class="detail-list">
      <li><strong>행정구역:</strong> <div class="value"><?= esc($academy['administrative_area'] ?? '') ?></div></li>
      <li><strong>교육청 코드:</strong> <div class="value"><?= esc($academy['edu_office_code'] ?? '') ?></div></li>
      <li><strong>교육청명:</strong> <div class="value"><?= esc($academy['edu_office_name'] ?? '') ?></div></li>
      <li><strong>우편번호:</strong> <div class="value"><?= esc($academy['road_postal_code'] ?? '') ?></div></li>
      <li><strong>도로명 주소:</strong> <div class="value"><?= esc($academy['road_address'] ?? '') ?></div></li>
      <li><strong>상세 주소:</strong> <div class="value"><?= esc($academy['road_address_detail'] ?? '') ?></div></li>
      <?php if (!empty($latitude) && !empty($longitude)): ?>
      <li><strong>위도:</strong> <div class="value"><?= esc($latitude) ?></div></li>
      <li><strong>경도:</strong> <div class="value"><?= esc($longitude) ?></div></li>
      <?php endif; ?>
    </ul>
    <?php if (!empty($latitude) && !empty($longitude)): ?>
    <div id="map"></div>
    <?php else: ?>
    <div style="padding: 20px; text-align: center; color: #666; background: #f9f9f9; border-radius: 8px; margin-top: 1rem;">
      지도 정보를 불러올 수 없습니다.
    </div>
    <?php endif; ?>
  </div>
  
  <!-- 콘텐츠 사이 광고 2 (최적화) -->
  <div class="ad-container between-content">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"
         data-loading="lazy"></ins>
  </div>
  <script>
       (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
  
  <!-- 블로그 검색 -->
  <?php if (!empty($blog['items'])): ?>
    <div class="section">
      <h2>블로그 검색</h2>
      <div class="blog-list">
        <?php foreach ($blog['items'] as $item): ?>
          <a href="<?= esc($item['link']) ?>" target="_blank" class="blog-item">
            <div class="title"><?= strip_tags($item['title']) ?></div>
            <div class="desc"><?= strip_tags($item['description']) ?></div>
            <div class="meta"><?= esc($item['bloggername']) ?> · <?= date('Y.m.d', strtotime($item['postdate'])) ?></div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
  
  <!-- 콘텐츠 사이 광고 3 (최적화) -->
  <div class="ad-container between-content">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"
         data-loading="lazy"></ins>
  </div>
  <script>
       (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
  
  <!-- 이미지 검색 -->
  <?php if (!empty($images['items'])): ?>
    <div class="section">
      <h2>이미지 검색</h2>
      <div class="image-list">
        <?php foreach ($images['items'] as $img): ?>
          <a href="<?= esc($img['link']) ?>" target="_blank" class="image-item">
            <img src="<?= esc($img['thumbnail']) ?>" alt="<?= esc($img['title']) ?>" />
            <div class="caption"><?= esc(mb_strimwidth(strip_tags($img['title']), 0, 40, '...')) ?></div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <p class="back-link"><a href="<?= site_url('academy') ?>">← 목록으로</a></p>
</div>

<?php if (!empty($latitude) && !empty($longitude)): ?>
<script type="text/javascript" src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpKeyId=iyBYir1BVYhy4bW5XWB1wHGfUNyOit2Pz4g413ce"></script>
<script>
  // 네이버 지도 API 인증 실패 처리
  window.navermap_authFailure = function () {
    console.error('네이버 지도 API 인증에 실패했습니다.');
    var mapElement = document.getElementById('map');
    if (mapElement) {
      mapElement.innerHTML = '<div style="padding: 20px; text-align: center; color: #666;">지도를 불러올 수 없습니다.</div>';
    }
  };

  // 네이버 지도 띄우기
  var latitude = <?= floatval($latitude) ?>;
  var longitude = <?= floatval($longitude) ?>;

  if (latitude && longitude) {
    var map = new naver.maps.Map('map', {
      center: new naver.maps.LatLng(latitude, longitude),
      zoom: 15
    });

    var marker = new naver.maps.Marker({
      position: new naver.maps.LatLng(latitude, longitude),
      map: map
    });
  }
</script>
<?php endif; ?>

<?php include APPPATH . 'Views/includes/footer.php'; ?>

