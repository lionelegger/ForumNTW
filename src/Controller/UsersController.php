<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['logout']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout']);
    }

    public function current() {
        $this->set('user', $this->request->session()->read('Auth.User'));
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                // return $this->redirect($this->Auth->redirectUrl());
                // Todo: To be improved.... redirection hardcoded...
                return $this->redirect($this->Auth->redirectUrl("/#/questions"));
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user)
    {
        return true;
    }

}
