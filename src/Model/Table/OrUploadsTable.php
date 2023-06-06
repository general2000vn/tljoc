<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\OrStatus;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\FrozenTime;

/**
 * OrUploads Model
 *
 * @property \App\Model\Table\OrderReqsTable&\Cake\ORM\Association\BelongsTo $OrderReqs
 *
 * @method \App\Model\Entity\OrUpload newEmptyEntity()
 * @method \App\Model\Entity\OrUpload newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OrUpload[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrUpload get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrUpload findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OrUpload patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrUpload[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrUpload|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrUpload saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrUpload[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrUpload[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrUpload[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrUpload[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OrUploadsTable extends Table
{
    const UPLOAD_DIR = 'webroot' . DS . 'uploads' . DS . 'or_attachments' . DS;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {        
        parent::initialize($config);

        $this->setTable('or_uploads');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        //$this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'filename' => [
                //'path' => 'webroot{DS}uploads{DS}doc_incoming{DS}',
                'path' => OrUploadsTable::UPLOAD_DIR,

                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    $uploadTime = FrozenTime::now();
                    
                    return $uploadTime->format('Ymd-hmi-') . strtolower($data->getClientFilename());
                },

                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    // When deleting the entity, both the original and the thumbnail will be removed
                    // when keepFilesOnDelete is set to false
                    return [
                        $path . $entity->{$field},
                    ];
                },
                'keepFilesOnDelete' => false,

            ]
        ]);

        $this->belongsTo('OrderReqs', [
            'foreignKey' => 'order_req_id',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        // $validator
        //     ->scalar('filename')
        //     ->maxLength('filename', 255)
        //     //->requirePresence('filename', 'create')
        //     ->notEmptyFile('filename');

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
        //$rules->add($rules->existsIn(['order_req_id'], 'OrderReqs'), ['errorField' => 'order_req_id']);

        return $rules;
    }
}
