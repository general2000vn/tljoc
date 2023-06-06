<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AbcForms Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AbcCampaignsTable&\Cake\ORM\Association\BelongsTo $AbcCampaigns
 * @property \App\Model\Table\AbcFormStatusesTable&\Cake\ORM\Association\BelongsTo $AbcFormStatuses
 * @property \App\Model\Table\AbcAnswersTable&\Cake\ORM\Association\HasMany $AbcAnswers
 *
 * @method \App\Model\Entity\AbcForm newEmptyEntity()
 * @method \App\Model\Entity\AbcForm newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AbcForm[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AbcForm get($primaryKey, $options = [])
 * @method \App\Model\Entity\AbcForm findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AbcForm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AbcForm[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AbcForm|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcForm saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcForm[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcForm[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcForm[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcForm[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AbcFormsTable extends Table
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

        $this->setTable('abc_forms');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Handlers', [
            'foreignKey' => 'handler_id',
            'className' => 'Users',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('LastHandlers', [
            'foreignKey' => 'last_handler_id',
            'className' => 'Users',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('AbcCampaigns', [
            'foreignKey' => 'abc_campaign_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AbcFormStatuses', [
            'foreignKey' => 'abc_form_status_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('AbcAnswers', [
            'foreignKey' => 'abc_form_id',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->boolean('is_abnormal')
            ->allowEmptyString('is_abnormal');

        $validator
            ->boolean('is_vn')
            ->allowEmptyString('is_vn');

        $validator
            ->scalar('justification')
            ->allowEmptyString('justification');

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
        $rules->add($rules->existsIn(['abc_campaign_id'], 'AbcCampaigns'), ['errorField' => 'abc_campaign_id']);
        $rules->add($rules->existsIn(['abc_form_status_id'], 'AbcFormStatuses'), ['errorField' => 'abc_form_status_id']);

        return $rules;
    }
}
