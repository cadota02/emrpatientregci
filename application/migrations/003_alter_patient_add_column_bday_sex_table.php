<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_patient_add_column_bday_sex_table extends CI_Migration {
 public function up(){
    
         //add new column
         $fields = array(
            'birthday' => array(
               'type' => 'DATE',
               'null' => false
            ),
            'sex' => array(
               'type' => 'CHAR',
               'constraint' => '1',
               'null' => FALSE
            ),
         );
      $this->dbforge->add_column('patients', $fields);
   
 }
 public function down(){
   //revert changes

   $this->dbforge->drop_column('patients', 'birthday');
   $this->dbforge->drop_column('patients', 'sex');
 }


}
?>