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
 * RunnerRaces Controller
 *
 * @property \App\Model\Table\RunnerRacesTable $RunnerRaces
 * @method \App\Model\Entity\RunnerRace[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RunnerRacesController extends AppController
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

        $list = $this->RunnerRaces->find('all');

        $this->set('list', $list);
        $this->set('_serialize', 'list');
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
            $data = $this->RunnerRaces->get($id);

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
                ->requirePresence(['id_runner'], 'Informe o corredor [id_runner]')
                ->notEmptyString('id_runner', 'Informe o campo com nome do corredor')
                ->requirePresence(['id_racing_event'], 'Informe o evento [id_racing_event]')
                ->notEmptyString('id_racing_event', 'Informe o campo com nome do corredor');
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

                $this->loadModel('RacingEvents');

                $racingEvent = $this->RacingEvents->get($data['id_racing_event']);
                $dtSchedule = $racingEvent->dt_schedule->format('Y-m-d');

                $racingEvents = $this->RacingEvents->find('all', [
                    'conditions' => [
                        "dt_schedule = DATE '{$dtSchedule}'"
                    ]
                ]);

                $ids = [];
                foreach ($racingEvents as $race) {
                    $ids[] = $race->id;
                }

                $result = $this->RunnerRaces->find('all', [
                    'conditions' => [
                        "id_runner = {$data['id_runner']}",
                        "id_racing_event IN" => $ids,
                        "id_racing_event != {$data['id_racing_event']}"
                    ]
                ]);

                if (!empty($result->all()->toList())) {
                    throw new MessageUserException('[Fail] - Este corredor já esta presente em outra corrida na mesma data');
                } else {

                    $entityData = $this->RunnerRaces->newEmptyEntity();
                    $entityData = $this->RunnerRaces->patchEntity($entityData, $data);
                    try {
                        $this->RunnerRaces->saveOrFail($entityData);
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
                ->notEmptyString('id_runner', 'Informe o campo com nome do corredor')
                ->notEmptyString('id_racing_event', 'Informe o campo com nome do corredor');
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
                $this->loadModel('RacingEvents');

                $runnerRace = $this->RunnerRaces->get($id);
                $idRunner = $runnerRace->id_runner;
                $idRacingEvent = $runnerRace->id_racing_event;

                if (!empty($data['id_runner'])) {
                    $idRunner = $data['id_runner'];
                }
                if (!empty($data['id_racing_event'])) {
                    $idRacingEvent = $data['id_racing_event'];
                }

                $racingEvent = $this->RacingEvents->get($idRacingEvent);
                $dtSchedule = $racingEvent->dt_schedule->format('Y-m-d');

                $racingEvents = $this->RacingEvents->find('all', [
                    'conditions' => [
                        "dt_schedule = DATE '{$dtSchedule}'"
                    ]
                ]);

                $ids = [];
                foreach ($racingEvents as $race) {
                    $ids[] = $race->id;
                }

                $result = $this->RunnerRaces->find('all', [
                    'conditions' => [
                        "id_runner = {$idRunner}",
                        "id_racing_event IN" => $ids,
                        "id != {$id}"
                    ]
                ]);

                if (!empty($result->all()->toList())) {
                    throw new MessageUserException('[Fail] - Este corredor já esta presente em outra corrida na mesma data');
                } else {

                    $entityData = $this->RunnerRaces->get($id);
                    $entityData = $this->RunnerRaces->patchEntity($entityData, $data);
                    try {
                        $this->RunnerRaces->saveOrFail($entityData);
                        $this->set('message', 'Success');
                    } catch (PersistenceFailedException $e) {
                        throw new MessageUserException('[Fail] - Os dados não puderam ser salvos');
                    }
                }
            }
        } catch (MessageUserException $e) {
            $this->set('message', $e->getMessage());
        } catch (RecordNotFoundException $e) {
            $this->set('message', '[Fail] - Esta modalidade não existe, ou não foi encontrada');
        } catch (Exception $e) {
            pr($e);
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

            $entityData = $this->RunnerRaces->get($id);
            if ($this->RunnerRaces->delete($entityData)) {
                $this->set('message', 'Success');
            } else {
                throw new MessageUserException('[Fail] - Os dados não puderam ser deletados');
            }
        } catch (MessageUserException $e) {
            $this->set('message', $e->getMessage());
        } catch (RecordNotFoundException $e) {
            $this->set('message', '[Fail] - Este registro não existe ou já foi excluido');
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
