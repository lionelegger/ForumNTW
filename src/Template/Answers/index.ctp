<?php if ($userSession = $this->request->session()->read('Auth.User')) ; ?>

<div class="answers index large-9 medium-8 columns content">
    <h3><?= __('Answers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('question_id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('message') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <?= ($userSession && $userSession['role'] !== 'user') ? '<th class="actions">Actions</th>' : '' ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($answers as $answer): ?>
            <tr>
                <td><?= $this->Number->format($answer->id) ?></td>
                <td><?= $answer->has('question') ? $this->Html->link($answer->question->title, ['controller' => 'Questions', 'action' => 'view', $answer->question->id]) : '' ?></td>
                <td><?= $answer->has('user') ? $this->Html->link($answer->user->name, ['controller' => 'Users', 'action' => 'view', $answer->user->id]) : '' ?></td>
                <td><?= h($answer->message) ?></td>
                <td><?= h($answer->created) ?></td>
                <td><?= h($answer->modified) ?></td>
                <?php if (($userSession && $userSession['role'] !== 'user')): ?>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $answer->id]) ?> /
                        <?
                        if (($userSession && $userSession['id'] == $answer->user->id)):
                            echo $this->Html->link(__('Edit'), ['action' => 'edit', $answer->id]);
                            echo " / ";
                            echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]);
                        endif;
                        ?>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
