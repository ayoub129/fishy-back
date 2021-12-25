<?php 

// get the type from the url
$type = $_GET['type']; 
if($type=='users') users(); 
elseif($type=='usersUpdate') usersUpdate(); 
elseif($type=='usersDelete') usersDelete(); 
elseif($type=='usersCreate') usersCreate(); 

// get the users
function users(){
    
    require 'config.php';
    $query = "SELECT * FROM users ORDER BY id DESC ";
    $result = $db->query($query); 

    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $users=json_encode($users);
    
    echo $users;
    
   
}

function usersCreate(){
    
    require 'config.php';
    $json = json_decode(file_get_contents('php://input'), true);
    $firstName =  $json['firstName'];
    $lastName =  $json['lastName'];
    $email =  $json['email'];
    $number =  $json['number'];
    $password =  $json['password'];
    
    if(isset($password) && isset($firstName)){
    $sql = "INSERT INTO users (firstName, lastName ,email ,number , password) VALUES ('$firstName', '$lastName', '$email' , '$number' , '$password')";
    $db->query($sql);
    }
}

function usersUpdate(){
$id =  $_GET['id'];

    require 'config.php';
    $json = json_decode(file_get_contents('php://input'), true);
    $firstName =  $json['firstName'];
    $lastName =  $json['lastName'];
    $email =  $json['email'];
    $number =  $json['number'];
    $password =  $json['password'];


     $sql =  "UPDATE `users` SET 
        `firstName` = '$firstName', 
        `lastName` = '$lastName', 
        `email` = '$email', 
        `number` = '$number',
        `password` = '$password'
         WHERE id=$id ";
       $db->query($sql);
}

function usersDelete(){
    require 'config.php';
    $id = $_GET['idtoDelete']; 
         
    $query = "DELETE FROM users WHERE id=$id";
    $result = $db->query($query);
    if($result)       
    {        
        echo '{"success":"customer  deleted"}';
    } else {
        echo '{"error": "error occure"}';
    }
       
       
    
}