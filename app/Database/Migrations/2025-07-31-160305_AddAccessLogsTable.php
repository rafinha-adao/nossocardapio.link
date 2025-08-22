<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAccessLogsTable extends Migration
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
            'path' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'ip_address' => [
                'type'           => 'VARCHAR',
                'constraint'     => 45
            ],
            'is_ajax' => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
                'default'        => 0
            ],
            'is_secure' => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
                'default'        => 0
            ],
            'created_at' => [
                'type'           => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('establishment_id', 'establishments', 'id', 'CASCADE');
        $this->forge->createTable('access_logs');
    }

    public function down()
    {
        $this->forge->dropTable('access_logs');
    }
}
