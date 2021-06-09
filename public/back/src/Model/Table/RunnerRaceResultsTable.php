<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RunnerRaceResults Model
 *
 * @method \App\Model\Entity\RunnerRaceResult newEmptyEntity()
 * @method \App\Model\Entity\RunnerRaceResult newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RunnerRaceResult[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RunnerRaceResult get($primaryKey, $options = [])
 * @method \App\Model\Entity\RunnerRaceResult findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RunnerRaceResult patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RunnerRaceResult[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RunnerRaceResult|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RunnerRaceResult saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RunnerRaceResult[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RunnerRaceResult[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RunnerRaceResult[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RunnerRaceResult[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RunnerRaceResultsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('runner_race_results');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('id_runner_race')
            ->requirePresence('id_runner_race', 'create')
            ->notEmptyString('id_runner_race')
            ->add('id_runner_race', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('tm_start_time')
            ->requirePresence('tm_start_time', 'create')
            ->notEmptyDateTime('tm_start_time');

        $validator
            ->dateTime('tm_end_time')
            ->requirePresence('tm_end_time', 'create')
            ->notEmptyDateTime('tm_end_time');

        $validator
            ->dateTime('dt_created')
            ->allowEmptyDateTime('dt_created');

        $validator
            ->dateTime('dt_modified')
            ->allowEmptyDateTime('dt_modified');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['id_runner_race']), ['errorField' => 'id_runner_race']);

        return $rules;
    }
}
