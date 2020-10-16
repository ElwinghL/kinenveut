<span class="badge
    <?php if($auction->getPrivacyId() == 2):?>
        badge-dark
    <?php elseif ($auction->getPrivacyId() == 1):?>
        badge-danger
    <?php else:?>
        badge-light
    <?php endif;?>
    badge-pill">
    <?php if($auction->getPrivacyId() == 2):?>
        Secret
    <?php elseif ($auction->getPrivacyId() == 1):?>
        Privée
    <?php else:?>
        Public
    <?php endif;?>
</span>