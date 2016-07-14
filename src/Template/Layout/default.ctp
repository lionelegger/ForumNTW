<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<?php if ($userSession = $this->request->session()->read('Auth.User')) ; ?>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php if($userSession): ?>
                    <li><a>Welcome <?= $userSession['name'] ?></a></li>
                    <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
                <?php else: ?>
                    <li><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></li>
                    <li><?= $this->Html->link(__('Register'), ['controller' => 'Users', 'action' => 'register']) ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
<!--    --><?//= $this->Flash->render('auth') ?>
    <div class="container clearfix">
        <nav class="large-3 medium-4 columns" id="actions-sidebar">
            <ul class="side-nav">
                <li class="heading"><?= __('Menu') ?></li>
                <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
                <?php if ($userSession && $userSession['role'] !== 'user') { ?>
                    <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
                    <?php if ($userSession['role'] === 'admin') { ?>
                        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </nav>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
