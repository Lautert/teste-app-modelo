<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Exception\MessageUserException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Cake\Validation\Validator;
use DateTime;
use Exception;

/**
 * RacingTypes Controller
 *
 * @property \App\Model\Table\RacingTypesTable $RacingTypes
 * @method \App\Model\Entity\RacingType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RacingTypesController extends AppController
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
        $racingTypes = $this->paginate($this->RacingTypes);

        $this->set(compact('racingTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Racing Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $racingType = $this->RacingTypes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('racingType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $racingType = $this->RacingTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $racingType = $this->RacingTypes->patchEntity($racingType, $this->request->getData());
            if ($this->RacingTypes->save($racingType)) {
                $this->Flash->success(__('The racing type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The racing type could not be saved. Please, try again.'));
        }
        $this->set(compact('racingType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Racing Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $racingType = $this->RacingTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $racingType = $this->RacingTypes->patchEntity($racingType, $this->request->getData());
            if ($this->RacingTypes->save($racingType)) {
                $this->Flash->success(__('The racing type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The racing type could not be saved. Please, try again.'));
        }
        $this->set(compact('racingType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Racing Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $racingType = $this->RacingTypes->get($id);
        if ($this->RacingTypes->delete($racingType)) {
            $this->Flash->success(__('The racing type has been deleted.'));
        } else {
            $this->Flash->error(__('The racing type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**************************************************************************/
    /****************************** API RESTFULL ******************************/
    /**************************************************************************/


    /**
     * List method
     *
     * @return JSON
     */
    public function list()
    {
        $this->RequestHandler->renderAs($this, 'json');

        $list = $this->RacingTypes->find('all');

        $this->set('list', $list);
        $this->set('_serialize', 'list');
        // $this->viewBuilder()
        //     ->setOption('serialize', ['RacingTypes']);
    }

    /**
     * List method
     *
     * @return JSON
     */
    public function get($id = null)
    {
        $this->RequestHandler->renderAs($this, 'json');

        try {
            $data = $this->RacingTypes->get($id);

            $this->set('data', $data);
        } catch (RecordNotFoundException $e) {
            $this->set('data', []);
        }
        $this->set('_serialize', 'data');
    }

    /**
     * Insert method
     *
     * @return JSON
     */
    public function insert()
    {
        $this->RequestHandler->renderAs($this, 'json');

        try {
            $this->request->allowMethod(['post']);

            $data = $this->request->getData();
            $data['dt_created'] = new DateTime();

            $validator = new Validator();
            $validator
                // Nome
                ->requirePresence(['ds_type'])
                ->notEmptyString('ds_type', 'Informa o tipo')
                ->add('ds_type', [
                    'length' => [
                        'rule' => ['minLength', 3],
                        'message' => 'O tipo da corrida deve ter ao menos 3 caracteres',
                    ]
                ]);
            $validateResult = $validator->validate($data);

            if (!empty($validateResult)) {
                $messages = [];
                foreach ($validateResult as $errors) {
                    foreach ($errors as $text) {
                        $messages[] = $text;
                    }
                }
                $this->set('message', implode("\n", $messages));
            } else {

                $result = $this->RacingTypes->find('all', [
                    'conditions' => [
                        "ds_type = '{$data['ds_type']}'"
                    ]
                ]);

                if (!empty($result->all()->toList())) {
                    $this->set('message', '[Fail] - Esta modalidade já esta cadastrada');
                } else {

                    $entityData = $this->RacingTypes->newEmptyEntity();
                    $entityData = $this->RacingTypes->patchEntity($entityData, $data);
                    try {
                        $this->RacingTypes->saveOrFail($entityData);
                        $this->set('message', 'Success');
                    } catch (PersistenceFailedException $e) {
                        $this->set('message', '[Fail] - Os dados não puderam ser salvos');
                    }
                }
            }
        } catch (Exception $e) {
            $this->set('message', '[Fail] - Algo não saiu como esperado, por favor tente novamente mais tarde');
        }
        $this->set('_serialize', 'message');
    }

    /**
     * Update method
     *
     * @return JSON
     */
    public function update($id = null)
    {
        $this->RequestHandler->renderAs($this, 'json');

        try {
            $this->request->allowMethod(['put']);

            $data = $this->request->getData();
            $data['dt_modified'] = new DateTime();

            $validator = new Validator();
            $validator
                // Nome
                ->requirePresence(['ds_type'])
                ->notEmptyString('ds_type', 'Informa o tipo')
                ->add('ds_type', [
                    'length' => [
                        'rule' => ['minLength', 3],
                        'message' => 'O tipo da corrida deve ter ao menos 3 caracteres',
                    ]
                ]);
            $validateResult = $validator->validate($data);

            if (!empty($validateResult)) {
                $messages = [];
                foreach ($validateResult as $errors) {
                    foreach ($errors as $text) {
                        $messages[] = $text;
                    }
                }
                $this->set('message', implode("\n", $messages));
            } else {

                if (!empty($data['ds_type'])) {
                    $result = $this->RacingTypes->find('all', [
                        'conditions' => [
                            "ds_type = '{$data['ds_type']}'",
                            "id != {$id}"
                        ]
                    ]);

                    if (!empty($result->all()->toList())) {
                        throw new MessageUserException('[Fail] - Esta modalidade já esta cadastrada');
                    }
                }

                $entityData = $this->RacingTypes->get($id);
                $entityData = $this->RacingTypes->patchEntity($entityData, $data);
                try {
                    $this->RacingTypes->saveOrFail($entityData);
                    $this->set('message', 'Success');
                } catch (PersistenceFailedException $e) {
                    $this->set('message', '[Fail] - Os dados não puderam ser salvos');
                }
            }
        } catch (MessageUserException $e) {
            $this->set('message', $e->getMessage());
        } catch (RecordNotFoundException $e) {
            $this->set('message', '[Fail] - Este corredor não existe, ou não foi encontrado');
        } catch (Exception $e) {
            $this->set('message', '[Fail] - Algo não saiu como esperado, por favor tente novamente mais tarde');
        }
        $this->set('_serialize', 'message');
    }

    /**
     * Delete method
     *
     * @return JSON
     */
    public function del($id = null)
    {
        $this->RequestHandler->renderAs($this, 'json');

        try {
            $this->request->allowMethod(['delete']);

            $entityData = $this->RacingTypes->get($id);
            if ($this->RacingTypes->delete($entityData)) {
                $this->set('message', 'Success');
            } else {
                $this->set('message', '[Fail] - Os dados não puderam ser deletados');
            }
        } catch (Exception $e) {
            $this->set('message', '[Fail] - Algo não saiu como esperado, por favor tente novamente mais tarde');
        }
        $this->set('_serialize', 'message');
    }
}
