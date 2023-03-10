<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlumniMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true,
                'null' => false
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false,
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM("male","female")',
                'null' => true
            ],
            'jurusan_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
            ],
            'tahun_lulus' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
                'null' => true
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true
            ], 
            'status' => [
                'type' => 'ENUM("belum_bekerja","bekerja","kuliah","berwirausaha")',
                'null' => true
            ],
            'kontak' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => true
            ],
            'tempat_kerja' => [
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
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('user_id');
        $this->forge->createTable('alumni', true);
    }

    public function down()
    {
        $this->forge->dropTable('alumni', true);
    }
}
