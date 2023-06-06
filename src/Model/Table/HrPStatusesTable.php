<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HrPStatuses Model
 *
 * @property \App\Model\Table\HrPtsTable&\Cake\ORM\Association\HasMany $HrPts
 *
 * @method \App\Model\Entity\HrPStatus newEmptyEntity()
 * @method \App\Model\Entity\HrPStatus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\HrPStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HrPStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\HrPStatus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\HrPStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HrPStatus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\HrPStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HrPStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HrPStatus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrPStatus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrPStatus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrPStatus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class HrPStatusesTable extends Table
{
    const S_DRAFT = 1;
    const S_PENDING = 2;
    const S_COMPLETED = 3;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('hr_p_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('HrPts', [
            'foreignKey' => 'hr_p_status_id',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 15)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
