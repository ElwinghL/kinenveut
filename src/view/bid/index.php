<?php include_once 'src/view/page-header.php' ?>

<?php
    date_default_timezone_set('Europe/Paris');
    $dateFormat = 'm d, Y H:i:s';
    $auction = (isset($data['auction'])) ? $data['auction'] : new AuctionModel();
    $auctionAccessState = (isset($data['auctionAccessState'])) ? $data['auctionAccessState'] : new AuctionAccessStateModel();
    $seller = (isset($data['seller'])) ? $data['seller'] : new UserModel();

    $bestBid = ($auction->getBestBid() != null) ? $auction->getBestBid() : new BidModel();
    $minPrice = (($bestBid->getBidPrice() != null) && ($bestBid->getBidPrice() != null)) ? $bestBid->getBidPrice() : $auction->getBasePrice();

    $startDate = strtotime($auction->getStartDate());
    $endDate = strtotime($auction->getStartDate() . ' + ' . $auction->getDuration() . ' days');
    $nowDate = strtotime('now');
    $nowDateBis = new DateTime('Now');
    $endDateFormated = date('Y-m-d H:i:s', $endDate);

    /*var_dump(date('m d, Y H:i:s', $startDate));
    var_dump(date('m d, Y H:i:s', $nowDate));
    var_dump(date('m d, Y H:i:s', $endDate));*/
    $timingLeft = abs($endDate - $nowDate);

    //Je travaille ici :) #JoliCommentaire
    //Todo : Cher Bastien, auriez vous l'obligence de regarder pour résoudre la soustraction en php. Cordialement, Ophélie.

    $timingLeft = "";//((new DateTime($endDateFormated))->date_diff(new DateTime('Now')))->format('m d, Y H:i:s');
    //var_dump($timingLeft);
    //var_dump(date('m d, Y H:i:s', $timingLeft));
    $isFinished = $timingLeft <= 0;
?>

