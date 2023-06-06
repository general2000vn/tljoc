<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CovidTests Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CovidTest newEmptyEntity()
 * @method \App\Model\Entity\CovidTest newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CovidTest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CovidTest get($primaryKey, $options = [])
 * @method \App\Model\Entity\CovidTest findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CovidTest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CovidTest[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CovidTest|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CovidTest saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CovidTest[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CovidTest[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CovidTest[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CovidTest[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CovidTestsTable extends Table
{
    const UPLOAD_DIR = 'webroot' . DS . 'uploads' . DS . 'covid_test' . DS; //upload works , cant delete
    //const UPLOAD_DIR = WWW_ROOT . 'uploads' . DS . 'covid_test' . DS; //cant upload, deleting works

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('covid_tests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'result_file' => [

                'path' => CovidTestsTable::UPLOAD_DIR,

                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return $entity->user_id  . '_' . $entity->test_date . '_' . strtolower($data->getClientFilename());
                },

                'keepFilesOnDelete' => false,

            ]
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
            ->date('test_date')
            ->requirePresence('test_date', 'create')
            ->requirePresence('test_date', 'edit')
            ->notEmptyDate('test_date');

        $validator
            ->boolean('is_quick')
            ->notEmptyString('is_quick');

        $validator
            ->boolean('is_negative')
            ->notEmptyString('is_negative');

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
}
