<div class="block-header">
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12">
            <h2><?= $page_heading ?></h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><?= $this->Html->link('<i class="zmdi zmdi-home"></i> Home', ['/'], ['escape' => false]) ?></li>

                <?php
                foreach ($breadcrumbs as $breadcrumb) {
                    echo $this->Html->tag("li", $breadcrumb['caption'], ['class' => 'breadcrumb-item ' . $breadcrumb['class']]);
                }
                ?>
                <!--<li class="breadcrumb-item active">Pages</li>
                                <li class="breadcrumb-item active">Invoice List</li>-->
            </ul>
            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12">
            <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
        </div>
    </div>
</div>