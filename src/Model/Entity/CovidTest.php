<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CovidTest Entity
 *
 * @property int $id
 * @property int $user_id
 * @property \Cake\I18n\FrozenDate $test_date
 * @property bool $is_quick
 * @property bool $is_negative
 * @property string $result_file
 *
 * @property \App\Model\Entity\User $user
 */
class CovidTest extends Entity
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
        'user_id' => true,
        'test_date' => true,
        'is_quick' => true,
        'is_negative' => true,
        'user' => true,
        'result_file' => true,
    ];
}
