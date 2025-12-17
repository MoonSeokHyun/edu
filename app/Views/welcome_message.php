<?php include APPPATH . 'Views/includes/header.php'; ?>

<style>
  .homepage-hero {
    background: linear-gradient(135deg, #00b15d 0%, #008a4a 100%);
    color: #fff;
    padding: 100px 20px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .homepage-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
    opacity: 0.3;
  }

  .homepage-hero-content {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
  }

  .homepage-hero h1 {
    font-size: clamp(28px, 5vw, 42px);
    font-weight: 700;
    margin-bottom: 24px;
    line-height: 1.3;
    letter-spacing: -0.5px;
  }

  .homepage-hero p {
    font-size: clamp(16px, 2.5vw, 20px);
    font-weight: 400;
    max-width: 700px;
    margin: 0 auto 32px;
    line-height: 1.7;
    opacity: 0.95;
  }

  .cta-button {
    display: inline-block;
    background: #fff;
    color: #00b15d;
    padding: 16px 32px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .cta-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
  }

  .homepage-features {
    background: #fff;
    padding: 80px 20px;
  }

  .homepage-features-header {
    text-align: center;
    margin-bottom: 60px;
  }

  .homepage-features-header h2 {
    font-size: clamp(24px, 4vw, 32px);
    font-weight: 700;
    color: #222;
    margin-bottom: 16px;
  }

  .homepage-features-header p {
    font-size: 18px;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
  }

  .homepage-features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    max-width: 1100px;
    margin: 0 auto;
  }

  .homepage-feature-card {
    background: #f9f9f9;
    padding: 32px 24px;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
  }

  .homepage-feature-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 177, 93, 0.12);
    border-color: #00b15d;
  }

  .homepage-feature-card h3 {
    font-size: 20px;
    font-weight: 600;
    color: #00b15d;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .homepage-feature-card h3::before {
    content: '✓';
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    background: #00b15d;
    color: #fff;
    border-radius: 50%;
    font-size: 14px;
    font-weight: 700;
  }

  .homepage-feature-card p {
    font-size: 15px;
    color: #555;
    line-height: 1.7;
  }

  .homepage-ad-section {
    margin: 40px auto;
    max-width: 1200px;
    padding: 0 20px;
  }

  @media (max-width: 768px) {
    .homepage-hero {
      padding: 60px 20px;
    }

    .homepage-features {
      padding: 60px 20px;
    }

    .homepage-features-grid {
      grid-template-columns: 1fr;
      gap: 20px;
    }

    .homepage-feature-card {
      padding: 24px 20px;
    }
  }

  @media (max-width: 480px) {
    .homepage-hero {
      padding: 40px 16px;
    }

    .cta-button {
      padding: 14px 24px;
      font-size: 15px;
    }
  }
</style>

<!-- Ad Section (최적화) -->
<div class="homepage-ad-section ad-container above-content">
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="ca-pub-6686738239613464"
       data-ad-slot="1204098626"
       data-ad-format="auto"
       data-full-width-responsive="true"
       data-loading="lazy"></ins>
  <script>
       (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</div>

<!-- Hero Section -->
<section class="homepage-hero" role="banner">
  <div class="homepage-hero-content">
    <h1>교육기관 정보는 에듀허브에서</h1>
    <p>에듀허브는 어린이집, 유치원, 초등학교에 대한 신뢰할 수 있는 공공데이터를 무료로 제공합니다. 위치, 연락처, 운영 상태 등 상세한 교육기관 정보를 한눈에 확인하세요.</p>
    <a href="/daycare" class="cta-button">어린이집 정보 검색하기</a>
  </div>
</section>

<!-- Features Section -->
<section class="homepage-features" aria-labelledby="features-heading">
  <div class="homepage-features-header">
    <h2 id="features-heading">서비스 소개</h2>
    <p>에듀허브가 제공하는 다양한 교육기관 정보 서비스를 확인해보세요</p>
  </div>
  
  <div class="homepage-features-grid">
    <article class="homepage-feature-card">
      <h3>어린이집 정보</h3>
      <p>위치, 정원, 보육교사 수, 통학 차량 여부 등 상세한 어린이집 정보를 제공합니다. 공공데이터를 기반으로 한 신뢰할 수 있는 정보를 확인하세요.</p>
    </article>
    
    <article class="homepage-feature-card">
      <h3>유치원 데이터</h3>
      <p>국공립 및 사립 유치원의 운영 형태, 교육 과정, 설립일 등 주요 정보를 확인할 수 있습니다. 지역별 유치원 현황을 쉽게 검색하세요.</p>
    </article>
    
    <article class="homepage-feature-card">
      <h3>초등학교 현황</h3>
      <p>학교 위치, 학급 수, 학생 수, 교직원 수 등 초등학교에 대한 다양한 정보를 제공합니다. 학부모와 교육 관계자에게 유용한 정보입니다.</p>
    </article>
    
    <article class="homepage-feature-card">
      <h3>무료 공공데이터</h3>
      <p>공공기관이 제공하는 신뢰성 높은 교육 데이터를 누구나 자유롭게 이용할 수 있습니다. 별도의 회원가입 없이 모든 정보를 무료로 확인하세요.</p>
    </article>
  </div>
</section>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
