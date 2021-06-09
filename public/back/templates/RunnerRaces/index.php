<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RunnerRace[]|\Cake\Collection\CollectionInterface $runnerRaces
 */
?>
<div class="runnerRaces index content">
    <?= $this->Html->link(__('New Runner Race'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Runner Races') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('id_runner') ?></th>
                    <th><?= $this->Paginator->sort('id_racing_event') ?></th>
                    <th><?= $this->Paginator->sort('dt_created') ?></th>
                    <th><?= $this->Paginator->sort('dt_modified') ?></th>
                    <th><?= $this->Paginator->sort('bl_active') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($runnerRaces as $runnerRace): ?>
                <tr>
                    <td><?= $this->Number->format($runnerRace->id) ?></td>
                    <td><?= $this->Number->format($runnerRace->id_runner) ?></td>
                    <td><?= $this->Number->format($runnerRace->id_racing_event) ?></td>
                    <td><?= h($runnerRace->dt_created) ?></td>
                    <td><?= h($runnerRace->dt_modified) ?></td>
                    <td><?= h($runnerRace->bl_active) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $runnerRace->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $runnerRace->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $runnerRace->id], ['confirm' => __('Are you sure you want to delete # {0}?', $runnerRace->id)]) ?>
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
