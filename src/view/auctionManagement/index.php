<?php include_once 'src/view/page-header.php' ?>
<?php
    $auctions = $data['auctions'];
?>
<div class="container">
    <h2>
        Liste des enchères
    </h2>
    
    <div class="col-md
    -12">
        <?php if (sizeof($auctions) > 0):?>
            <ul class="list-group">
                <?php foreach ($auctions as $auction): ?>
                    <li id="category_<?php echo $auction->getId();?>" class="list-group-item float">
                    
                        <div class="col-md-10 mr-0 float-left">
                            <?php echo utf8_encode($auction->getName());?>
                        </div>
                        <div class="col-md- mr-0 float-right">
                            <a href="?r=auctionManagement/info&id=<?php echo utf8_encode($auction->getId());?>" class="btn btn-primary">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                    <circle cx="8" cy="4.5" r="1"/>
                                </svg>
                            </a>

                            <a href="?r=auctionManagement/validate&id=<?php echo utf8_encode($auction->getId());?>" class="btn btn-success">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                </svg>
                            </a>
                            <a href="?r=auctionManagement/delete&id=<?php echo utf8_encode($auction->getId());?>" class="btn btn-danger">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>
                        </div>

                    
                    </li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
    </div>
</div>