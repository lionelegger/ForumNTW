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
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

/*switch (URL) {
    case "question":
        $this->_config['loginRedirect'] = "/#/questions";
        break;
    case "search":
        $this->_config['loginRedirect'] = "/#/search";
        break;
}*/

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->script('angular.js') ?>
    <?= $this->Html->script('angular-route.min.js') ?>
    <!--  Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <?= $this->Html->css('custom.css') ?>
</head>
<?php if ($userSession = $this->request->session()->read('Auth.User')) ; ?>
<body ng-app="myApp" ng-controller="MainCtrl">

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Lionel EGGER</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ng-class="{ active: isCurrentPath('/questions') }"><a href="#/questions">Questions <span class="sr-only">(current)</span></a></li>
                <li ng-class="{ active: isCurrentPath('/search') }"><a href="#/search">Search</a></li>
            </ul>

            <?php if($userSession): ?>
                <span class="hidden" id="userId" data-id="<?= $userSession['id'] ?>"></span>
                <form class="navbar-form navbar-right">
                    <button type="button" class="btn btn-default">
                        <!-- Todo: link on btn btn-default -->
                        <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?>
                    </button>
                </form>
                <p class="navbar-text navbar-right">Welcome <?= $userSession['name'] ?></p>
            <?php else: ?>
                <form class="navbar-form navbar-right" method="post" action="/users/login" accept-charset="utf-8" _lpchecked="1">
                    <div style="display:none;">
                        <input type="hidden" name="_method" value="POST">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>&nbsp;
                    <button type="button" class="btn btn-link pull-right" data-toggle="modal" data-target="#addUserModal">Register</button>
                </form>
            <?php endif; ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!-- ADD USER modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register a new user</h4>
            </div>
            <form method="post" accept-charset="utf-8" _lpchecked="1">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" ng-model="userToAdd.email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" ng-model="userToAdd.password">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Name" ng-model="userToAdd.name">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" id="role" ng-model="userToAdd.role">
                            <option value="admin">Admin</option>
                            <option value="author" selected>Author</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="addUser" ng-click="addUser()" data-dismiss="modal">Add</button>
                </div>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="container">
    <!--<p>LOGIN ID = *<span ng-bind="currentUserId"></span>*</p>-->
    <div ng-class="'alert alert-' + message().type" ng-show="message().show">
        <button type="button" class="close" ng-click="message().show = false">×</button>
        <msg key-expr="message().text"></msg>
    </div>
    <ng-view></ng-view>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<?= $this->Html->script('jquery.min.js') ?>
<!-- Latest compiled and minified Boostrap JavaScript -->
<?= $this->Html->script('bootstrap.min.js') ?>
<?= $this->Html->script('app.js') ?>
<?= $this->Html->script('controllers.js') ?>
<?= $this->Html->script('filters.js') ?>
<script>window.onload = initialize;</script>
</body>
</html>
