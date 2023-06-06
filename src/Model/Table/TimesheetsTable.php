<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\FrozenDate;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Date;
use Cake\I18n\Time;

/**
 * Timesheets Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Timesheet newEmptyEntity()
 * @method \App\Model\Entity\Timesheet newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Timesheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Timesheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Timesheet findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Timesheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Timesheet[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Timesheet|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timesheet saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timesheet[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Timesheet[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Timesheet[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Timesheet[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TimesheetsTable extends Table
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

        $this->setTable('timesheets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Vaccinations', [
            'foreignKey' => 'vaccination_id',
            //'joinType' => 'INNER',
        ]);

        $this->belongsTo('Healths', [
            'foreignKey' => 'health_id',
            //'joinType' => 'INNER',
        ]);

        $this->belongsTo('TsLocations', [
            'foreignKey' => 'ts_location_id',
            //'joinType' => 'INNER',
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
            ->date('start_date')
            ->notEmptyDate('start_date');

        $validator
            ->time('start_time')
            ->notEmptyTime('start_time');

        $validator
            ->date('end_date')
            ->allowEmptyDate('end_date');

        $validator
            ->time('end_time')
            ->allowEmptyTime('end_time');

        $validator
            ->integer('total_hour')
            ->allowEmptyString('total_hour');

        $validator
            ->scalar('remark')
            ->allowEmptyString('remark');

        $validator
            ->scalar('addr_city')
            ->maxLength('addr_city', 30)
            ->allowEmptyString('addr_city');
        $validator
            ->scalar('addr_district')
            ->maxLength('addr_district', 30)
            ->allowEmptyString('addr_district');
        $validator
            ->scalar('addr_ward')
            ->maxLength('addr_ward', 30)
            ->allowEmptyString('addr_ward');
        $validator
            ->scalar('addr_detail')
            ->maxLength('addr_detail', 127)
            ->allowEmptyString('addr_detail');

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

        return $rules;
    }

    /**
     * Check if the given user_id has any pending timesheet.
     *
     * @param int $user_id The id of user that need to be checked.
     * @return int 0: if that user has no pending timesheet. Positive int: the id of the first pending timesheet.
     */
    public function hasPending($user_id){
        $timesheet = $this->find('all', ['conditions' => ['end_date IS NULL', 'user_id' => $user_id]])->first();
        if (is_null($timesheet)){
            return 0;
        } else {
            return $timesheet->id;
        }
    }

    public function hasTodayRecord($user_id){
        $timesheet = $this->find('all', ['fields' => ['id', 'user_id'],
                        'conditions' => ['start_date' => FrozenDate::now(), 'user_id' => $user_id]])->first();
        //debug($timesheet);
        if (is_null($timesheet)){
            return false;
        } else {
            return true;
        }
    }


    public function getTodayRecord($user_id){
        $timesheet = $this->find('all', ['fields' => ['id', 'user_id', 'start_date', 'start_time', 'on_leave'],
                        'conditions' => ['start_date' => FrozenDate::now(), 'user_id' => $user_id]])->first();
        //debug($timesheet);
        if (is_null($timesheet)){
            $timesheet = $this->newEmptyEntity();
            $timesheet->user_id = $user_id;
        }
        return $timesheet;
    }

  
}
