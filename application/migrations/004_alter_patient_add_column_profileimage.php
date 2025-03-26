<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_patient_add_column_profileimage extends CI_Migration {
 public function up(){
    
         //add new column
         $fields = array(
            'profile_image' => array(
               'type' => 'VARCHAR',
               'constraint' => '255',
               'null' => TRUE
            ),
           
         );
      $this->dbforge->add_column('patients', $fields);
   
 }
 public function down(){
   //revert changes

   $this->dbforge->drop_column('patients', 'profile_image');

 }


}
?>