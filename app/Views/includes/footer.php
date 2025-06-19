<footer>
  <div class="footer-container">
    <!-- 회사 정보 -->
    <div class="footer-section">
      <h3>문딜로지스틱스 (MoonDilogistics)</h3>
      <p>IT 웹 서비스 운영</p>
      <p>사업자 등록번호 : 345-18-02361</p>
      <p class="copyright">
        © Copyright Since 2024 문딜로지스틱스. All rights reserved.
      </p>
    </div>
    <!-- 고객센터 -->
    <div class="footer-section">
      <h3>고객센터</h3>
      <p>이메일: <a href="mailto:gjqmaoslwj@naver.com">gjqmaoslwj@naver.com</a></p>
      <p>운영시간: 평일 09:00 ~ 18:00 (점심시간 11:00 ~ 13:00)</p>
      <p class="footer-note">홈페이지 정보 오류 수정 / 삭제 요청 / 이용 문의 등</p>
    </div>
    <!-- 사이드 프로젝트 -->
    <div class="footer-section">
      <h3>Side Projects</h3>
      <ul>
        <li><a href="#">🔍생활정도보는 퐁퐁 터지는 퐁퐁코리아 </a></li>
        <li><a href="#">💼각종 할인 차량정보는 편잇!</a></li>
      </ul>
    </div>
  </div>
</footer>

<!-- 스크립트 및 스타일 -->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
if (window.location.hostname !== "localhost" && window.location.hostname !== "127.0.0.1") {
    if (!wcs_add) var wcs_add = {};
    wcs_add["wa"] = "12d294cc6ae2890";
    if (window.wcs) {
        wcs_do();
    }
}
</script>

<script>
  if (window.innerWidth <= 768) {
    document.querySelectorAll("#header-wrapper .menu-group > a.dropdown-toggle").forEach(function(toggleLink) {
      toggleLink.addEventListener('click', function(e) {
        e.preventDefault();
        var submenu = toggleLink.nextElementSibling;
        if (submenu) {
          submenu.style.display = submenu.style.display === "block" ? "none" : "block";
        }
      });
    });
  }
</script>

<style>
  #header-wrapper header {
    background-color: #3eaf7c;
    color: white;
    padding: 1.2rem;
    text-align: center;
    font-size: 1.1rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
  }

  #header-wrapper .main-nav {
    background-color: #f9fdfc;
    padding: 0.8rem 1rem;
    border-bottom: 1px solid #d4eee3;
    box-shadow: 0 2px 4px rgba(0,0,0,0.03);
  }

  #header-wrapper .top-menu {
    list-style: none;
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    margin: 0;
    padding: 0;
    flex-wrap: wrap;
  }

  #header-wrapper .top-menu > li {
    position: relative;
  }

  #header-wrapper .top-menu > li > a {
    text-decoration: none;
    color: #2f7f5f;
    font-weight: 600;
    font-size: 15px;
    padding: 10px 14px;
    border-radius: 6px;
    transition: background-color 0.2s ease;
  }

  #header-wrapper .top-menu > li > a:hover {
    background-color: #3eaf7c;
    color: white;
  }

  .sub-menu {
    display: none;
    position: absolute;
    top: 110%;
    left: 0;
    background-color: #ffffff;
    border: 1px solid #d4eee3;
    border-radius: 6px;
    padding: 0.5rem 0;
    min-width: 170px;
    list-style: none;
    box-shadow: 0 6px 12px rgba(0,0,0,0.08);
    z-index: 1000;
  }

  .menu-group:hover .sub-menu {
    display: block;
  }

  .sub-menu li a {
    display: block;
    padding: 9px 16px;
    color: #2f7f5f;
    font-size: 14px;
    text-decoration: none;
    transition: background-color 0.2s ease;
  }

  .sub-menu li a:hover {
    background-color: #ecf9f1;
  }

  @media (max-width: 768px) {
    #header-wrapper .top-menu {
      flex-direction: row;
      flex-wrap: wrap;
      gap: 1rem;
    }

    #header-wrapper .top-menu > li {
      width: auto;
    }

    .sub-menu {
      position: absolute;
      top: 100%;
      left: 0;
    }

    .menu-group:hover .sub-menu {
      display: block;
    }
  }

  .adsbygoogle {
    display: block;
    text-align: center;
    margin: 0 auto;
  }

  footer {
    background-color: #f8f9fa;
    color: #333;
    padding: 40px 20px;
    border-top: 1px solid #ddd;
    font-size: 14px;
  }

  .footer-container {
    display: flex;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
    gap: 40px;
    justify-content: space-between;
  }

  .footer-section {
    flex: 1 1 120px;
    min-width: 250px;
  }

  .footer-section h3 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #111;
  }

  .footer-section p,
  .footer-section li {
    margin: 6px 0;
    line-height: 1.6;
  }

  .footer-section a {
    color: #0066cc;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .footer-section a:hover {
    text-decoration: underline;
    color: #004999;
  }

  .footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .footer-note {
    color: #666;
    font-size: 13px;
    margin-top: 10px;
  }

  .copyright {
    margin-top: 20px;
    font-size: 12px;
    color: #888;
  }
</style>

</body>
</html>