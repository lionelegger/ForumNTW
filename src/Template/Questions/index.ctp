<?php if ($userSession = $this->request->session()->read('Auth.User')) ; ?>

<div class="questions index large-9 medium-8 columns content">
    <h3><?= __('Questions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
<!--                <th class="actions">--><?//= __('Actions') ?><!--</th>-->
                <?= ($userSession && $userSession['role'] !== 'user') ? '<th class="actions">Actions</th>' : '' ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question): ?>
            <tr>
                <td><?= $this->Number->format($question->id) ?></td>
<!--                <td>--><?//= $question->has('user') ? $this->Html->link($question->user->name, ['controller' => 'Users', 'action' => 'view', $question->user->id]) : '' ?><!--</td>-->
                <td><?= h($question->user->name) ?></td>
<!--                <td>--><?//= h($question->title) ?><!--</td>-->
                <td><?= $this->Html->link(h($question->title), ['action' => 'view', $question->id]) ?>
                <td><?= h($question->created) ?></td>
                <td><?= h($question->modified) ?></td>
                <?php if (($userSession && $userSession['role'] !== 'user')): ?>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $question->id]) ?> /
                        <?
                        if (($userSession && $userSession['id'] == $question->user->id)):
                            echo $this->Html->link(__('Edit'), ['action' => 'edit', $question->id]);
                            echo " / ";
                            echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]);
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
