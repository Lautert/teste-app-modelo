<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RunnerRaceResult $runnerRaceResult
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Runner Race Result'), ['action' => 'edit', $runnerRaceResult->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Runner Race Result'), ['action' => 'delete', $runnerRaceResult->id], ['confirm' => __('Are you sure you want to delete # {0}?', $runnerRaceResult->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Runner Race Results'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Runner Race Result'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="runnerRaceResults view content">
            <h3><?= h($runnerRaceResult->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($runnerRaceResult->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Runner Race') ?></th>
                    <td><?= $this->Number->format($runnerRaceResult->id_runner_race) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tm Start Time') ?></th>
                    <td><?= h($runnerRaceResult->tm_start_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tm End Time') ?></th>
                    <td><?= h($runnerRaceResult->tm_end_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Created') ?></th>
                    <td><?= h($runnerRaceResult->dt_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt Modified') ?></th>
                    <td><?= h($runnerRaceResult->dt_modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
