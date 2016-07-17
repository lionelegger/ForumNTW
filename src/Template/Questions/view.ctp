<?php if ($userSession = $this->request->session()->read('Auth.User')) ; ?>
<div class="questions view large-9 medium-8 columns content">
    <h3><?= h($question->title) ?></h3>
    <p><?= h($question->body) ?></p>
    <p>Written by <?= h($question->user->name) ?><small> <?= $question->created->nice('Europe/Paris', 'fr-FR') ?></small></p>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($question->body)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Answers') ?></h4>
        <?php if (!empty($question->answers)): ?>
            <?php foreach ($question->answers as $answer): ?>
                <p><small><?= h($answer->user->name) ?>, <?= $answer->created->nice('Europe/Paris', 'fr-FR') ?></small></p>
                <?php if (($userSession && $userSession['role'] === 'admin')): ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Answers', 'action' => 'edit', $answer->id]) ?> / <?= $this->Form->postLink(__('Delete'), ['controller' => 'Answers', 'action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?>
                <?php endif; ?>
                <p><?= h($answer->message) ?></p>
                <?
                if (($userSession && $userSession['id'] == $answer->user->id)):
                    echo $this->Html->link(__('Edit'), ['controller' => 'Answers', 'action' => 'edit', $answer->id]);

                    echo " / ";
                    echo $this->Form->postLink(__('Delete'), ['controller' => 'Answers', 'action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]);
                endif;
                ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php if ($userSession): ?>
        <div>
            <h4><?= __('Add a answer') ?></h4>
            <?= $this->Form->create('Answers') ?>
            <fieldset>
                <?php
                echo $this->Form->input('message');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Send')) ?>
            <?= $this->Form->end() ?>
        </div>
    <?php endif; ?>
</div>
