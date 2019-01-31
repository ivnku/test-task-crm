<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ClientsInterests Controller
 *
 * @property \App\Model\Table\ClientsInterestsTable $ClientsInterests
 *
 * @method \App\Model\Entity\ClientsInterest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsInterestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients', 'Interests']
        ];
        $clientsInterests = $this->paginate($this->ClientsInterests);

        $this->set(compact('clientsInterests'));
    }

    /**
     * View method
     *
     * @param string|null $id Clients Interest id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientsInterest = $this->ClientsInterests->get($id, [
            'contain' => ['Clients', 'Interests']
        ]);

        $this->set('clientsInterest', $clientsInterest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clientsInterest = $this->ClientsInterests->newEntity();
        if ($this->request->is('post')) {
            $clientsInterest = $this->ClientsInterests->patchEntity($clientsInterest, $this->request->getData());
            if ($this->ClientsInterests->save($clientsInterest)) {
                $this->Flash->success(__('The clients interest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clients interest could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsInterests->Clients->find('list', ['limit' => 200]);
        $interests = $this->ClientsInterests->Interests->find('list', ['limit' => 200]);
        $this->set(compact('clientsInterest', 'clients', 'interests'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clients Interest id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientsInterest = $this->ClientsInterests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientsInterest = $this->ClientsInterests->patchEntity($clientsInterest, $this->request->getData());
            if ($this->ClientsInterests->save($clientsInterest)) {
                $this->Flash->success(__('The clients interest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clients interest could not be saved. Please, try again.'));
        }
        $clients = $this->ClientsInterests->Clients->find('list', ['limit' => 200]);
        $interests = $this->ClientsInterests->Interests->find('list', ['limit' => 200]);
        $this->set(compact('clientsInterest', 'clients', 'interests'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clients Interest id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientsInterest = $this->ClientsInterests->get($id);
        if ($this->ClientsInterests->delete($clientsInterest)) {
            $this->Flash->success(__('The clients interest has been deleted.'));
        } else {
            $this->Flash->error(__('The clients interest could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
