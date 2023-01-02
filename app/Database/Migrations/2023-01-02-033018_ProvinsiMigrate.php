<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProvinsiMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true,
                'unsigned' => false
            ],
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
            ]
        ]);
        
        $this->forge->addKey('id');
        $this->forge->addUniqueKey('code');

        $this->forge->createTable('provinces', true);
    }

    public function down()
    {
        $this->forge->dropTable('provinces', true);
    }
}
