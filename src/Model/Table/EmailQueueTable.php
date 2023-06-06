<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailQueue Model
 *
 * @property \App\Model\Table\PhinxlogTable&\Cake\ORM\Association\BelongsToMany $Phinxlog
 *
 * @method \App\Model\Entity\EmailQueue newEmptyEntity()
 * @method \App\Model\Entity\EmailQueue newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\EmailQueue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmailQueue get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmailQueue findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\EmailQueue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmailQueue[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmailQueue|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailQueue saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailQueue[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmailQueue[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmailQueue[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmailQueue[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailQueueTable extends Table
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

        $this->setTable('email_queue');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Phinxlog', [
            'foreignKey' => 'email_queue_id',
            'targetForeignKey' => 'phinxlog_id',
            'joinTable' => 'email_queue_phinxlog',
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('to_email')
            ->allowEmptyString('to_email');

        $validator
            ->scalar('cc_email')
            ->allowEmptyString('cc_email');

        $validator
            ->scalar('from_name')
            ->maxLength('from_name', 255)
            ->allowEmptyString('from_name');

        $validator
            ->scalar('from_email')
            ->maxLength('from_email', 255)
            ->allowEmptyString('from_email');

        $validator
            ->scalar('subject')
            ->maxLength('subject', 255)
            ->requirePresence('subject', 'create')
            ->notEmptyString('subject');

        $validator
            ->scalar('config')
            ->maxLength('config', 30)
            ->requirePresence('config', 'create')
            ->notEmptyString('config');

        $validator
            ->scalar('template')
            ->maxLength('template', 100)
            ->requirePresence('template', 'create')
            ->notEmptyString('template');

        $validator
            ->scalar('layout')
            ->maxLength('layout', 50)
            ->requirePresence('layout', 'create')
            ->notEmptyString('layout');

        $validator
            ->scalar('theme')
            ->maxLength('theme', 50)
            ->requirePresence('theme', 'create')
            ->notEmptyString('theme');

        $validator
            ->scalar('format')
            ->maxLength('format', 5)
            ->requirePresence('format', 'create')
            ->notEmptyString('format');

        $validator
            ->scalar('template_vars')
            ->maxLength('template_vars', 4294967295)
            ->requirePresence('template_vars', 'create')
            ->notEmptyString('template_vars');

        $validator
            ->scalar('headers')
            ->allowEmptyString('headers');

        $validator
            ->boolean('sent')
            ->notEmptyString('sent');

        $validator
            ->boolean('locked')
            ->notEmptyString('locked');

        $validator
            ->integer('send_tries')
            ->notEmptyString('send_tries');

        $validator
            ->dateTime('send_at')
            ->allowEmptyDateTime('send_at');

        $validator
            ->scalar('attachments')
            ->allowEmptyString('attachments');

        $validator
            ->scalar('error')
            ->allowEmptyString('error');

        return $validator;
    }
}
