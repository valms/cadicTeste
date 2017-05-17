<?php
/**
 * Created by PhpStorm.
 * User: valmarjunior
 * Date: 17/05/17
 * Time: 13:52
 */

namespace App\Controller;


use Cake\Controller\Controller;
use Cake\Event\Event;

class HomeController extends Controller
{
    public $components = array('RequestHandler');
    public $helpers = array('Js');

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Estado');
        $this->loadModel('Cidade');
        return parent::beforeFilter($event); // TODO: Change the autogenerated stub
    }

    function index()
    {
        $this->set('title', 'Exemplo de select box dinamico com cidades e estados do Brasil');
        $this->set('estados', $this->Estado->find('list'));
    }

    public function listar_cidades_json()
    {
        $this->layout = false;
        if ($this->RequestHandler->isAjax()) {
            $this->set('cidades', $this->Cidade->find('list', array('conditions' =>
                    array('Cidade.estado_id' => $this->params['url']['estadoId']),
                    'recursive' => -1)
            ));
        }
    }


}