<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AbcQuestions Model
 *
 * @property \App\Model\Table\AbcCategoriesTable&\Cake\ORM\Association\BelongsTo $AbcCategories
 * @property \App\Model\Table\AbcAnswersTable&\Cake\ORM\Association\HasMany $AbcAnswers
 *
 * @method \App\Model\Entity\AbcQuestion newEmptyEntity()
 * @method \App\Model\Entity\AbcQuestion newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AbcQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AbcQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\AbcQuestion findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AbcQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AbcQuestion[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AbcQuestion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcQuestion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcQuestion[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcQuestion[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcQuestion[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcQuestion[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AbcQuestionsTable extends Table
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

        $this->setTable('abc_questions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('AbcCategories', [
            'foreignKey' => 'abc_category_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AbcCampaigns', [
            'foreignKey' => 'abc_campaign_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('AbcAnswers', [
            'foreignKey' => 'abc_question_id',
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
            ->scalar('en')
            ->requirePresence('en', 'create')
            ->notEmptyString('en');

        $validator
            ->scalar('vn')
            ->requirePresence('vn', 'create')
            ->notEmptyString('vn');

        $validator
            ->boolean('abnormal')
            ->requirePresence('abnormal', 'create')
            ->notEmptyString('abnormal');

        $validator
            ->scalar('order_code')
            ->maxLength('order_code', 5)
            ->requirePresence('order_code', 'create')
            ->notEmptyString('order_code');

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
        $rules->add($rules->existsIn(['abc_category_id'], 'AbcCategories'), ['errorField' => 'abc_category_id']);
        $rules->add($rules->existsIn(['abc_campaign_id'], 'AbcCampaigns'), ['errorField' => 'abc_campaign_id']);

        return $rules;
    }
}
