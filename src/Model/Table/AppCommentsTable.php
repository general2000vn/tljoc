<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AppComments Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AcTypesTable&\Cake\ORM\Association\BelongsTo $AcTypes
 * @property \App\Model\Table\AcResultsTable&\Cake\ORM\Association\BelongsTo $AcResults
 * @property \App\Model\Table\AcStatusesTable&\Cake\ORM\Association\BelongsTo $AcStatuses
 * @property \App\Model\Table\AcModulesTable&\Cake\ORM\Association\BelongsTo $AcModules
 *
 * @method \App\Model\Entity\AppComment newEmptyEntity()
 * @method \App\Model\Entity\AppComment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AppComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AppComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\AppComment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AppComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AppComment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AppComment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppComment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppComment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppComment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppComment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppComment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AppCommentsTable extends Table
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

        $this->setTable('app_comments');
        $this->setDisplayField('brief');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AcTypes', [
            'foreignKey' => 'ac_type_id',
        ]);
        $this->belongsTo('AcResults', [
            'foreignKey' => 'ac_result_id',
        ]);
        $this->belongsTo('AcStatuses', [
            'foreignKey' => 'ac_status_id',
        ]);
        $this->belongsTo('AcModules', [
            'foreignKey' => 'ac_module_id',
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
            ->scalar('module')
            ->maxLength('module', 50)
            ->allowEmptyString('module');

        $validator
            ->scalar('page')
            ->maxLength('page', 50)
            ->allowEmptyString('page');

        $validator
            ->scalar('brief')
            ->maxLength('brief', 255)
            ->requirePresence('brief', 'create')
            ->notEmptyString('brief');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['ac_type_id'], 'AcTypes'), ['errorField' => 'ac_type_id']);
        //$rules->add($rules->existsIn(['ac_result_id'], 'AcResults'), ['errorField' => 'ac_result_id']);
        $rules->add($rules->existsIn(['ac_status_id'], 'AcStatuses'), ['errorField' => 'ac_status_id']);
        $rules->add($rules->existsIn(['ac_module_id'], 'AcModules'), ['errorField' => 'ac_module_id']);

        return $rules;
    }
}
