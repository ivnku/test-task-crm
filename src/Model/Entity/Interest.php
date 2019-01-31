<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Interest Entity
 *
 * @property int $id
 * @property string $text
 * @property string $comment
 * @property \Cake\I18n\FrozenDate $created_at
 * @property int $status_id
 *
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\Client[] $clients
 */
class Interest extends Entity
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
        'text' => true,
        'comment' => true,
        'created_at' => true,
        'status_id' => true,
        'status' => true,
        'clients' => true
    ];
}
