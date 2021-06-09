<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Runner[]|\Cake\Collection\CollectionInterface $runners
 */
?>
<div class="runners index content">
    <?= $this->Html->link(__('New Runner'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Runners') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('ds_name') ?></th>
                    <th><?= $this->Paginator->sort('ds_document') ?></th>
                    <th><?= $this->Paginator->sort('dt_birth') ?></th>
                    <th><?= $this->Paginator->sort('dt_created') ?></th>
                    <th><?= $this->Paginator->sort('dt_modified') ?></th>
                    <th><?= $this->Paginator->sort('bl_active') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($runners as $runner): ?>
                <tr>
                    <td><?= $this->Number->format($runner->id) ?></td>
                    <td><?= h($runner->ds_name) ?></td>
                    <td><?= h($runner->ds_document) ?></td>
                    <td><?= h($runner->dt_birth) ?></td>
                    <td><?= h($runner->dt_created) ?></td>
                    <td><?= h($runner->dt_modified) ?></td>
                    <td><?= h($runner->bl_active) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $runner->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $runner->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $runner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $runner->id)]) ?>
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
