<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Runners Model
 *
 * @method \App\Model\Entity\Runner newEmptyEntity()
 * @method \App\Model\Entity\Runner newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Runner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Runner get($primaryKey, $options = [])
 * @method \App\Model\Entity\Runner findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Runner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Runner[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Runner|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Runner saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Runner[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Runner[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Runner[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Runner[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RunnersTable extends Table
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

        $this->setTable('runners');
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
            ->scalar('ds_name')
            ->maxLength('ds_name', 200)
            ->requirePresence('ds_name', 'create')
            ->notEmptyString('ds_name');

        $validator
            ->scalar('ds_document')
            ->maxLength('ds_document', 50)
            ->requirePresence('ds_document', 'create')
            ->notEmptyString('ds_document')
            ->add('ds_document', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->date('dt_birth')
            ->requirePresence('dt_birth', 'create')
            ->notEmptyDate('dt_birth');

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
        $rules->add($rules->isUnique(['ds_document']), ['errorField' => 'ds_document']);

        return $rules;
    }
}
