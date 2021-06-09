<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RacingType $racingType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Racing Type'), ['action' => 'edit', $racingType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Racing Type'), ['action' => 'delete', $racingType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $racingType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Racing Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Racing Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="racingTypes view content">
            <h3><?= h($racingType->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Ds Type') ?></th>
                    <td><?= h($racingType->ds_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($racingType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Created') ?></th>
                    <td><?= h($racingType->dt_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Modified') ?></th>
                    <td><?= h($racingType->dt_modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bl Active') ?></th>
                    <td><?= $racingType->bl_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
