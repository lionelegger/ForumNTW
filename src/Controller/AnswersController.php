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
        $this->Auth->allow(['index', 'view', 'countAnswers', 'search']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Questions', 'Users']
        ];
        $answers = $this->paginate($this->Answers);

        $this->set(compact('answers'));
        $this->set('_serialize', ['answers']);
    }


    /**
     * countAnswers method
     *
     * @param string|null $question_id Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // This function returns the number of answers of a specific question
    public function countAnswers($question_id = null)
    {
        $query = $this->Answers->find();
        $query->where(['question_id' => $question_id]);
        $nbAnswers = $query->count();

        $this->set(compact('nbAnswers'));
        $this->set('_serialize', ['nbAnswers']);

    }

    // Search
    public function search()
    {
       $searchTxt = '%'.$this->request->query('searchTxt').'%';
       $answers = $this->Answers->find()->contain(['Questions', 'Users'])->where(['message LIKE' => $searchTxt]);

        $this->set(compact('answers'));
        $this->set('_serialize', ['answers']);

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

        // Tous les utilisateurs enregistrés peuvent ajouter des Réponses
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

//        return parent::isAuthorized($user);
    }

    // Getter for AnswersTable
    public function getAnswersTable() {
        return $this->Answers;
    }
}
