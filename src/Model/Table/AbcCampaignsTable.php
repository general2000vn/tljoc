<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\AbcCampaign;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use EmailQueue\EmailQueue;

/**
 * AbcCampaigns Model
 *
 * @property \App\Model\Table\InitiatorsTable&\Cake\ORM\Association\BelongsTo $Initiators
 * @property \App\Model\Table\AbcStatusesTable&\Cake\ORM\Association\BelongsTo $AbcStatuses
 * @property \App\Model\Table\AbcFormsTable&\Cake\ORM\Association\HasMany $AbcForms
 * @property \App\Model\Table\AbcQuestionsTable&\Cake\ORM\Association\HasMany $AbcQuestions
 *
 * @method \App\Model\Entity\AbcCampaign newEmptyEntity()
 * @method \App\Model\Entity\AbcCampaign newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AbcCampaign[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AbcCampaign get($primaryKey, $options = [])
 * @method \App\Model\Entity\AbcCampaign findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AbcCampaign patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AbcCampaign[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AbcCampaign|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcCampaign saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcCampaign[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcCampaign[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcCampaign[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcCampaign[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AbcCampaignsTable extends Table
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

        $this->setTable('abc_campaigns');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Initiators', [
            'foreignKey' => 'initiator_id',
            'className' => 'Users',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AbcStatuses', [
            'foreignKey' => 'abc_status_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('AbcQuestions', [
            'foreignKey' => 'abc_campaign_id',
        ]);
        $this->hasMany('AbcForms', [
            'foreignKey' => 'abc_campaign_id',
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
            ->scalar('period')
            ->requirePresence('period', 'create')
            ->notEmptyString('period');

        $validator
            ->date('deadline')
            ->requirePresence('deadline', 'create')
            ->notEmptyDate('deadline');

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
        $rules->add($rules->existsIn(['initiator_id'], 'Initiators'), ['errorField' => 'initiator_id']);
        $rules->add($rules->existsIn(['abc_status_id'], 'AbcStatuses'), ['errorField' => 'abc_status_id']);

        return $rules;
    }

    public function checkStatus(AbcCampaign $abcCampaign){
        $pending = $this->AbcForms->find('all', ['conditions' => ['abc_campaign_id' => $abcCampaign->id, 'abc_form_status_id <>' => AbcFormStatusesTable::S_ACKNOWLEDGED]
                                        ]);

        if ($pending->count() == 0) {
            $abcCampaign->abc_status_id = AbcStatusesTable::S_COMPLETED;
            $this->save($abcCampaign);
            $this->enqueueNotifyComplete($abcCampaign);
        }
    }

    private function enqueueNotifyComplete(AbcCampaign $abcCampaign){
        $creator = $this->Initiators->get($abcCampaign->initiator_id, ['fields' => ['id','firstname', 'lastname', 'email']]);
        $to = [$creator->email];
        $cc = [];

        $data = ['period' => $abcCampaign->period
                ,'campaign_id' => $abcCampaign->id
                ,'creator_name' => $creator->name
                ,'deadline' => $abcCampaign->deadline
        ];

        $options = [
            'subject' => 'e-Office: Annual Business Compliance campaign is completed!',
            'layout' => 'abc',
            'template' => 'abc_complete',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => Configure::read('from_email')
        ];

        EmailQueue::enqueue($to, $cc, $data, $options);
    }
}
