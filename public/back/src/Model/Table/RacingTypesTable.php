<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RacingTypes Model
 *
 * @method \App\Model\Entity\RacingType newEmptyEntity()
 * @method \App\Model\Entity\RacingType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RacingType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RacingType get($primaryKey, $options = [])
 * @method \App\Model\Entity\RacingType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RacingType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RacingType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RacingType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RacingType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RacingType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RacingType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RacingType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RacingType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RacingTypesTable extends Table
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

        $this->setTable('racing_types');
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
            ->scalar('ds_type')
            ->maxLength('ds_type', 50)
            ->requirePresence('ds_type', 'create')
            ->notEmptyString('ds_type')
            ->add('ds_type', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['ds_type']), ['errorField' => 'ds_type']);

        return $rules;
    }
}
