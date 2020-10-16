<?php
    $user = isset($data['user']) ? $data['user'] : new UserModel();
    $isOwner = ($_SESSION['userId'] == $user->getId());
    $isAdmin = ($_SESSION['isAdmin'] == 1);
?>

<?php include_once 'src/view/page-header.php' ?>

<div class="container">
  <h2>
    <?php echo $user->getFirstName() . ' ' . $user->getLastName(); ?>
  </h2>
  <?php if ($isAdmin || $isOwner) : ?>
    <b>Email :</b>&nbsp<?php echo $user->getEmail(); ?>
    <br />
    <b>Date de naissance :</b>&nbsp<?php echo dateFormat($user->getBirthDate()); ?>
    <br />
  <?php endif; ?>

  <?php if ($user->getIsAuthorised() != 0 && !$isOwner) : ?>
    <a href="?r=auction/sells&userId=<?= $user->getId(); ?>">Ses ventes</a>
    <br />
  <?php endif; ?>

  <?php if ($isOwner) : ?>
    <a href="?r=account/edit&userId=<?= $user->getId(); ?>">Modifier mes informations</a>
  <?php elseif ($isAdmin) : ?>
    <br/>
    <?php if ($user->getIsAuthorised() == 0):?>
      <a href="?r=userManagement/validate&id=<?php echo $user->getId(); ?>" class="btn btn-success">
          Accepter
      </a>
      <a href="?r=userManagement/delete&id=<?php echo $user->getId(); ?>" class="btn btn-danger">
          Refuser
      </a>
    <?php elseif ($user->getIsAuthorised() == 1):?>
        <a href="?r=UserManagement/ban&id=<?php echo $user->getId(); ?>" class="btn btn-danger">Bannir</a>
    <?php elseif ($user->getIsAuthorised() == 6):?>
        <a href="?r=UserManagement/unban&id=<?php echo $user->getId(); ?>" class="btn btn-danger">Dé-Bannir</a>
    <?php endif; ?>
  <?php endif; ?>
</div>
