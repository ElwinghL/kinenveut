<?php include_once 'src/view/page-header.php' ?>
<?php
$users = $data['users'];
$allUsers = $data['allUsers']
?>
<div class="container">
  <h2>
    Inscription en attente
  </h2>

  <div class="col-md
    -12">
    <?php if (sizeof($users) > 0) : ?>
      <ul class="list-group">
        <?php foreach ($users as $user) : ?>
          <li id="user_<?php echo $user->getId(); ?>" class="list-group-item float">

            <div class="col-md-10 mr-0 float-left">
            <span class="label-custom">
              (En Attente)
            </span>
              <?php echo $user->getFirstName() . ' ' . $user->getLastName(); ?>
            </div>
            <div class="col-md- mr-0 float-right">
              <a href="?r=account/index&userId=<?php echo utf8_encode($user->getId()); ?>" class="btn btn-primary">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
                  <circle cx="8" cy="4.5" r="1" />
                </svg>
              </a>

              <a href="?r=userManagement/validate&id=<?php echo $user->getId(); ?>" class="btn btn-success">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z" />
                </svg>
              </a>
              <a href="?r=userManagement/delete&id=<?php echo $user->getId(); ?>" class="btn btn-danger">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
              </a>
            </div>


          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>

  <h2>
    Membres déjà inscrits
  </h2>
  <div class="col-md-12">
    <?php if (sizeof($allUsers) > 0) : ?>
      <ul class="list-group">
        <?php foreach ($allUsers as $user) : ?>
          <li id="user_<?php echo $user->getId(); ?>" class="list-group-item float">
            <div class="col-md-10 mr-0 float-left">
            <span class="label-custom">
              <?php
                switch ($user->getIsAuthorised()) {
                  case 0:
                    echo '(En Attente)';
                  break;
                  case 1:
                    echo '(Validé)    ';
                  break;
                  case 5:
                    echo '(Refusé)    ';
                  break;
                  case 6:
                    echo '(Banni)     ';
                  break;
                }
              ?>
            </span>  
            <?php echo $user->getFirstName() . ' ' . $user->getLastName(); ?>
            </div>
            <div class="col-md- mr-0 float-right">
              <a href="?r=account/index&userId=<?php echo utf8_encode($user->getId()); ?>" class="btn btn-primary">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
                  <circle cx="8" cy="4.5" r="1" />
                </svg>
              </a>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
        <i>Toutes les demandes d'inscription ont été traitées.</i>
    <?php endif; ?>
  </div>
</div>
