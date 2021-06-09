<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RacingType[]|\Cake\Collection\CollectionInterface $racingTypes
 */
?>
<div class="racingTypes index content">
    <?= $this->Html->link(__('New Racing Type'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Racing Types') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('ds_type') ?></th>
                    <th><?= $this->Paginator->sort('dt_created') ?></th>
                    <th><?= $this->Paginator->sort('dt_modified') ?></th>
                    <th><?= $this->Paginator->sort('bl_active') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($racingTypes as $racingType): ?>
                <tr>
                    <td><?= $this->Number->format($racingType->id) ?></td>
                    <td><?= h($racingType->ds_type) ?></td>
                    <td><?= h($racingType->dt_created) ?></td>
                    <td><?= h($racingType->dt_modified) ?></td>
                    <td><?= h($racingType->bl_active) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $racingType->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $racingType->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $racingType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $racingType->id)]) ?>
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
