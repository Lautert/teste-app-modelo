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
                    throw new MessageUserException('[Fail] - Esta modalidade já esta cadastrada');
                } else {

                    $entityData = $this->RacingTypes->newEmptyEntity();
                    $entityData = $this->RacingTypes->patchEntity($entityData, $data);
                    try {
                        $this->RacingTypes->saveOrFail($entityData);
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

            $entityData = $this->RacingTypes->get($id);
            if ($this->RacingTypes->delete($entityData)) {
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
