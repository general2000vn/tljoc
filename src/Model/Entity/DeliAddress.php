<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DeliAddress Entity
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property bool $is_deleted
 * @property int $display_order
 *
 * @property \App\Model\Entity\OrderReq[] $order_reqs
 */
class DeliAddress extends Entity
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
        'name' => true,
        'address' => true,
        'is_deleted' => true,
        'display_order' => true,
        'order_reqs' => true,
    ];
}