<div class="container">

  <!--Titre-->
  <div class="row">
    <div class="col-md-9">
      <h2><?php echo protectStringToDisplay($auction->getName()); ?> - <?php echo $minPrice ?>€</h2>
        <div id="timer">
            <?php if ($isFinished):?>
                L'enchère est terminée depuis le <?php echo date('d/m/Y H:i:s', $endDate);?>
            <?php else:?>
                Expire dans : <?php echo date('d', $timingLeft) . ' jours ' . date('H:i:s', $timingLeft)?>;
            <?php endif;?></div>
        <br/>
    </div>
    <div class="col-md-3">
        <small>
            <i>
                <?php if ($auction->getAuctionState() != 0):?>
                Mis en ligne le
                <?php else:?>
                Créé le
                <?php endif;?>
                <?php echo date('d-m-Y', $startDate); ?>
            </i>
        </small>
    </div>
  </div>

  <!--Image-->
  <div class="row">
    <div class="col-md-9">
      <?php if (strlen($auction->getPictureLink() > 1)) : ?>
        <img src="<?php $auction->getPictureLink(); ?>" width="100%" alt="Photo de l'image associée à l'enchère" />
      <?php endif; ?>
    </div>
    <div class="col-md-3"></div>
  </div>

  <!--Prix-->
  <div class="row">
    <div class="col-md-6">
      <?php if ($auction->getAuctionState() == 1) : ?>
        <?php if ($_SESSION['userId'] != $auction->getSellerId()) : ?>
          <?php if ($_SESSION['userId'] != $bestBid->getBidderId()) : ?>
            <?php if ($auction->getPrivacyId() == 0 || $auctionAccessState->getStateId() == 1) : ?>
            <div id="formulairePourEncherir">
            <?php if ($isFinished == false):?>
                  <form action="?r=bid/addBid&auctionId=<?= parameters()['auctionId']; ?>" method="post">
                      <div class="input-group mb-2">
                          <input class="form-control" name="bidPrice" type="number" id="bidPrice" value="" min="<?php echo $minPrice + 1; ?>" placeholder="Saisir votre enchère maximum" />
                          <div class="input-group-prepend">
                              <div class="input-group-btn">
                                  <input class="btn btn-light" name="makeabid" type="submit" value="Enchérir" />
                              </div>
                          </div>
                      </div>
                      <?php if (isset($_SESSION['errors']['noBidPrice'])) : ?>
                          <span class='error-custom'><?= $_SESSION['errors']['noBidPrice'] ?></span>;
                          <?php unset($_SESSION['errors']['noBidPrice']); ?>
                      <?php endif; ?>
                  </form>
            <?php endif;?>
            </div>
            <?php else : ?>
              <?php if ($auctionAccessState->getStateId() !== null && $auctionAccessState->getStateId() == 0) : ?>
                <a class="btn btn-secondary" href="?r=bid/cancelAuctionAccessRequest&auctionId=<?= parameters()['auctionId']; ?>">Annuler ma demande</a>
              <?php else : ?>
                <a class="btn btn-primary" href="?r=bid/makeAuctionAccessRequest&auctionId=<?= parameters()['auctionId']; ?>">Demander à participer à l'enchère</a>
              <?php endif; ?>
            <?php endif; ?>
          <?php else : ?>
            Dernière offre :&nbsp<b><span style="color: green"><?php echo ' ' . $minPrice . ' €'; ?></span></b>
          <?php endif; ?>
        <?php else : ?>
          <?php if ($auction->getBasePrice() == $minPrice) : ?>
            <i>Aucune enchère n'a été effectuée pour le moment</i>
          <?php else : ?>
            Dernière offre :&nbsp<?php echo $minPrice . ' €'; ?>
          <?php endif; ?>
        <?php endif; ?>
      <?php else : ?>
        <?php if ($bestBid->getBidPrice() == null) : ?>
          Prix de base =&nbsp<?php echo $minPrice . ' €'; ?>
        <?php else : ?>
          Dernière offre :&nbsp<?php echo $minPrice . ' €'; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>

  <!--Line-->
  <div class="hr"></div>

  <!--Description-->
  <div class="row">
    <div class="col-md-12">
      <h3>Description</h3>
      <p>
        <?php echo protectStringToDisplay($auction->getDescription()); ?>
      </p>
    </div>
  </div>

    <!--Line-->
    <div class="hr"></div>

    <?php if ($auction->getAuctionState() == 1):?>
    <div class="row">
        <?php if ($auction->getPrivacyId() == 0 || $auction->getPrivacyId() == 1 || $_SESSION['userId'] == $auction->getSellerId()) : ?>
        <div class="col-md-12">
            <h3>Partager</h3>
            <div class="col-md-6">
                <div class="input-group mb-2">
                    <input id="to-copy" class="form-control" type="text" value="" readonly/>
                    <div class="input-group-prepend">
                        <div class="input-group-btn">
                            <input id="copy" class="btn btn-secondary" value="Copier le lien"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <!--Line-->
        <div class="hr"></div>
        <?php endif;?>


        <?php if ($_SESSION['userId'] == $auction->getSellerId()) : ?>
        <div class="col-md-12">
            <br/>
            <a href=<?php echo '?r=auction/abort&auctionId=' . $auction->getId() ?>>
                <button class="btn btn-secondary">Clôturer</button>
            </a>
            <a href=<?php echo '?r=auction/cancel&auctionId=' . $auction->getId() ?>>
                <button class="btn btn-danger">Supprimer</button>
            </a>
        </div>
        <!--Line-->
        <div class="hr"></div>
    <?php endif;?>
    </div>
    <?php endif;?>

  <!--User-->
  <div class="row">
    <div class="col-md-9">
        <a href="?r=account/index&userId=<?= $seller->getId(); ?>">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path fill-rule="evenodd" d="M2 15v-1c0-1 1-4 6-4s6 3 6 4v1H2zm6-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            </svg>
            <?php echo $seller->getFirstName() . ' ' . strtoupper(substr($seller->getLastName(), 0, 1)); ?>
        </a>
    </div>

    <div class="col-md-3"></div>

  </div>

</div>

<script type="text/javascript">
    /*Remplissage du champs URL à copier*/
    document.getElementById("to-copy").value = window.location.href;
    replaceTimer();
    var url = window.location.href,
        toCopy  = document.getElementById( 'to-copy' ),
        btnCopy = document.getElementById( 'copy' );

    /*Fonction copiant l'URL*/
    btnCopy.addEventListener( 'click', function(){
        toCopy.select();

        if (document.execCommand( 'copy') ) {
            console.info( 'lien copié');
        } else {
            console.info( 'lien non copié' )
        }
        return false;
    } );

    /*Gestion du timer*/
    // Set the date we're counting down to
    var countDownDate = new Date("<?=$endDateFormated?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        var temps_restant = "";

        if(days > 0){
            temps_restant += days + " jours ";
        }
        if(temps_restant != "" || hours > 0){
            temps_restant += hours + ":";
        }
        if(temps_restant != "" || minutes > 0){
            temps_restant += minutes + ":";
        }
        if(temps_restant != "" || seconds > 0){
            temps_restant += seconds + "";
        }

        // Display the result in the element with id="demo"
        document.getElementById("timer").innerHTML = "Expire dans : " + temps_restant;

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "L'enchère est terminée depuis le <?php echo date('d/m/Y H:i:s', $endDate);?>";
            document.getElementById("formulairePourEncherir").innerHTML = " ";
            document.getElementById("formulairePourEncherir").style.visibility="hidden";
        }
    }, 1000);
</script>