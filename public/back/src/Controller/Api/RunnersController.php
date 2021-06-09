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
     * List method
     *
     * @return JSON
     */
    public function list()
    {
        $this->RequestHandler->renderAs($this, 'json');

        $runners = $this->Runners->find('all');

        $this->set('runners', $runners);
        $this->set('_serialize', 'runners');
        // $this->viewBuilder()
        //     ->setOption('serialize', ['runners']);
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
            // $id = $this->request->getParam('id');

            $runner = $this->Runners->get($id);

            $this->set('runner', $runner);
        } catch (RecordNotFoundException $e) {
            $this->set('runner', []);
        }

        $this->set('_serialize', 'runner');
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
                // Nome no corredor
                ->requirePresence(['ds_name'])
                ->notEmptyString('ds_name', 'Informe o campo com nome do corredor')
                ->add('ds_name', [
                    'length' => [
                        'rule' => ['minLength', 3],
                        'message' => 'O nome do corredor deve ter ao menos 3 caracteres',
                    ]
                ])
                // Documento
                ->requirePresence(['ds_document'])
                ->notEmptyString('ds_document', 'Informe o campo com CPF do corredor')
                ->add(
                    'ds_document',
                    'custom',
                    [
                        'rule' => ['custom', '/^(\d{3}\.\d{3}\.\d{3}-\d{2})$/'],
                        'message' => 'O documento não esta no formato correto',
                    ]
                )
                // Data de nacimento
                ->requirePresence(['dt_birth'])
                ->notEmptyDate('dt_birth', 'Informe o campo com a data de nascimento')
                ->add(
                    'dt_birth',
                    'custom',
                    [
                        'rule' => ['date', 'ymd'],
                        'message' => 'A data informada não esta no formato correto [yyyy-mm-dd]',
                    ]
                )
                ->add(
                    'dt_birth',
                    'custom',
                    [
                        'rule' => function ($check) {
                            $date = new DateTime($check);
                            $today = new DateTime();

                            $diff = round(($today->getTimestamp() - $date->getTimestamp()) / 60 / 60 / 24 / 365);
                            return $diff > 18;
                        },
                        'message' => 'Apenas maiores de 18 anos podem participar',
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

                $result = $this->Runners->find('all', [
                    'conditions' => [
                        "ds_document = '{$data['ds_document']}'"
                    ]
                ]);

                // @TODO - CRIAR SISTEMA DE MSGS
                if (!empty($result->all()->toList())) {
                    throw new MessageUserException('[Fail] - Este documento já esta cadastrado em outro corredor');
                }

                $runner = $this->Runners->newEmptyEntity();
                $runner = $this->Runners->patchEntity($runner, $data);
                try {
                    $this->Runners->saveOrFail($runner);
                    $this->set('message', 'Success');
                } catch (PersistenceFailedException $e) {
                    throw new MessageUserException('[Fail] - Os dados não puderam ser salvos');
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
                // Nome no corredor
                ->notEmptyString('ds_name', 'Informe o campo com nome do corredor')
                ->add('ds_name', [
                    'length' => [
                        'rule' => ['minLength', 3],
                        'message' => 'O nome do corredor deve ter ao menos 3 caracteres',
                    ]
                ])
                // Documento
                ->notEmptyString('ds_document', 'Informe o campo com CPF do corredor')
                ->add(
                    'ds_document',
                    'custom',
                    [
                        'rule' => ['custom', '/^(\d{3}\.\d{3}\.\d{3}-\d{2})$/'],
                        'message' => 'O documento não esta no formato correto',
                    ]
                )
                // Data de nacimento
                ->notEmptyDate('dt_birth', 'Informe o campo com a data de nascimento')
                ->add(
                    'dt_birth',
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

                if (!empty($data['ds_document'])) {
                    $result = $this->Runners->find('all', [
                        'conditions' => [
                            "ds_document = '{$data['ds_document']}'",
                            "id != {$id}"
                        ]
                    ]);

                    if (!empty($result->all()->toList())) {
                        throw new MessageUserException('[Fail] - Este documento já esta cadastrado em outro corredor');
                    }
                }

                $runner = $this->Runners->get($id);
                $runner = $this->Runners->patchEntity($runner, $data);
                try {
                    $this->Runners->saveOrFail($runner);
                    $this->set('message', 'Success');
                } catch (PersistenceFailedException $e) {
                    throw new MessageUserException('[Fail] - Os dados não puderam ser salvos');
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

            $runner = $this->Runners->get($id);
            if ($this->Runners->delete($runner)) {
                $this->set('message', 'Success');
            } else {
                throw new MessageUserException('[Fail] - Os dados não puderam ser deletados');
            }
        } catch (MessageUserException $e) {
            $this->set('message', $e->getMessage());
        } catch (RecordNotFoundException $e) {
            $this->set('message', '[Fail] - Este corredor não existe, ou não foi encontrado');
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
