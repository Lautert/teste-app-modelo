<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RunnerRaces Controller
 *
 * @property \App\Model\Table\RunnerRacesTable $RunnerRaces
 * @method \App\Model\Entity\RunnerRace[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RunnerRacesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $runnerRaces = $this->paginate($this->RunnerRaces);

        $this->set(compact('runnerRaces'));
    }

    /**
     * View method
     *
     * @param string|null $id Runner Race id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $runnerRace = $this->RunnerRaces->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('runnerRace'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $runnerRace = $this->RunnerRaces->newEmptyEntity();
        if ($this->request->is('post')) {
            $runnerRace = $this->RunnerRaces->patchEntity($runnerRace, $this->request->getData());
            if ($this->RunnerRaces->save($runnerRace)) {
                $this->Flash->success(__('The runner race has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The runner race could not be saved. Please, try again.'));
        }
        $this->set(compact('runnerRace'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Runner Race id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $runnerRace = $this->RunnerRaces->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $runnerRace = $this->RunnerRaces->patchEntity($runnerRace, $this->request->getData());
            if ($this->RunnerRaces->save($runnerRace)) {
                $this->Flash->success(__('The runner race has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The runner race could not be saved. Please, try again.'));
        }
        $this->set(compact('runnerRace'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Runner Race id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $runnerRace = $this->RunnerRaces->get($id);
        if ($this->RunnerRaces->delete($runnerRace)) {
            $this->Flash->success(__('The runner race has been deleted.'));
        } else {
            $this->Flash->error(__('The runner race could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
