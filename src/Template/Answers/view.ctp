<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Answer'), ['action' => 'edit', $answer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Answer'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Answers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="answers view large-9 medium-8 columns content">
    <h3><?= h($answer->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Question') ?></th>
            <td><?= $answer->has('question') ? $this->Html->link($answer->question->title, ['controller' => 'Questions', 'action' => 'view', $answer->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $answer->has('user') ? $this->Html->link($answer->user->name, ['controller' => 'Users', 'action' => 'view', $answer->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Message') ?></th>
            <td><?= h($answer->message) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($answer->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($answer->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($answer->modified) ?></td>
        </tr>
    </table>
</div>
