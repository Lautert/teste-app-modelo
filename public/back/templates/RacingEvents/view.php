<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RacingEvent $racingEvent
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Racing Event'), ['action' => 'edit', $racingEvent->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Racing Event'), ['action' => 'delete', $racingEvent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $racingEvent->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Racing Events'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Racing Event'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="racingEvents view content">
            <h3><?= h($racingEvent->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($racingEvent->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Racing Types') ?></th>
                    <td><?= $this->Number->format($racingEvent->id_racing_types) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Schedule') ?></th>
                    <td><?= h($racingEvent->dt_schedule) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Created') ?></th>
                    <td><?= h($racingEvent->dt_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Modified') ?></th>
                    <td><?= h($racingEvent->dt_modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bl Active') ?></th>
                    <td><?= $racingEvent->bl_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
