<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClientsInterests Model
 *
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\InterestsTable|\Cake\ORM\Association\BelongsTo $Interests
 *
 * @method \App\Model\Entity\ClientsInterest get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClientsInterest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClientsInterest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClientsInterest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientsInterest|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientsInterest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClientsInterest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClientsInterest findOrCreate($search, callable $callback = null, $options = [])
 */
class ClientsInterestsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('clients_interests');
        $this->setDisplayField('client_id');
        $this->setPrimaryKey(['client_id', 'interest_id']);

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Interests', [
            'foreignKey' => 'interest_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['client_id'], 'Clients'));
        $rules->add($rules->existsIn(['interest_id'], 'Interests'));

        return $rules;
    }
}
