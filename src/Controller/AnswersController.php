<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

/**
 * Answers Controller
 *
 * @property \App\Model\Table\AnswersTable $Answers
 */
class AnswersController extends AppController
{
    public function beforeFilter(Event $event){
        $this->Auth->allow(['index', 'view', 'search']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        // With pagination
        //$this->paginate = ['contain' => ['Questions', 'Users']];
        //$answers = $this->paginate($this->Answers);

        // Without pagination (get Questions and Users)
        $answers = $this->Answers->find('all')->contain(['Questions', 'Users']);
//        $answers = $this->Answers->find('all',['order' => ['Answers.modified' => 'ASC']])->contain(['Questions', 'Users']);

        // Create .json
        $this->set(compact('answers'));
        $this->set('_serialize', ['answers']);
    }


    // Search
    public function search()
    {
       $searchTxt = '%'.$this->request->query('searchTxt').'%';
       $answers = $this->Answers->find()->contain(['Questions', 'Users'])->where(['message LIKE' => $searchTxt]);

//        TODO: get also the name of the user in the json file when http://localhost:8888/answers/search.json?searchTxt=cool
        $this->set(compact('answers', 'users'));
        $this->set('_serialize', ['answers', 'users']);

    }

    /**
     * View method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $answer = $this->Answers->get($id, [
            'contain' => ['Questions', 'Users']
        ]);

        $this->set('answer', $answer);
        $this->set('_serialize', ['answer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $answer = $this->Answers->newEntity();
        if ($this->request->is('post')) {
            $answer = $this->Answers->patchEntity($answer, $this->request->data);
            if ($this->Answers->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The answer could not be saved. Please, try again.'));
            }
        }
        $questions = $this->Answers->Questions->find('list', ['limit' => 200]);
        $users = $this->Answers->Users->find('list', ['limit' => 200]);
        $this->set(compact('answer', 'questions', 'users'));
        $this->set('_serialize', ['answer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $answer = $this->Answers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $answer = $this->Answers->patchEntity($answer, $this->request->data);
            if ($this->Answers->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The answer could not be saved. Please, try again.'));
            }
        }
        $questions = $this->Answers->Questions->find('list', ['limit' => 200]);
        $users = $this->Answers->Users->find('list', ['limit' => 200]);
        $this->set(compact('answer', 'questions', 'users'));
        $this->set('_serialize', ['answer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $answer = $this->Answers->get($id);
        if ($this->Answers->delete($answer)) {
            $this->Flash->success(__('The answer has been deleted.'));
        } else {
            $this->Flash->error(__('The answer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function isAuthorized($user)
    {
        // Admins peuvent effacer et éditer n'importe quelle réponse
        if ($user['role'] == 'admin') {
            return true;
        }

        // Tous les utilisateurs enregistrés peuvent ajouter des réponses
        if ($this->request->action === 'add' && $user['role'] != 'user') {
            return true;
        }
        else
        // Le propriétaire d'une réponse peut l'éditer et le supprimer
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $answerId = (int)$this->request->params['pass'][0];
            if ($this->Answers->isOwnedBy($answerId, $user['id'])) {
                return true;
            }
        }

        return false;

    }
}
