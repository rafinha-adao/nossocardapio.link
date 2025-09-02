<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEstablishmentsTable extends Migration
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
            'slug' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'unique'         => true
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'description' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
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
        $this->forge->createTable('establishments');
    }

    public function down()
    {
        $this->forge->dropTable('establishments');
    }
}
