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
                'constraint' => 255
            ],
            'corporate_contact' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'expired_date' => [
                'type' => 'DATE'
            ],
            'pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tipe_pekerjaan' => [
                'type' => 'ENUM("tetap","magang","freelance","fulltime","contract")'
            ],
            'province_code' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'cities_code' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'range_gaji' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'deskripsi' => [
                'type' => 'TEXT'
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
        $this->forge->createTable('info_lowongans', true);
    }

    public function down()
    {
        $this->forge->dropTable('info_lowongans', true);
    }
}
