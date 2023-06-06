<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AbcStatuses Model
 *
 * @property \App\Model\Table\AbcCampaignsTable&\Cake\ORM\Association\HasMany $AbcCampaigns
 * @property \App\Model\Table\AbcFormsTable&\Cake\ORM\Association\HasMany $AbcForms
 *
 * @method \App\Model\Entity\AbcStatus newEmptyEntity()
 * @method \App\Model\Entity\AbcStatus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AbcStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AbcStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\AbcStatus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AbcStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AbcStatus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AbcStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcStatus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcStatus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcStatus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcStatus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AbcStatusesTable extends Table
{
    const S_DRAFT = 1;
    const S_PROCESSING = 2;
    const S_COMPLETED = 3;
    const S_DELETED = 4;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('abc_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('AbcCampaigns', [
            'foreignKey' => 'abc_status_id',
        ]);
        $this->hasMany('AbcForms', [
            'foreignKey' => 'abc_status_id',
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
            ->maxLength('name', 15)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
