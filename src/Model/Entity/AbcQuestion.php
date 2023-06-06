<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AbcQuestion Entity
 *
 * @property int $id
 * @property string $en
 * @property string $vn
 * @property bool $abnormal
 * @property int $abc_category_id
 * @property int $abc_campaign_id
 * @property string $order_code
 *
 * @property \App\Model\Entity\AbcCategory $abc_category
 * @property \App\Model\Entity\AbcAnswer[] $abc_answers
 */
class AbcQuestion extends Entity
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
        'en' => true,
        'vn' => true,
        'abnormal' => true,
        'abc_category_id' => true,
        'abc_campaign_id' => true,
        'order_code' => true,
        'abc_category' => true,
        'abc_answers' => true,
    ];
}
