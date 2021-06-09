<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Exception\MessageUserException;
use Cake\Datasource\ConnectionManager;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\I18n\Time;
use Cake\ORM\Exception\PersistenceFailedException;
use Cake\Validation\Validator;
use DateTime;
use Exception;

/**
 * RunnerRaceResults Controller
 *
 * @property \App\Model\Table\RunnerRaceResultsTable $RunnerRaceResults
 * @method \App\Model\Entity\RunnerRaceResult[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RunnerRaceResultsController extends AppController
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

        $list = $this->RunnerRaceResults->find('all');

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
            $data = $this->RunnerRaceResults->get($id);

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
                ->requirePresence(['id_runner_race'], 'Informar a inscrição [id_runner_race]')
                ->notEmptyString('id_runner_race', 'Informar a inscrição')
                ->requirePresence(['tm_start_time'], 'Informe a data e hora de inicio [tm_start_time]')
                ->notEmptyDateTime('tm_start_time', 'Informe a data e hora de inicio')
                ->add(
                    'tm_start_time',
                    'custom',
                    [
                        'rule' => ['datetime', 'ymd'],
                        'message' => 'A data informada não esta no formato correto [yyyy-mm-dd hh:ii:ss]',
                    ]
                )
                ->requirePresence(['tm_end_time'], 'Informe a data e hora de termino [tm_end_time]')
                ->notEmptyDateTime('tm_end_time', 'Informe a data e hora de termino')
                ->add(
                    'tm_end_time',
                    'custom',
                    [
                        'rule' => ['datetime', 'ymd'],
                        'message' => 'A data informada não esta no formato correto [yyyy-mm-dd hh:ii:ss]',
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

                $tmStart = new DateTime($data['tm_start_time']);
                $tmEnd = new DateTime($data['tm_end_time']);

                $diff = $tmEnd->getTimestamp() - $tmStart->getTimestamp();

                if ($diff < 0) {
                    throw new MessageUserException("Data de inicio superior a data de termino");
                }

                $result = $this->RunnerRaceResults->find('all', [
                    'conditions' => [
                        "id_runner_race = '{$data['id_runner_race']}'"
                    ]
                ]);

                if (!empty($result->all()->toList())) {
                    throw new MessageUserException('[Fail] - Já existe um resultado para este corredor');
                } else {

                    $entityData = $this->RunnerRaceResults->newEmptyEntity();
                    $entityData = $this->RunnerRaceResults->patchEntity($entityData, $data);
                    try {
                        $this->RunnerRaceResults->saveOrFail($entityData);
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
                ->notEmptyString('id_runner_race', 'Informar a inscrição')
                ->notEmptyDateTime('tm_start_time', 'Informe a data e hora de inicio')
                ->add(
                    'tm_start_time',
                    'custom',
                    [
                        'rule' => ['datetime', 'ymd'],
                        'message' => 'A data informada não esta no formato correto [yyyy-mm-dd hh:ii:ss]',
                    ]
                )
                ->notEmptyDateTime('tm_end_time', 'Informe a data e hora de termino')
                ->add(
                    'tm_end_time',
                    'custom',
                    [
                        'rule' => ['datetime', 'ymd'],
                        'message' => 'A data informada não esta no formato correto [yyyy-mm-dd hh:ii:ss]',
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

                $runnerRaceResult = $this->RunnerRaceResults->get($id);
                $tmStartTime = $runnerRaceResult->tm_start_time;
                $tmEndTime = $runnerRaceResult->tm_end_time;

                if (!empty($data['tm_start_time'])) {
                    $tmStartTime = new DateTime($data['tm_start_time']);
                }

                if (!empty($data['tm_end_time'])) {
                    $tmEndTime = new DateTime($data['tm_end_time']);
                }
                $diff = $tmEndTime->getTimestamp() - $tmStartTime->getTimestamp();

                if ($diff < 0) {
                    throw new MessageUserException("Data de inicio superior a data de termino");
                }

                $result = $this->RunnerRaceResults->find('all', [
                    'conditions' => [
                        "id_runner_race = '{$data['id_runner_race']}'",
                        "id != {$id}"
                    ]
                ]);

                if (!empty($result->all()->toList())) {
                    throw new MessageUserException('[Fail] - Já existe um resultado para este corredor');
                }

                $entityData = $this->RunnerRaceResults->get($id);
                $entityData = $this->RunnerRaceResults->patchEntity($entityData, $data);
                try {
                    $this->RunnerRaceResults->saveOrFail($entityData);
                    $this->set('message', 'Success');
                } catch (PersistenceFailedException $e) {
                    throw new MessageUserException('[Fail] - Os dados não puderam ser salvos');
                }
            }
        } catch (MessageUserException $e) {
            $this->set('message', $e->getMessage());
        } catch (RecordNotFoundException $e) {
            $this->set('message', '[Fail] - Resultados desejados não foram encontrados');
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

            $entityData = $this->RunnerRaceResults->get($id);
            if ($this->RunnerRaceResults->delete($entityData)) {
                $this->set('message', 'Success');
            } else {
                throw new MessageUserException('[Fail] - Os dados não puderam ser deletados');
            }
        } catch (MessageUserException $e) {
            $this->set('message', $e->getMessage());
        } catch (RecordNotFoundException $e) {
            $this->set('message', '[Fail] - Resultados desejados não foram encontrados');
        } catch (Exception $e) {
            if (preg_match("~.*Integrity constraint violation.*~", $e->getMessage())) {
                $this->set('message', '[Fail] - Este registro possui vinculos e não pode ser excluido');
            } else {
                $this->set('message', '[Fail] - Algo não saiu como esperado, por favor tente novamente mais tarde');
            }
        }
        $this->set('_serialize', 'message');
    }

    /**
     * ResultsByAgeRange method
     *
     * @return JSON
     */
    public function resultsByAgeRange()
    {
        $this->RequestHandler->renderAs($this, 'json');

        $query = <<<EOF
SELECT
	rank,
	faixa,
	id_prova,
    tipo,
    id_runner,
    nr_runner_age,
    ds_nunner_name
FROM
	(
		SELECT
			(CASE results_faixa.id_prova
				WHEN @curId THEN
					(CASE results_faixa.faixa
						WHEN @curFaixa THEN @curRow := @curRow + 1
						ELSE @curRow := 1
					END)
                ELSE @curRow := 1
			END) AS rank,
			@curFaixa := results_faixa.faixa as nt_f,
			@curId := results_faixa.id_prova as nt_p,
			results_faixa.*
		FROM (
			SELECT
				re.id AS id_prova,
				rt.ds_type AS tipo,
				r.id AS id_runner,
				r.age AS nr_runner_age,
				r.ds_name AS ds_nunner_name,
				rrr.time,
				r.age,
				rf.faixa
			FROM
				runner_races rr
				INNER JOIN (
					SELECT TIMESTAMPDIFF(YEAR, r.dt_birth, CURDATE()) AS age, r.* FROM runners r
				) r ON r.id = rr.id_runner
				INNER JOIN racing_events re ON re.id = rr.id_racing_event
				INNER JOIN racing_types rt ON rt.id = re.id_racing_types
				INNER JOIN (
					SELECT rrr.tm_end_time - rrr.tm_start_time AS time, rrr.* from runner_race_results rrr
				) rrr ON rrr.id_runner_race = rr.id
				INNER JOIN (
					-- IDEAL DE FOSSE UM TABELA, PODENDO AINDA MELHORAR AS FAIXAS
					SELECT 18 as min, 25 as max, '18 – 25 anos' as faixa UNION
					select 25, 35, '25 – 35 anos' UNION
					select 35, 45, '35 – 45 anos' UNION
					select 45, 55, '45 – 55 anos' UNION
					select 55, 999, 'Acima de 55 anos'
				) rf ON age >= rf.min AND age < rf.max
			ORDER BY
				rf.faixa,
				rrr.time asc
		) AS results_faixa
			JOIN (SELECT @curRow := 0, @curFaixa := '', @curId := 0) rn
	) AS results_faixa_rank
ORDER BY
	faixa,
	rank
EOF;
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute($query);
        $data = $stmt->fetchAll('assoc');

        $this->set('data_result', $data);

        $this->set('_serialize', 'data_result');
    }

    /**
     * ResultsByRace method
     *
     * @return JSON
     */
    public function resultsByRace()
    {
        $this->RequestHandler->renderAs($this, 'json');

        $query = <<<EOF
SELECT
	rank,
	id_prova,
    tipo,
    id_runner,
    nr_runner_age,
    ds_nunner_name
FROM
	(
		SELECT
			(CASE results_faixa.id_prova
				WHEN @curId THEN @curRow := @curRow + 1
                ELSE @curRow := 1
			END) AS rank,
			@curId := results_faixa.id_prova as nt_p,
			results_faixa.*
		FROM (
			SELECT
				re.id AS id_prova,
				rt.ds_type AS tipo,
				r.id AS id_runner,
				r.age AS nr_runner_age,
				r.ds_name AS ds_nunner_name,
				rrr.time,
				r.age
			FROM
				runner_races rr
				INNER JOIN (
					SELECT TIMESTAMPDIFF(YEAR, r.dt_birth, CURDATE()) AS age, r.* FROM runners r
				) r ON r.id = rr.id_runner
				INNER JOIN racing_events re ON re.id = rr.id_racing_event
				INNER JOIN racing_types rt ON rt.id = re.id_racing_types
				INNER JOIN (
					SELECT rrr.tm_end_time - rrr.tm_start_time AS time, rrr.* from runner_race_results rrr
				) rrr ON rrr.id_runner_race = rr.id
			ORDER BY
				rrr.time ASC
		) AS results_faixa
			JOIN (SELECT @curRow := 0, @curId := 0) rn
		ORDER BY
			results_faixa.id_prova
	) AS results_faixa_rank
ORDER BY
	id_prova,
	rank
EOF;
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute($query);
        $data = $stmt->fetchAll('assoc');

        $this->set('data_result', $data);

        $this->set('_serialize', 'data_result');
    }
}
