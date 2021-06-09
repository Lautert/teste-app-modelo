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
            <?= $this->Html->link(__('List Runner Race Results'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="runnerRaceResults form content">
            <?= $this->Form->create($runnerRaceResult) ?>
            <fieldset>
                <legend><?= __('Add Runner Race Result') ?></legend>
                <?php
                    echo $this->Form->control('id_runner_race');
                    echo $this->Form->control('tm_start_time');
                    echo $this->Form->control('tm_end_time');
                    echo $this->Form->control('dt_created', ['empty' => true]);
                    echo $this->Form->control('dt_modified', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
