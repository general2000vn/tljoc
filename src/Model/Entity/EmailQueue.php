<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailQueue Entity
 *
 * @property int $id
 * @property string $email
 * @property string|null $to_email
 * @property string|null $cc_email
 * @property string|null $from_name
 * @property string|null $from_email
 * @property string $subject
 * @property string $config
 * @property string $template
 * @property string $layout
 * @property string $theme
 * @property string $format
 * @property string $template_vars
 * @property string|null $headers
 * @property bool $sent
 * @property bool $locked
 * @property int $send_tries
 * @property \Cake\I18n\FrozenTime|null $send_at
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $attachments
 * @property string|null $error
 *
 * @property \App\Model\Entity\Phinxlog[] $phinxlog
 */
class EmailQueue extends Entity
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
        'email' => true,
        'to_email' => true,
        'cc_email' => true,
        'from_name' => true,
        'from_email' => true,
        'subject' => true,
        'config' => true,
        'template' => true,
        'layout' => true,
        'theme' => true,
        'format' => true,
        'template_vars' => true,
        'headers' => true,
        'sent' => true,
        'locked' => true,
        'send_tries' => true,
        'send_at' => true,
        'created' => true,
        'modified' => true,
        'attachments' => true,
        'error' => true,
        'phinxlog' => true,
    ];
}
