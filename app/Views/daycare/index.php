<?php include APPPATH . 'Views/includes/header.php'; ?>

<h2>어린이집 목록</h2>
<ul>
  <?php foreach ($daycares as $daycare): ?>
    <li>
      <a href="/daycare/<?= esc($daycare['id']) ?>">
        <?= esc($daycare['Daycare_Name']) ?> (<?= esc($daycare['City_County_District']) ?>)
      </a>
    </li>
  <?php endforeach; ?>
</ul>

<div class="pagination">
  <?= $pager->links() ?>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>

