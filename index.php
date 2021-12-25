<?php 

// get the type from the url
$type = $_GET['type']; 
if($type=='login') login(); 

function login() 
{ 
       require 'config.php'; 
       $json = json_decode(file_get_contents('php://input'), true); 
       $password = $json['password']; 
       $email = $json['Email'];
       $data ='';
       $query = "SELECT * FROM users WHERE email='$email' AND password='$password'"; 
       $result= $db->query($query);
       $rowCount=$result->num_rows;
             
        if($rowCount>0)
        {
            $data = $result->fetch_object();
            $data = json_encode($data);
             
            echo  '{"data":'.$data.'}';     
        }
       
}?>