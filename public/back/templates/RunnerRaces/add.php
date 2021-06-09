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
            <?= $this->Html->link(__('List Runner Races'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="runnerRaces form content">
            <?= $this->Form->create($runnerRace) ?>
            <fieldset>
                <legend><?= __('Add Runner Race') ?></legend>
                <?php
                    echo $this->Form->control('id_runner');
                    echo $this->Form->control('id_racing_event');
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
