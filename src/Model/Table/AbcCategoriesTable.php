<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AbcCategories Model
 *
 * @property \App\Model\Table\AbcQuestionsTable&\Cake\ORM\Association\HasMany $AbcQuestions
 *
 * @method \App\Model\Entity\AbcCategory newEmptyEntity()
 * @method \App\Model\Entity\AbcCategory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AbcCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AbcCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\AbcCategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AbcCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AbcCategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AbcCategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcCategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcCategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcCategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcCategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AbcCategoriesTable extends Table
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

        $this->setTable('abc_categories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('AbcQuestions', [
            'foreignKey' => 'abc_category_id',
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
            ->scalar('en')
            ->maxLength('en', 30)
            ->requirePresence('en', 'create')
            ->notEmptyString('en');

        $validator
            ->scalar('vn')
            ->maxLength('vn', 30)
            ->requirePresence('vn', 'create')
            ->notEmptyString('vn');

        return $validator;
    }
}
