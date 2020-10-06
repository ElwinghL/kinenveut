<?php
    $titlePage = isset($data['titlePage']) ? $data['titlePage'] : 'Liste d\'enchères';
    $categoryList = $data['categoryList'];
    $auctionList = $data['auctionList'];
?>

<?php include_once 'src/view/page-header.php' ?>

<div class="container">
    <h2>
        <?php echo $titlePage; ?>
    </h2>
</div>