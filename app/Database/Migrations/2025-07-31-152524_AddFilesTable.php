<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFilesTable extends Migration
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
            'menu_id' => [
                'type'           => 'INT',
                'unsigned'       => true
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'stored_name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'path' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'mime_type' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'extension' => [
                'type'           => 'VARCHAR',
                'constraint'     => 10
            ],
            'size' => [
                'type'           => 'BIGINT',
                'unsigned'       => true
            ],
            'created_at' => [
                'type'           => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('menu_id', 'menus', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('files');
    }

    public function down()
    {
        $this->forge->dropTable('files');
    }
}
