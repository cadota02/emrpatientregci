<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users_table extends CI_Migration {
 public function up(){

    $this->dbforge->add_field(array(
     'id' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'auto_increment' => TRUE
     ),
     'username' => array(
      'type' => 'VARCHAR',
      'constraint' => '60',
   ),
     'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
     ),
     'password' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
     ),
     'lastname' => array(
        'type' => 'VARCHAR',
        'constraint' => '60',
     ),
     'firstname' => array(
        'type' => 'VARCHAR',
        'constraint' => '60',
     ),
     'created_at' => array(
        'type' => 'DATETIME',
     ),
     'updated_at' => array(
        'type' => 'DATETIME',
     ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('users');
 }
 public function down(){
   // $this->dbforge->drop_table('patients');
 }


}
?>