<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMenusTable extends Migration
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
        $this->forge->createTable('menus');
    }

    public function down()
    {
        $this->forge->dropTable('menus');
    }
}
