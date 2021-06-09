<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RunnerRaceResult[]|\Cake\Collection\CollectionInterface $runnerRaceResults
 */
?>
<div class="runnerRaceResults index content">
    <?= $this->Html->link(__('New Runner Race Result'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Runner Race Results') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('id_runner_race') ?></th>
                    <th><?= $this->Paginator->sort('tm_start_time') ?></th>
                    <th><?= $this->Paginator->sort('tm_end_time') ?></th>
                    <th><?= $this->Paginator->sort('dt_created') ?></th>
                    <th><?= $this->Paginator->sort('dt_modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($runnerRaceResults as $runnerRaceResult): ?>
                <tr>
                    <td><?= $this->Number->format($runnerRaceResult->id) ?></td>
                    <td><?= $this->Number->format($runnerRaceResult->id_runner_race) ?></td>
                    <td><?= h($runnerRaceResult->tm_start_time) ?></td>
                    <td><?= h($runnerRaceResult->tm_end_time) ?></td>
                    <td><?= h($runnerRaceResult->dt_created) ?></td>
                    <td><?= h($runnerRaceResult->dt_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $runnerRaceResult->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $runnerRaceResult->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $runnerRaceResult->id], ['confirm' => __('Are you sure you want to delete # {0}?', $runnerRaceResult->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
