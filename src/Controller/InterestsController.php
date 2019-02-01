<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Interests Controller
 *
 * @property \App\Model\Table\InterestsTable $Interests
 *
 * @method \App\Model\Entity\Interest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InterestsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $clients_model = TableRegistry::getTableLocator()->get('Clients');
        $statuses_model = TableRegistry::getTableLocator()->get('Statuses');

        $clients = $clients_model->find('all');
        $statuses = $statuses_model->find('all');
        $interest = $this->Interests->newEntity();                

        $this->set(compact('clients', 'statuses', 'interest'));
    }

    /**
     * Show the list of user's interests
     *
     * @param string $id
     * @return void
     */
    public function showAll($id)
    {
        $this->request->allowMethod('ajax');
        $this->response->withDisabledCache();

        $result = $this->Interests->getAll($id);

        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }    

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $interest = $this->Interests->newEntity();
        if ($this->request->is('post')) {
            $interest = $this->Interests->patchEntity($interest, $this->request->getData());
            if ($this->Interests->save($interest)) {
                $message = 'Интерес клиента был успешно добавлен.';
                $status = 'success';
                $this->set(compact('status', 'message'));
            } else {
                $message = 'Ошибка при добавлении интереса клиента.';
                $status = 'danger';
                $this->set(compact('status', 'message'));                
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Interest id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $interest = $this->Interests->get($id, [
            'contain' => ['Clients']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $interest = $this->Interests->patchEntity($interest, $this->request->getData());
            if (!$interest->isNew() and $this->Interests->save($interest)) {
                $message = 'Интерес клиента был успешно обновлен.';
                $status = 'success';
                $this->set(compact('status', 'message'));
            } else {
                $message = 'Ошибка при обновлении интереса клиента.';
                $status = 'danger';
                $this->set(compact('status', 'message'));
            }            
        }        
    }

    /**
     * Delete method
     *
     * @param string|null $id Interest id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $interest = $this->Interests->get($id);
        if ($this->Interests->delete($interest)) {
            $message = 'Интерес клиента был успешно удален.';
            $status = 'success';
            $this->set(compact('status', 'message'));
        } else {
            $message = 'Ошибка при удалении интереса клиента.';
            $status = 'danger';
            $this->set(compact('status', 'message'));
        }
    }
}
