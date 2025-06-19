<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
        margin: 0;
        padding: 0;
    }

    /* 페이지 제목 */
    .page-title {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        color: #333;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    /* 카드 그리드 */
    .card-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding: 20px;
        width: 80%;
        margin: 0 auto;
    }

    .card {
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
        user-select: none;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card h3 {
        margin: 10px 0;
        color: #333;
    }

    .card p {
        font-size: 14px;
        color: #555;
        margin: 4px 0;
    }

    /* 페이징 컨테이너 초기화 및 스타일 */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin-top: 20px;
        gap: 8px;
    }

    /* 페이징 아이템 */
    .pagination li {
        display: inline-block;
    }

    /* 링크 및 현재 페이지 스타일 */
    .pagination li a,
    .pagination li span {
        display: block;
        padding: 8px 16px;
        background-color: #62D491;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        user-select: none;
        transition: background-color 0.3s;
    }

    .pagination li a:hover {
        background-color: #55b379;
    }

    .pagination li.active span {
        background-color: #4e9e68;
        cursor: default;
    }

    /* 모바일 반응형 */
    @media (max-width: 768px) {
        .page-title {
            font-size: 24px;
            margin-top: 10px;
        }

        .card-container {
            grid-template-columns: 1fr;
            width: 90%;
            padding: 10px;
        }

        .pagination li a,
        .pagination li span {
            padding: 6px 12px;
        }
    }
</style>

<?php include APPPATH . 'Views/includes/header.php'; ?>

<h1 class="page-title">어린이집 목록</h1>

<div class="card-container">
    <?php foreach ($daycares as $daycare): ?>
        <div class="card" onclick="window.location.href='<?= site_url('daycare/' . esc($daycare['id'])) ?>'">
            <h3><?= esc($daycare['Daycare_Name']) ?> 🏫</h3>
            <p>지역: <?= esc($daycare['City_County_District']) ?> 📍</p>
            <p>전화: <?= esc($daycare['Daycare_Phone_Number']) ?> 📞</p>
        </div>
    <?php endforeach; ?>
</div>

<!-- 페이징 -->
<div>
    <ul class="pagination">
        <?= $pager->links() ?>
    </ul>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
