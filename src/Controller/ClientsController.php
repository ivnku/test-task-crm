<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 *
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
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
        $clients = $this->Clients->find('all');
        $this->set(compact('clients'));
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => ['Interests']
        ]);

        $this->set('client', $client);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->autoRender = false;
        $client = $this->Clients->newEntity();
        
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('Клиент успешно добавлен.'));
            } else {
                $this->Flash->error(__('Не удалось создать клиента, клиент с таким телефоном или email уже существует!'));
            }
            return $this->redirect(['action' => 'index']);
        }
        // $interests = $this->Clients->Interests->find('list', ['limit' => 200]);
        // $this->set(compact('client', 'interests'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->autoRender = false;
        $client = $this->Clients->get($id, [
            'contain' => ['Interests']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('Клиент успешно сохранен.'));
            } else {
                $this->Flash->error(__('Клиент не может быть сохранен. Попробуйте еще раз.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        // $interests = $this->Clients->Interests->find('list', ['limit' => 200]);
        // $this->set(compact('client', 'interests'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('Клиент успешно удален.'));
        } else {
            $this->Flash->error(__('Клиент не может быть удален. Попробуйте еще раз.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
