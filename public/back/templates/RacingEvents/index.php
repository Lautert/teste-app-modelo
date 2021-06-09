<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RacingEvent[]|\Cake\Collection\CollectionInterface $racingEvents
 */
?>
<div class="racingEvents index content">
    <?= $this->Html->link(__('New Racing Event'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Racing Events') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('id_racing_types') ?></th>
                    <th><?= $this->Paginator->sort('dt_schedule') ?></th>
                    <th><?= $this->Paginator->sort('dt_created') ?></th>
                    <th><?= $this->Paginator->sort('dt_modified') ?></th>
                    <th><?= $this->Paginator->sort('bl_active') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($racingEvents as $racingEvent): ?>
                <tr>
                    <td><?= $this->Number->format($racingEvent->id) ?></td>
                    <td><?= $this->Number->format($racingEvent->id_racing_types) ?></td>
                    <td><?= h($racingEvent->dt_schedule) ?></td>
                    <td><?= h($racingEvent->dt_created) ?></td>
                    <td><?= h($racingEvent->dt_modified) ?></td>
                    <td><?= h($racingEvent->bl_active) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $racingEvent->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $racingEvent->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $racingEvent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $racingEvent->id)]) ?>
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
