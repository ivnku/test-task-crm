<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string|null $middlename
 * @property string $phone
 * @property string|null $email
 *
 * @property \App\Model\Entity\Interest[] $interests
 */
class Client extends Entity
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
        'firstname' => true,
        'lastname' => true,
        'middlename' => true,
        'phone' => true,
        'email' => true,
        'interests' => true
    ];
}
