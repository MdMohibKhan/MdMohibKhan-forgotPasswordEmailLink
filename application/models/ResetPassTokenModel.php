<?php

class ResetPassTokenModel extends CI_Model {
   
   public function  __construct() {
          parent::__construct();  
          
          //laoding  database
          $this->load->database();
      }


    public function verifyToken($token){
        try{
       $this->db->select('id');
       $this->db->from('resetPassToken');
       $this->db->where(array('token' => $token));
       $query = $this->db->get();
       if ($query->num_rows() > 0) {
           return $query->result_array()[0]['id'];
       } else {
           return 0;
        }

        }
        catch(Exception $ee){
            
            return 0;
        }

    }

    public function saveToken($token){
        try{
            $data=array("token"=>$token);
            $this->db->insert('resetPassToken', $data); 
            return 1;      
        }
        catch(Exception $e){
            return 0;
        } 
    }

    public function deleteToken($id){
        try{
            $this->db->delete('resetPassToken', array('id' => $id));
            return 1;
             
        }
        catch(Exception $e){
            return 0;
        }
    }
    public function deleteToken2($token){
        try{
            $this->db->delete('resetPassToken', array('token' => $token));
            return 1;
             
        }
        catch(Exception $e){
            return 0;
        }
    }
   
}

?>
