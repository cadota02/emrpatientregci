<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_patients_table extends CI_Migration {
 public function up(){
      $this->dbforge->modify_column('patients', [
         'name' => [
            'name' => 'firstname',
            'type' => 'VARCHAR',
            'constraint' => '255',
            'null' => FALSE
            ]
         ]);
         //add new column
         $fields = array(
            'lastname' => array(
               'type' => 'VARCHAR',
               'constraint' => '255',
               'null' => false,
               'after' => 'firstname'
            ),
            'middlename' => array(
               'type' => 'VARCHAR',
               'constraint' => '255',
               'null' => TRUE,
               'after' => 'lastname'
            ),
         );
         $this->dbforge->add_column('patients', $fields);

   
 }
 public function down(){
   //revert changes
   $this->dbforge->modify_column('patients', [
      'firstname' => [
         'name' => 'name',
         'type' => 'VARCHAR',
         'constraint' => '255',
         'null' => FALSE
      ]

   ]);
   $this->dbforge->drop_column('patients', 'middlename');
   $this->dbforge->drop_column('patients', 'lastname');
 }


}
?>