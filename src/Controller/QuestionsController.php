<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 */
class QuestionsController extends AppController
{

    public function beforeFilter(Event $event){
        $this->Auth->allow(['index', 'view', 'search']);
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        // With pagination
        // $this->paginate = ['contain' => ['Users']];
        // $questions = $this->paginate($this->Questions);

        // Without pagination, order by modification date (+ get related Users)
        $questions = $this->Questions->find('all',['order' => ['Questions.modified' => 'DESC']])->contain(['Users']);

        // Create .json
        $this->set(compact('questions'));
        $this->set('_serialize', ['questions']);
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => [
                'Answers' => [
                    'Users',
                    'sort' => ['Answers.created' => 'ASC']
                ],
                'Users',
            ],
        ]);

        $this->set('question', $question);
        $this->set('_serialize', ['question']);

        if ($this->request->is('post')) {
            $this->loadModel('Answers');
            $answer = $this->Answers->newEntity();
            $answer = $this->Answers->patchEntity($answer, $this->request->data);
            $answer->question_id = $id;
            $answer->user_id = $this->Auth->user('id');
            if ($this->Answers->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('The answer could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            $question->user_id = $this->Auth->user('id');
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));
                return $this->redirect(['controller' => '/', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The question could not be saved. Please, try again.'));
            }
        }
        $users = $this->Questions->Users->find('list');
        $this->set(compact('question', 'users'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The question could not be saved. Please, try again.'));
            }
        }
        $users = $this->Questions->Users->find('list', ['limit' => 200]);
        $this->set(compact('question', 'users'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        // Admins peuvent effacer et éditer n'importe quelle question
        if ($user['role'] == 'admin') {
            return true;
        }

        // Tous les utilisateurs enregistrés peuvent ajouter des questions
        if ($this->request->action === 'add' && $user['role'] != 'user') {
            return true;
        }
        else
        // Le propriétaire d'une question peut l'éditer et le supprimer
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $questionId = (int)$this->request->params['pass'][0];
            if ($this->Questions->isOwnedBy($questionId, $user['id'])) {
                return true;
            }
        }

        return false;

//      return parent::isAuthorized($user);
    }

    // Search
    public function search()
    {
        $searchTxt = '%'.$this->request->query('searchTxt').'%';
        $questions = $this->Questions->find()->contain(['Users'])->where(['title LIKE' => $searchTxt])->orWhere(['body LIKE' => $searchTxt]);

        $this->set(compact('questions', 'users'));
        $this->set('_serialize', ['questions']);

    }

}
