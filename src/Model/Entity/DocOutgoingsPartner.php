<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DocOutgoingsPartner Entity
 *
 * @property int $id
 * @property int $doc_outgoing_id
 * @property int $partner_id
 *
 * @property \App\Model\Entity\DocOutgoing $doc_outgoing
 * @property \App\Model\Entity\Partner $partner
 */
class DocOutgoingsPartner extends Entity
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
        'doc_outgoing_id' => true,
        'partner_id' => true,
        'doc_outgoing' => true,
        'partner' => true,
    ];
}
