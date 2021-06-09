<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Runners Controller
 *
 * @property \App\Model\Table\RunnersTable $Runners
 * @method \App\Model\Entity\Runner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RunnersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $runners = $this->paginate($this->Runners);

        $this->set(compact('runners'));
    }

    /**
     * View method
     *
     * @param string|null $id Runner id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $runner = $this->Runners->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('runner'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $runner = $this->Runners->newEmptyEntity();
        if ($this->request->is('post')) {
            $runner = $this->Runners->patchEntity($runner, $this->request->getData());
            if ($this->Runners->save($runner)) {
                $this->Flash->success(__('The runner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The runner could not be saved. Please, try again.'));
        }
        $this->set(compact('runner'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Runner id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $runner = $this->Runners->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $runner = $this->Runners->patchEntity($runner, $this->request->getData());
            if ($this->Runners->save($runner)) {
                $this->Flash->success(__('The runner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The runner could not be saved. Please, try again.'));
        }
        $this->set(compact('runner'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Runner id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $runner = $this->Runners->get($id);
        if ($this->Runners->delete($runner)) {
            $this->Flash->success(__('The runner has been deleted.'));
        } else {
            $this->Flash->error(__('The runner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
