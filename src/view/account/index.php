<?php
    $user = isset($data['user']) ? $data['user'] : new UserModel();
?>

<?php include_once 'src/view/page-header.php' ?>

<div class="container">
    <h2>
        <?php echo $user->getFirstName() . ' ' . $user->getLastName();?>
    </h2>
    <?php if ($_SESSION['isAdmin'] == 1):?>
        <b>Email :</b>&nbsp<?php echo $user->getEmail();?>
        <br/>
        <b>Date d'anniversaire :</b>&nbsp<?php echo $user->getBirthDate();?>
        <br/>
    <?php endif;?>

    <?php if ($user->getIsAuthorised() != 0):?>
        <a href="?r=auction/sells&userId=<?= $user->getId();?>">
            <?php echo ($_SESSION['userId'] == $user->getId()) ? 'Mes' : 'Ses'?>&nbspventes
        </a>
        <br/>
    <?php endif;?>

    <?php if ($_SESSION['userId'] == $user->getId()):?>
        <a href="?r=auction/bids&userId=<?= $user->getId();?>">Mes enchères</a>
        <br/>
        <a href="?r=account/edit&userId=<?= $user->getId(); ?>">Modifier mes informations</a>
        <br/>
        <a href="?r=account/editPassword&userId=<?= $user->getId(); ?>">Modifier mon mot de passe</a>
    <?php endif;?>
</div>