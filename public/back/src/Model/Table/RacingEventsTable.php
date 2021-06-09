<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RacingEvents Model
 *
 * @method \App\Model\Entity\RacingEvent newEmptyEntity()
 * @method \App\Model\Entity\RacingEvent newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RacingEvent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RacingEvent get($primaryKey, $options = [])
 * @method \App\Model\Entity\RacingEvent findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RacingEvent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RacingEvent[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RacingEvent|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RacingEvent saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RacingEvent[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RacingEvent[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RacingEvent[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RacingEvent[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RacingEventsTable extends Table
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

        $this->setTable('racing_events');
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
            ->integer('id_racing_types')
            ->requirePresence('id_racing_types', 'create')
            ->notEmptyString('id_racing_types');

        $validator
            ->date('dt_schedule')
            ->requirePresence('dt_schedule', 'create')
            ->notEmptyDate('dt_schedule');

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
