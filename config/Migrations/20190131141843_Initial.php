<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('clients')
            ->addColumn('firstname', 'string', [
                'default' => null,
                'limit' => 64,
                'null' => false,
            ])
            ->addColumn('lastname', 'string', [
                'default' => null,
                'limit' => 64,
                'null' => false,
            ])
            ->addColumn('middlename', 'string', [
                'default' => null,
                'limit' => 64,
                'null' => true,
            ])
            ->addColumn('phone', 'string', [
                'default' => null,
                'limit' => 24,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 64,
                'null' => true,
            ])
            ->addIndex(
                [
                    'phone',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('clients_interests', ['id' => false, 'primary_key' => ['client_id', 'interest_id']])
            ->addColumn('client_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('interest_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'client_id',
                ]
            )
            ->addIndex(
                [
                    'interest_id',
                ]
            )
            ->create();

        $this->table('interests')
            ->addColumn('text', 'string', [
                'default' => null,
                'limit' => 128,
                'null' => false,
            ])
            ->addColumn('comment', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('created_at', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('status_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'status_id',
                ]
            )
            ->create();

        $this->table('statuses')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 64,
                'null' => false,
            ])
            ->addColumn('classname', 'string', [
                'default' => '-primary',
                'limit' => 16,
                'null' => false,
            ])
            ->addIndex(
                [
                    'name',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('clients_interests')
            ->addForeignKey(
                'client_id',
                'clients',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'interest_id',
                'interests',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('interests')
            ->addForeignKey(
                'status_id',
                'statuses',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('clients_interests')
            ->dropForeignKey(
                'client_id'
            )
            ->dropForeignKey(
                'interest_id'
            )->save();

        $this->table('interests')
            ->dropForeignKey(
                'status_id'
            )->save();

        $this->table('clients')->drop()->save();
        $this->table('clients_interests')->drop()->save();
        $this->table('interests')->drop()->save();
        $this->table('statuses')->drop()->save();
    }
}
