<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Runner $runner
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Runner'), ['action' => 'edit', $runner->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Runner'), ['action' => 'delete', $runner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $runner->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Runners'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Runner'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="runners view content">
            <h3><?= h($runner->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Ds Name') ?></th>
                    <td><?= h($runner->ds_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ds Document') ?></th>
                    <td><?= h($runner->ds_document) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($runner->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Birth') ?></th>
                    <td><?= h($runner->dt_birth) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Created') ?></th>
                    <td><?= h($runner->dt_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Modified') ?></th>
                    <td><?= h($runner->dt_modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bl Active') ?></th>
                    <td><?= $runner->bl_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
