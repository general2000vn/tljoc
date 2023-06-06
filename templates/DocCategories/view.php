<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocCategory $docCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Doc Category'), ['action' => 'edit', $docCategory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Doc Category'), ['action' => 'delete', $docCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docCategory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Doc Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Doc Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docCategories view content">
            <h3><?= h($docCategory->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($docCategory->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($docCategory->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
