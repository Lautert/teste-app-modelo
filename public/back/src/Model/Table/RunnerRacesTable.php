<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RunnerRaces Model
 *
 * @method \App\Model\Entity\RunnerRace newEmptyEntity()
 * @method \App\Model\Entity\RunnerRace newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RunnerRace[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RunnerRace get($primaryKey, $options = [])
 * @method \App\Model\Entity\RunnerRace findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RunnerRace patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RunnerRace[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RunnerRace|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RunnerRace saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RunnerRace[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RunnerRace[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RunnerRace[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RunnerRace[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RunnerRacesTable extends Table
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

        $this->setTable('runner_races');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Runners', [
            'foreignKey' => 'id_runner',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('RacingEvents', [
            'foreignKey' => 'id_racing_event',
            'joinType' => 'INNER',
        ]);
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
            ->integer('id_runner')
            ->requirePresence('id_runner', 'create')
            ->notEmptyString('id_runner');

        $validator
            ->integer('id_racing_event')
            ->requirePresence('id_racing_event', 'create')
            ->notEmptyString('id_racing_event');

        $validator
            ->dateTime('dt_created')
            ->allowEmptyDateTime('dt_created');

        $validator
            ->dateTime('dt_modified')
            ->allowEmptyDateTime('dt_modified');

        $validator
            ->boolean('bl_active')
            ->notEmptyString('bl_active');

        return $validator;
    }
}
