<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Exception\MessageUserException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Cake\Validation\Validator;
use DateTime;
use Exception;

/**
 * RacingEvents Controller
 *
 * @property \App\Model\Table\RacingEventsTable $RacingEvents
 * @method \App\Model\Entity\RacingEvent[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RacingEventsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * List method
     *
     * @return JSON
     */
    public function list()
    {
        $this->RequestHandler->renderAs($this, 'json');

        $list = $this->RacingEvents->find('all');

        $this->set('list', $list);
        $this->set('_serialize', 'list');
        // $this->viewBuilder()
        //     ->setOption('serialize', ['RacingEvents']);
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
            $data = $this->RacingEvents->get($id);

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
                // Tipo
                ->requirePresence(['id_racing_types'], 'Informar a modalidade [id_racing_types]')
                ->notEmptyString('id_racing_types', 'Informar a modalidade')
                // Data
                ->requirePresence(['dt_schedule'])
                ->notEmptyDate('dt_schedule', 'Informe o campo com a data para o evento')
                ->add(
                    'dt_schedule',
                    'custom',
                    [
                        'rule' => ['date', 'ymd'],
                        'message' => 'A data informada não esta no formato correto [yyyy-mm-dd]',
                    ]
                );
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

                $result = $this->RacingEvents->find('all', [
                    'conditions' => [
                        "dt_schedule = '{$data['dt_schedule']}'",
                        "id_racing_types = {$data['id_racing_types']}"
                    ]
                ]);

                if (!empty($result->all()->toList())) {
                    throw new MessageUserException('[Fail] - Esta modalidade já esta cadastrada para esta data');
                } else {
                    $entityData = $this->RacingEvents->newEmptyEntity();
                    $entityData = $this->RacingEvents->patchEntity($entityData, $data);
                    try {
                        $this->RacingEvents->saveOrFail($entityData);
                        $this->set('message', 'Success');
                    } catch (PersistenceFailedException $e) {
                        throw new MessageUserException('[Fail] - Os dados não puderam ser salvos');
                    }
                }
            }
        } catch (MessageUserException $e) {
            $this->set('message', $e->getMessage());
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
                // Tipo
                ->notEmptyString('id_racing_types', 'Informar a modalidade')
                // Data
                ->notEmptyDate('dt_schedule', 'Informe o campo com a data para o evento')
                ->add(
                    'dt_schedule',
                    'custom',
                    [
                        'rule' => ['date', 'ymd'],
                        'message' => 'A data informada não esta no formato correto [yyyy-mm-dd]',
                    ]
                );
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

                if (!empty($data['dt_schedule']) && !empty($data['id_racing_types'])) {
                    $result = $this->RacingEvents->find('all', [
                        'conditions' => [
                            "dt_schedule = '{$data['dt_schedule']}'",
                            "id_racing_types = {$data['id_racing_types']}",
                            "id != {$id}"
                        ]
                    ]);

                    if (!empty($result->all()->toList())) {
                        throw new MessageUserException('[Fail] - Esta modalidade já esta cadastrada para esta data');
                    }
                }

                $entityData = $this->RacingEvents->get($id);
                $entityData = $this->RacingEvents->patchEntity($entityData, $data);
                try {
                    $this->RacingEvents->saveOrFail($entityData);
                    $this->set('message', 'Success');
                } catch (PersistenceFailedException $e) {
                    throw new MessageUserException('[Fail] - Os dados não puderam ser salvos');
                }
            }
        } catch (MessageUserException $e) {
            $this->set('message', $e->getMessage());
        } catch (RecordNotFoundException $e) {
            $this->set('message', '[Fail] - Esta modalidade não existe, ou não foi encontrada');
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

            $entityData = $this->RacingEvents->get($id);
            if ($this->RacingEvents->delete($entityData)) {
                $this->set('message', 'Success');
            } else {
                throw new MessageUserException('[Fail] - Os dados não puderam ser deletados');
            }
        } catch (MessageUserException $e) {
            $this->set('message', $e->getMessage());
        } catch (RecordNotFoundException $e) {
            $this->set('message', '[Fail] - Esta modalidade não existe, ou não foi encontrada');
        } catch (Exception $e) {
            if (preg_match("~.*Integrity constraint violation.*~", $e->getMessage())) {
                $this->set('message', '[Fail] - Este registro possui vinculos e não pode ser excluido');
            } else {
                $this->set('message', '[Fail] - Algo não saiu como esperado, por favor tente novamente mais tarde');
            }
        }
        $this->set('_serialize', 'message');
    }
}
