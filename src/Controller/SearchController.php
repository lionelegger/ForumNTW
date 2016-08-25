<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use App\Controller\AnswersController;

class SearchController extends AppController {

    var $Answers;

    public function beforeFilter(Event $event){
        $this->Auth->allow(['index', 'search']);
        $this->Answers =& new AnswersController();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {



        // Get AnswersTable from AsnwersController
        $answers = $this->Answers->getAnswersTable();

        $pes = '%'.$this->request->query('searchTxt').'%';
        $query = $answers->find()->where(['message LIKE' => $pes]);

//        $resultArr = [];
//        foreach ($query as $result) {
//            array_push($resultArr, $result->message);
//        }
//
//        echo "<pre>";
//        print_r($resultArr);
//        echo "</pre>";
//        die();

        $this->set(compact('query'));
        $this->set('_serialize', ['query']);
    }
}
