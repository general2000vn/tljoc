<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AbcAnswers Model
 *
 * @property \App\Model\Table\AbcFormsTable&\Cake\ORM\Association\BelongsTo $AbcForms
 * @property \App\Model\Table\AbcQuestionsTable&\Cake\ORM\Association\BelongsTo $AbcQuestions
 *
 * @method \App\Model\Entity\AbcAnswer newEmptyEntity()
 * @method \App\Model\Entity\AbcAnswer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AbcAnswer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AbcAnswer get($primaryKey, $options = [])
 * @method \App\Model\Entity\AbcAnswer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AbcAnswer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AbcAnswer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AbcAnswer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcAnswer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcAnswer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcAnswer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcAnswer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcAnswer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AbcAnswersTable extends Table
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

        $this->setTable('abc_answers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('AbcForms', [
            'foreignKey' => 'abc_form_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AbcQuestions', [
            'foreignKey' => 'abc_question_id',
            'joinType' => 'INNER',
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
            ->boolean('is_abnormal')
            ->requirePresence('is_abnormal', 'create')
            ->notEmptyString('is_abnormal');
        
        $validator
            ->boolean('b_value')
            ->requirePresence('b_value', 'create')
            ->notEmptyString('b_value');

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
        $rules->add($rules->existsIn(['abc_form_id'], 'AbcForms'), ['errorField' => 'abc_form_id']);
        $rules->add($rules->existsIn(['abc_question_id'], 'AbcQuestions'), ['errorField' => 'abc_question_id']);

        return $rules;
    }
}
