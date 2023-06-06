<div class="page-header">
    <h1 class="page-title"><?= $page_heading ?></h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= $this->Html->link('Home', '/') ?></li>
            <?php
                foreach ($breadcrumbs as $breadcrumb) {
                    echo $this->Html->tag("li", $breadcrumb['caption'], ['class' => 'breadcrumb-item ' . $breadcrumb['class']]);
                }
            ?>
        </ol>
    </div>
</div>