<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'uuid' => [
                'type'           => 'CHAR',
                'constraint'     => 36,
                'unique'         => true
            ],
            'establishment_id' => [
                'type'           => 'INT',
                'unsigned'       => true
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'unique'         => true
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'role' => [
                'type'           => 'ENUM',
                'constraint'     => ['viewer', 'editor', 'admin'],
                'default'        => 'admin',
            ],
            'remember_token' => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true
            ],
            'active' => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
                'default'        => 1
            ],
            'created_at' => [
                'type'           => 'DATETIME'
            ],
            'updated_at' => [
                'type'           => 'DATETIME'
            ],
            'deleted_at' => [
                'type'           => 'DATETIME',
                'null'           => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('establishment_id', 'establishments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
