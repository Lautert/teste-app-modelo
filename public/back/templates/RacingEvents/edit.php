<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RacingEvent $racingEvent
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $racingEvent->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $racingEvent->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Racing Events'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="racingEvents form content">
            <?= $this->Form->create($racingEvent) ?>
            <fieldset>
                <legend><?= __('Edit Racing Event') ?></legend>
                <?php
                    echo $this->Form->control('id_racing_types');
                    echo $this->Form->control('dt_schedule');
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
