<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DocOutgoingsPartners Model
 *
 * @property \App\Model\Table\DocOutgoingsTable&\Cake\ORM\Association\BelongsTo $DocOutgoings
 * @property \App\Model\Table\PartnersTable&\Cake\ORM\Association\BelongsTo $Partners
 *
 * @method \App\Model\Entity\DocOutgoingsPartner newEmptyEntity()
 * @method \App\Model\Entity\DocOutgoingsPartner newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocOutgoingsPartner[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DocOutgoingsPartnersTable extends Table
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

        $this->setTable('doc_outgoings_partners');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('DocOutgoings', [
            'foreignKey' => 'doc_outgoing_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Partners', [
            'foreignKey' => 'partner_id',
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
        $rules->add($rules->existsIn(['doc_outgoing_id'], 'DocOutgoings'), ['errorField' => 'doc_outgoing_id']);
        $rules->add($rules->existsIn(['partner_id'], 'Partners'), ['errorField' => 'partner_id']);

        return $rules;
    }
}
