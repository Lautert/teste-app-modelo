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
            <?= $this->Html->link(__('List Runners'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="runners form content">
            <?= $this->Form->create($runner) ?>
            <fieldset>
                <legend><?= __('Add Runner') ?></legend>
                <?php
                    echo $this->Form->control('ds_name');
                    echo $this->Form->control('ds_document');
                    echo $this->Form->control('dt_birth');
                    echo $this->Form->control('dt_created', ['empty' => true]);
                    echo $this->Form->control('dt_modified', ['empty' => true]);
                    echo $this->Form->control('bl_active');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
