<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Entity\User;
use Cake\Mailer\Mailer;
use Cake\ORM\Locator\TableLocator;
use EmailQueue\EmailQueue;
use Cake\Core\Configure;

/**
 * Users Model
 *
 * @property \App\Model\Table\VaccinationsTable&\Cake\ORM\Association\BelongsTo $Vaccinations
 * @property \App\Model\Table\GroupsTable&\Cake\ORM\Association\BelongsTo $Groups
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\EmpTypesTable&\Cake\ORM\Association\BelongsTo $EmpTypes
 * @property \App\Model\Table\UserTitlesTable&\Cake\ORM\Association\BelongsTo $UserTitles
 * @property \App\Model\Table\HealthsTable&\Cake\ORM\Association\BelongsTo $Healths
 * @property \App\Model\Table\VaccinesTable&\Cake\ORM\Association\BelongsTo $Vaccines1
 * @property \App\Model\Table\VaccinesTable&\Cake\ORM\Association\BelongsTo $Vaccines2
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        /*

        $this->belongsTo('Profiles', [
            'foreignKey' => 'profiles_id',
            'joinType' => 'INNER',
        ]);

        */

        $this->belongsTo('EmpTypes', [
            'className' => 'EmpTypes',
            'foreignKey' => 'emp_type_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Groups', [
            'className' => 'Groups',
            'foreignKey' => 'group_id',
            //'joinType' => 'INNER'
        ]);

        $this->belongsTo('Departments', [
            'className' => 'Departments',
            'foreignKey' => 'department_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('UserTitles', [
            'className' => 'UserTitles',
            'foreignKey' => 'user_title_id',
        ]);

        $this->belongsTo('Vaccinations', [
            'className' => 'Vaccinations',
            'foreignKey' => 'vaccination_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Healths', [
            'className' => 'Healths',
            'foreignKey' => 'health_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Vaccine1', [
            'className' => 'Vaccines',
            'propertyName' => 'vaccine1',
            'foreignKey' => 'vaccine1_id',
            //'joinType' => 'INNER', //default is LEFT
        ]);

        $this->belongsTo('Vaccine2', [
            'className' => 'Vaccines',
            'propertyName' => 'vaccine2',
            'foreignKey' => 'vaccine2_id',
            //'joinType' => 'INNER', //default is LEFT
        ]);

        $this->belongsTo('Vaccine3', [
            'className' => 'Vaccines',
            'propertyName' => 'vaccine3',
            'foreignKey' => 'vaccine3_id',
            //'joinType' => 'INNER', //default is LEFT
        ]);

        $this->belongsTo('Vaccine4', [
            'className' => 'Vaccines',
            'propertyName' => 'vaccine4',
            'foreignKey' => 'vaccine4_id',
            //'joinType' => 'INNER', //default is LEFT
        ]);

        $this->hasMany('Timesheets', [
            'className' => 'Timesheets',
            'foreignKey' => 'user_id',
        ]);

        $this->hasMany('CovidTests', [
            'className' => 'CovidTests',
            'foreignKey' => 'user_id',
            'saveStrategy' => 'append',
        ]);


        $this->belongsToMany('Roles', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'roles_users',
            'through' => 'RolesUsers',
        ]);

        $this->belongsToMany('HrPtTasks', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'hr_pt_task_id',
            'joinTable' => 'hr_pt_tasks_users',
            'through' => 'HrPtTasksUsers',
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
            ->scalar('username')
            ->maxLength('username', 25)
            ->allowEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->allowEmptyString('password');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 15)
            ->allowEmptyString('phone');

        $validator
            ->date('dob')
            ->allowEmptyDate('dob');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 20)
            ->allowEmptyString('mobile');

        $validator
            ->scalar('email')
            ->maxLength('email', 50)
            ->allowEmptyString('email');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 25)
            ->allowEmptyString('lastname');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 255)
            ->allowEmptyString('firstname');

        $validator
            ->boolean('is_active')
            ->notEmptyString('is_active');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

        $validator
            ->notEmptyString('auth_type');

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

        $validator
            ->scalar('user_dn')
            ->allowEmptyString('user_dn');

        $validator
            ->boolean('is_deleted_ldap')
            ->notEmptyString('is_deleted_ldap');
        
        $validator
            ->integer('group_id')
            ->allowEmptyString('group_id');

        $validator
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->allowEmptyString('picture');
        
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
        $validator
            ->scalar('id_number')
            ->maxLength('id_number', 20)
            ->allowEmptyString('id_number');
        $validator
            ->date('id_date')
            ->allowEmptyDate('id_date');
        $validator
            ->scalar('id_issuer')
            ->maxLength('id_issuer', 30)
            ->allowEmptyString('id_issuer');
        $validator
            ->integer('vaccine1_id')
            ->allowEmptyString('vaccine1_id');
        $validator
            ->integer('vaccine2_id')
            ->allowEmptyString('vaccine2_id');
        $validator
            ->integer('vaccine3_id')
            ->allowEmptyString('vaccine3_id');
        $validator
            ->integer('vaccine4_id')
            ->allowEmptyString('vaccine4_id');
        $validator
            ->scalar('vaccine1_place')
            ->maxLength('vaccine1_place', 30)
            ->allowEmptyString('vaccine1_place');
        $validator
            ->scalar('vaccine2_place')
            ->maxLength('vaccine2_place', 30)
            ->allowEmptyString('vaccine2_place');
        $validator
            ->scalar('vaccine3_place')
            ->maxLength('vaccine3_place', 30)
            ->allowEmptyString('vaccine3_place');
        $validator
            ->scalar('vaccine4_place')
            ->maxLength('vaccine4_place', 30)
            ->allowEmptyString('vaccine4_place');
        $validator
            ->date('vaccine1_date')
            ->allowEmptyDate('vaccine1_date');
        $validator
            ->date('vaccine2_date')
            ->allowEmptyDate('vaccine2_date');
        $validator
            ->date('vaccine3_date')
            ->allowEmptyDate('vaccine3_date');
        $validator
            ->date('vaccine4_date')
            ->allowEmptyDate('vaccine4_date');

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
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        //$rules->add($rules->existsIn(['profiles_id'], 'Profiles'), ['errorField' => 'profiles_id']);
        $rules->add($rules->existsIn(['department_id'], 'Departments'), ['errorField' => 'department_id']);

        return $rules;
    }

    public function findActive(Query $query, array $options)
    {
        return $query->where(['is_active' => true, 'is_deleted' => false]);
    }

    public function findInactive(Query $query, array $options)
    {
        return $query->where(['is_active' => false, 'is_deleted' => false]);
    }

    public function findEmployed(Query $query, array $options)
    {
        return $query->where(['is_deleted' => false]);
    }

    public function findListActive(Query $query, array $options)
    {
        return $query->select(['id','name'])->where(['is_active' => true, 'is_deleted' => false])->orderAsc('name');
    }
    public function findListAll(Query $query, array $options)
    {
        return $query->select(['id','name'])->where(['is_deleted' => false])->orderAsc('name');
    }

    public function findDeleted(Query $query, array $options)
    {
        return $query->where(['is_deleted' => true]);
    }


    public function saveProfile(User $user)
    {
        $bNotify = false;

        if ($user->isDirty('health_id')){
            $bNotify = true;
        }
        
        
        if (!$this->save($user)){
            return false;
        }

        // if ($bNotify){
        //     $newHealth = $this->Healths->get($user->health_id);
            
        //     $this->enqueueNotifyHSE($user, $newHealth->name);
        // }

        return true;
    }

    private function enqueueNotifyHSE($user, $healthName){
        $leader = $this->Groups->getLeader($user->group_id);
        $GM = $this->getOneByRole(2);
        $DGM = $this->getOneByRole(3);
        $HRs = $this->getAllByRole(1);
        $AM = $this->getOneByRole(8);
        $HSEL = $this->getOneByRole(7);
        
        $to = [$leader->email, $AM->email, $HSEL->email];
        $cc = [$GM->email, $DGM->email];

        foreach ($HRs as $HR){
            $cc = $cc + [$HR->email];
        }
        
        $data = ['name' => $user->name, 'health' => $healthName];
        $options = [
            'subject' => 'e-Office: WFH Record - Staff Health status changed',
            'layout' => 'eoffice',
            'template' => 'health',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e-Office',
            'from_email' => Configure::read('from_email')
        ];

        EmailQueue::enqueue($to, $cc, $data, $options);
    }

    private function notifyHSE($user, $healthName){
        $mailer = new Mailer('eoffice-web');

        $leader = $this->Groups->getLeader($user->group_id);
        $GM = $this->getOneByRole(2);
        $DGM = $this->getOneByRole(3);
        $HRs = $this->getAllByRole(1);
        $AM = $this->getOneByRole(8);
        $HSEL = $this->getOneByRole(7);
        
       
        //$mailer->setProfile('eoffice-web');
        $mailer->setTo([$leader->email => $leader->name]);
        $mailer->addTo([$AM->email => $AM->name, $HSEL->email => $HSEL->name]);
        $mailer->addCc([$GM->email => $GM->name, $DGM->email => $DGM->name]);

        foreach ($HRs as $HR){
            $mailer->addCc([$HR->email => $HR->name]);
            //debug($HR->email);  debug($HR->name);
        }
        

        $mailer->setSubject('WFH Record: Staff Health status changed');
        $mailer->viewBuilder()
                ->setTemplate('health')
                //->setLayout('eoffice')
                ;
        
        $mailer->setViewVars(['name' => $user->name, 'health' => $healthName])
                ->deliver()
        ;

        
    }

    public function getOneByRole($r_id, $conditions = null){
        $query = $this->find('all');
        $query->where(['is_deleted' => 0, 'is_active' => 1]);
        $query->matching('Roles', function ($q) use ($r_id){
                return $q->where(['Roles.id' => $r_id]);
            }
        );

        if (!is_null($conditions)) {
            $query->where($conditions);
        }

        return $query->first();
    }

    public function getAllByRole($r_id, $conditions = null){
        $query = $this->find();
        $query->matching('Roles', function ($q) use ($r_id){
                return $q->where(['Roles.id' => $r_id]);
            }
        );

        if (!is_null($conditions)) {
            $query->where($conditions);
        }

        return $query->all();
    }

    public function hasRole($user_id, $role_id){
        $result = false;

        $user = $this->get($user_id, ['contain' => 'Roles']);
        $role = $this->Roles->get($role_id);


        foreach ($user->roles as $role){
            if ($role->id == $role_id){
                $result = true;
                break;
            }
        }

        return $result;

    }

    public function hasRoleInList($user_id, $role_id_list){
        $result = false;

        $user = $this->get($user_id, ['contain' => 'Roles']);
        
        foreach ($user->roles as $role){
            if (in_array($role->id, $role_id_list)){
                $result = true;
                break;
            }
        }
        return $result;

    }

    public function findLineManager($user_id){
        $user = $this->get($user_id, [
                                    //'contain' => ['Departments' => ['Managers' => ['fields' => ['id', 'title', 'firstname', 'lastname', 'email']]]]
                                    'contain' => ['Departments.Managers' ]
                                    //,'fields' => ['id', 'title', 'firstname', 'lastname', 'email', 'department_id']
                                    ]);
        //debug($user);
        //debug($user->department);
        //debug($user->department->manager);
        return $user->department->manager;
    }
}
