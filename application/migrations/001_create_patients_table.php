<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_patients_table extends CI_Migration {
 public function up(){

    $this->dbforge->add_field(array(
     'id' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'auto_increment' => TRUE
     ),
     'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
     ),
     'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
     ),
     'phone' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
     ),
     'address' => array(
        'type' => 'TEXT',
     ),
     'created_at' => array(
        'type' => 'DATETIME',
     ),
     'updated_at' => array(
        'type' => 'DATETIME',
     ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('patients');
 }
 public function down(){
   // $this->dbforge->drop_table('patients');
 }


}
?>