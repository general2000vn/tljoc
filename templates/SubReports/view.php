<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubReport $subReport
 */
?>
<?php
    $this->start('page_title');
    echo "Well Test";
    $this->end('page_title');

    $this->start('bottom_scripts');
    echo $this->Html->script(['../themes/sash/assets/plugins/gallery/picturefill'
                        ,'../themes/sash/assets/plugins/gallery/lightgallery'
                        ,'../themes/sash/assets/plugins/gallery/lightgallery-1'
                        ,'../themes/sash/assets/plugins/gallery/lg-pager'
                        ,'../themes/sash/assets/plugins/gallery/lg-autoplay'
                        ,'../themes/sash/assets/plugins/gallery/lg-fullscreen'
                        ,'../themes/sash/assets/plugins/gallery/lg-zoom'
                        ,'../themes/sash/assets/plugins/gallery/lg-hash'
                        ,'../themes/sash/assets/plugins/gallery/lg-share'
                    ]);
    $this->end('bottom_scripts');

?>

<!-- GALLERY DEMO OPEN -->
<div class="demo-gallery card">
    <div class="card-header">
        <div class="card-title">Plot</div>
    </div>
    <div class="card-body">
        <ul id="lightgallery" class="list-unstyled row">
            <li class="col-xs-12 mb-5 border-bottom-0" data-responsive="<?= $this->Url->image('../themes/sash/assets/images/media/1.jpg') ?>" data-src="<?= ->image('../themes/sash/assets/images/media/1.jpg') ?>" data-sub-html="<h4>Name</h4><p>Description</p>">
                <a href="">
                    <img class="img-responsive br-5" src="<?= ->image('../themes/sash/assets/images/media/1.jpg') ?>" alt="Thumb-1">
                    <?= $this->Html->image('../themes/sash/assets/images/media/1.jpg', ['class' => 'img-responsive br-5', 'alt' => 'Thumb-1']) ?>
                </a>
            </li>
            
        </ul>
    </div>
</div>
<!-- GALLERY DEMO CLOSED -->