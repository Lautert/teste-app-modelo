<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RunnerRace $runnerRace
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Runner Race'), ['action' => 'edit', $runnerRace->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Runner Race'), ['action' => 'delete', $runnerRace->id], ['confirm' => __('Are you sure you want to delete # {0}?', $runnerRace->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Runner Races'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Runner Race'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="runnerRaces view content">
            <h3><?= h($runnerRace->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($runnerRace->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Runner') ?></th>
                    <td><?= $this->Number->format($runnerRace->id_runner) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Racing Event') ?></th>
                    <td><?= $this->Number->format($runnerRace->id_racing_event) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Created') ?></th>
                    <td><?= h($runnerRace->dt_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Modified') ?></th>
                    <td><?= h($runnerRace->dt_modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bl Active') ?></th>
                    <td><?= $runnerRace->bl_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
