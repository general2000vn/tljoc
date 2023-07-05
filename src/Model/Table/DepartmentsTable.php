<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Departments Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Managers
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Dlms
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $ParentDepartments
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\HasMany $ChildDepartments
 * @property \App\Model\Table\DocOutgoingsTable&\Cake\ORM\Association\HasMany $DocOutgoings
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Department newEmptyEntity()
 * @method \App\Model\Entity\Department newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Department[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Department get($primaryKey, $options = [])
 * @method \App\Model\Entity\Department findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Department patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Department[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Department|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Department saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Department[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Department[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Department[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Department[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DepartmentsTable extends Table
{
    const D_MGT = 1;
    const D_DRI = 2;
    const D_SUB = 3;
    const D_ADM = 4;
    const D_OPS = 5;
    const D_FIN = 6;
    const D_HSE = 7;
    const D_HR = 8;
    const D_PRO = 9;
    
    
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('departments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Managers',[
            'className' => 'Users',
            'foreignKey' => 'user_id',
        ]);

        $this->belongsTo('Dlms',[
            'className' => 'Users',
            'foreignKey' => 'dlm_id',
        ]);

        $this->belongsTo('ParentDepartments', [
            'className' => 'Departments',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildDepartments', [
            'className' => 'Departments',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('DocOutgoings', [
            'foreignKey' => 'department_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'department_id',
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
            ->scalar('name')
            ->maxLength('name', 30)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('init')
            ->maxLength('init', 5)
            ->requirePresence('init', 'create')
            ->notEmptyString('init');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentDepartments'), ['errorField' => 'parent_id']);

        return $rules;
    }

    public function getLineManager($deptID){
        $dept = $this->get($deptID, ['contain' => ['Managers']]);
        return $dept->manager;
    }

    public function getDeputyManager($deptID){
        $dept = $this->get($deptID, ['contain' => ['Dlms']]);
        return $dept->dlm;
    }
}
