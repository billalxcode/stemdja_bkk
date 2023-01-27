<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MitraMigrate extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'site' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
            'deleted_at' => [
                'type' => 'DATETIME'
            ],
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->createTable('mitra', true);
    }

    public function down()
    {
        $this->forge->dropTable('mitra', true);
    }
}
