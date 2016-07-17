<?php if ($userSession = $this->request->session()->read('Auth.User')) ; ?>
<div class="answers form large-9 medium-8 columns content">
    <?= $this->Form->create($answer) ?>
    <fieldset>
        <legend><?= __('Edit Answer') ?></legend>
        <?php
            if (($userSession && $userSession['role'] === 'admin')):
                echo $this->Form->input('question_id', ['options' => $questions]);
                echo $this->Form->input('user_id', ['options' => $users]);
            endif;
            echo $this->Form->input('message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
