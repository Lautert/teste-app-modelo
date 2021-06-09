<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RunnerRaceResults Controller
 *
 * @property \App\Model\Table\RunnerRaceResultsTable $RunnerRaceResults
 * @method \App\Model\Entity\RunnerRaceResult[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RunnerRaceResultsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $runnerRaceResults = $this->paginate($this->RunnerRaceResults);

        $this->set(compact('runnerRaceResults'));
    }

    /**
     * View method
     *
     * @param string|null $id Runner Race Result id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $runnerRaceResult = $this->RunnerRaceResults->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('runnerRaceResult'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $runnerRaceResult = $this->RunnerRaceResults->newEmptyEntity();
        if ($this->request->is('post')) {
            $runnerRaceResult = $this->RunnerRaceResults->patchEntity($runnerRaceResult, $this->request->getData());
            if ($this->RunnerRaceResults->save($runnerRaceResult)) {
                $this->Flash->success(__('The runner race result has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The runner race result could not be saved. Please, try again.'));
        }
        $this->set(compact('runnerRaceResult'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Runner Race Result id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $runnerRaceResult = $this->RunnerRaceResults->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $runnerRaceResult = $this->RunnerRaceResults->patchEntity($runnerRaceResult, $this->request->getData());
            if ($this->RunnerRaceResults->save($runnerRaceResult)) {
                $this->Flash->success(__('The runner race result has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The runner race result could not be saved. Please, try again.'));
        }
        $this->set(compact('runnerRaceResult'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Runner Race Result id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $runnerRaceResult = $this->RunnerRaceResults->get($id);
        if ($this->RunnerRaceResults->delete($runnerRaceResult)) {
            $this->Flash->success(__('The runner race result has been deleted.'));
        } else {
            $this->Flash->error(__('The runner race result could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
