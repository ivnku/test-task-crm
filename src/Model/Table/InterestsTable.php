<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Interests Model
 *
 * @property \App\Model\Table\StatusesTable|\Cake\ORM\Association\BelongsTo $Statuses
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\BelongsToMany $Clients
 *
 * @method \App\Model\Entity\Interest get($primaryKey, $options = [])
 * @method \App\Model\Entity\Interest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Interest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Interest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Interest|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Interest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Interest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Interest findOrCreate($search, callable $callback = null, $options = [])
 */
class InterestsTable extends Table
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

        $this->setTable('interests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Clients', [
            'foreignKey' => 'interest_id',
            'targetForeignKey' => 'client_id',
            'joinTable' => 'clients_interests'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('text')
            ->maxLength('text', 128)
            ->requirePresence('text', 'create')
            ->allowEmptyString('text', false);

        $validator
            ->scalar('comment')
            ->maxLength('comment', 255)
            ->requirePresence('comment', 'create')
            ->allowEmptyString('comment');

        $validator
            ->date('created_at')
            ->requirePresence('created_at', 'create')
            ->allowEmptyDate('created_at', false);

        return $validator;
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
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));

        return $rules;
    }

    /**
     * Get the list of user's interests
     *
     * @param int $id - client's id
     * @return void
     */
    public function getAll($id)
    {
        $connection = ConnectionManager::get('default');
        $results = $connection
            ->execute('SELECT i.*, s.name status_name, s.classname status_classname FROM interests i INNER JOIN clients_interests ci ON ci.interest_id=i.id AND ci.client_id=:client_id INNER JOIN statuses s ON i.status_id=s.id ORDER BY created_at DESC;', ['client_id' => $id])
            ->fetchAll('assoc');
        return $results;
    }
}
