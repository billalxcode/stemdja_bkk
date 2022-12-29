<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SchoolMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 25,
                'auto_increment' => true,
                'unsigned' => true
            ],
            'nama_sekolah' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'status' => [
                'type' => "ENUM('negeri','swasta')",
                'null' => true,
                'default' => 'negeri'
            ],
            'skoperasional' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true
            ],
            'tgl_skoperasional' => [
                'type' => 'DATE',
                'null' => false
            ],
            'nama_kepsek' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'operator' => [
                'type' => 'VARCHAR',
                'constraint' => 255
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
        $this->forge->createTable('school_informations', true);
    }

    public function down()
    {
        $this->forge->dropTable('school_informations', true);
    }
}
