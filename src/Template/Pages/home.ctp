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

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $this->fetch('title') ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <!--  Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <?= $this->Html->css('lionel.css') ?>
</head>
<?php if ($userSession = $this->request->session()->read('Auth.User')) ; ?>
<body ng-app="forumApp">
<div class="main container">
    <div class="row">
        <div class="col-md-12">
            <!--<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
                Login
            </button>-->
            <?php if($userSession): ?>
                <button type="button" class="btn btn-primary pull-right"><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></button>
                <button type="button" class="btn btn-link pull-right">Welcome <?= $userSession['name'] ?></button>
            <?php else: ?>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Login</button>
                <?/*= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) */?>
                <button type="button" class="btn btn-danger pull-right"><?= $this->Html->link(__('Register'), ['controller' => 'Users', 'action' => 'register']) ?></button>
            <?php endif; ?>
            <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Login</h4>
                        </div>
                        <form method="post" action="/users/login" accept-charset="utf-8" _lpchecked="1">
                            <div style="display:none;">
                                <input type="hidden" name="_method" value="POST">
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h1 class="title">Forum NWT</h1>
        </div>
        <div class="col-md-6" id="search">
            Search here
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div ng-controller="questionsController as questions">
                <p>{{questions.length}} questions :</p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Questions</th>
                        <th>Date</th>
                        <th>Answers</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="question in questions">
                        <td>{{question.id}}</td>
                        <td>{{question.title}}</td>
                        <td>{{question.created | date:'yyyy-MM-dd HH:mm:ss Z'}}</td>
                        <td>?? nombre de réponses ??</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified Boostrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/webroot/js/controller.js"></script>
<script>window.onload = initialize;</script>
</body>
</html>
