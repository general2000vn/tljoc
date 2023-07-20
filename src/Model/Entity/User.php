<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $phone
 * @property string|null $mobile
 * @property \Cake\I18n\FrozenDate|null $dob
 * @property string|null $email
 * @property string|null $lastname
 * @property string|null $firstname
 * @property bool $is_active
 * @property string|null $comment
 * @property int $auth_type
 * @property int $emp_type_id
 * @property bool $is_deleted
 * @property int $profile_id
 * @property string|null $user_dn
 * @property bool $is_deleted_ldap
 * @property string|null $picture
 * @property int $group_id
 * @property int $department_id
 
 * @property int $vaccine1_id
 * @property int $vaccine2_id
 * @property int $vaccine3_id
 * @property int $user_title_id
 * @property string|null $title
 
 * @property string|null $vaccine1_place
 * @property string|null $vaccine2_place
 * @property string|null $vaccine3_place
 * @property \Cake\I18n\FrozenDate $vaccine1_date
 * @property \Cake\I18n\FrozenDate $vaccine2_date
 * @property \Cake\I18n\FrozenDate $vaccine3_date
 *
 * @property \App\Model\Entity\Profile $profile
 * @property \App\Model\Entity\UserTitle $user_title
 * @property \App\Model\Entity\Group $group
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Dept[] $depts
 * @property \App\Model\Entity\Vaccine $vaccine1
 * @property \App\Model\Entity\Vaccine $vaccine2
 * @property \App\Model\Entity\Vaccine $vaccine3
 * @property \App\Model\Entity\CovidTest $covid_tests
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'password' => true,
        'phone' => true,
        'mobile' => true,
        'dob' => true,
        'email' => true,
        'emp_type_id' => true,
        //'name' => true, //changed to virtual field
        'lastname' => true,
        'firstname' => true,
        'is_active' => true,
        'comment' => true,
        'auth_type' => true,
        'is_deleted' => true,
        //'profiles_id' => true,
        'user_dn' => true,
        'is_deleted_ldap' => true,
        'picture' => true,
        'group_id' => true,'group' => true,
        'user_title_id' => true,'user_title' => true,
        'title' => true,
        //'profile' => true,
        //'department' => true, 'department_id' => true,
        'departments' => true,
        'timesheets' => true,
        'roles' => true,
        'vaccination' => true,
        'vaccination_id' => true,
        'health_id' => true,
        'health' => true,
        'addr_city' => true,
        'addr_district' => true,
        'addr_ward' => true,
        'addr_detail' => true,
        'id_number' => true,
        'id_date' => true,
        'id_issuer' => true,

        'covid_tests' => true,

        'deputy_depts' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    // Automatically hash passwords when they are changed.
    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }

    protected function _getName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    protected $_virtual = ['name'];
}
