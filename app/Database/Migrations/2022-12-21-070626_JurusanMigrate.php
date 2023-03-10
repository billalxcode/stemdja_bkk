<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JurusanMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => false
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'short' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
            'deleted_at' => [
                'type' => 'DATETIME'
            ]
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('jurusans', true);
    }

    public function down()
    {
        $this->forge->dropTable('jurusans', true);
    }
}
