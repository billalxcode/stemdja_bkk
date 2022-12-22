<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LowonganMigrate extends Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'corporate_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'kualifikasi' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'corporate_contact' => [
                'type' => 'VARCHAR',
                'constraint' => 255 
            ],
            'expired_date' => [
                'type' => 'DATE'
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
        $this->forge->createTable('info_lowongans');
    }

    public function down()
    {
        $this->forge->dropTable('info_lowongans');
    }
}
