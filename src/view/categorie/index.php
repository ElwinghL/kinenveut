<?php
$categoryList = $data['categoryList'];
?>

<?php include_once 'src/view/page-header.php' ?>

<div class="container">
  <h2>
    Gestion des catégories
  </h2>

  <div class="col-12">
    <?php if (sizeof($categoryList) > 0) : ?>
      <ul class="list-group">
        <?php foreach ($categoryList as $oneCategory) : ?>
          <li id="category_<?php echo $oneCategory->getId(); ?>" class="list-group-item">
            <?php echo utf8_encode($oneCategory->getName()); ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>
