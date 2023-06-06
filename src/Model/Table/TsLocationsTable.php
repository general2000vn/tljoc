<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TsLocations Model
 *
 * @property \App\Model\Table\TimesheetsTable&\Cake\ORM\Association\HasMany $Timesheets
 *
 * @method \App\Model\Entity\TsLocation newEmptyEntity()
 * @method \App\Model\Entity\TsLocation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TsLocation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TsLocation get($primaryKey, $options = [])
 * @method \App\Model\Entity\TsLocation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TsLocation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TsLocation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TsLocation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TsLocation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TsLocation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TsLocation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TsLocation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TsLocation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TsLocationsTable extends Table
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

        $this->setTable('ts_locations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Timesheets', [
            'foreignKey' => 'ts_location_id',
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
