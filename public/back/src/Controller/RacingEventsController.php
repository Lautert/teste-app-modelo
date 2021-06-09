<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RacingEvents Controller
 *
 * @property \App\Model\Table\RacingEventsTable $RacingEvents
 * @method \App\Model\Entity\RacingEvent[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RacingEventsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $racingEvents = $this->paginate($this->RacingEvents);

        $this->set(compact('racingEvents'));
    }

    /**
     * View method
     *
     * @param string|null $id Racing Event id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $racingEvent = $this->RacingEvents->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('racingEvent'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $racingEvent = $this->RacingEvents->newEmptyEntity();
        if ($this->request->is('post')) {
            $racingEvent = $this->RacingEvents->patchEntity($racingEvent, $this->request->getData());
            if ($this->RacingEvents->save($racingEvent)) {
                $this->Flash->success(__('The racing event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The racing event could not be saved. Please, try again.'));
        }
        $this->set(compact('racingEvent'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Racing Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $racingEvent = $this->RacingEvents->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $racingEvent = $this->RacingEvents->patchEntity($racingEvent, $this->request->getData());
            if ($this->RacingEvents->save($racingEvent)) {
                $this->Flash->success(__('The racing event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The racing event could not be saved. Please, try again.'));
        }
        $this->set(compact('racingEvent'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Racing Event id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $racingEvent = $this->RacingEvents->get($id);
        if ($this->RacingEvents->delete($racingEvent)) {
            $this->Flash->success(__('The racing event has been deleted.'));
        } else {
            $this->Flash->error(__('The racing event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
