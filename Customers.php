<?php 

// get the type from the url
$type = $_GET['type']; 
if($type=='customers') customers(); 
elseif($type=='customersUpdate') customersUpdate(); 
elseif($type=='customersDelete') customersDelete(); 
elseif($type=='customersCreate') customersCreate(); 

// get the customers
function customers(){
    require 'config.php';
    $query = "SELECT * FROM customers ORDER BY id DESC ";
    $result = $db->query($query); 
    $customers = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $customers=json_encode($customers);
    echo $customers;
}


//create a new customer
function customersCreate(){
    require 'config.php';
    $json = json_decode(file_get_contents('php://input'), true);
    $firstName =  $json['firstName'];
    $lastName =  $json['lastName'];
    $phone =  $json['phone'];
    $address =  $json['address'];
    if(isset($phone) && isset($firstName)){
        $query = "INSERT INTO customers ( firstName , lastName , phone , address) VALUES ('$firstName' , '$lastName' , '$phone' , '$address' )";
        $db->query($query);
    }
}

function customersUpdate(){
    
    $id =  $_GET['id'];
    require 'config.php';
    $json = json_decode(file_get_contents('php://input'), true);
    $firstName =  $json['firstName'];
    $lastName =  $json['lastName'];
    $phone =  $json['phone'];
    $address =  $json['address'];

     $query =  "UPDATE `customers` SET 
        `firstName` = '$firstName', 
        `lastName` = '$lastName', 
        `phone` = '$phone', 
        `address` = '$address'  WHERE id='$id' ";

       $db->query($query);
}

function customersDelete(){
    require 'config.php';
    $idd = $_GET['idtoDelete']; 
         
    $query = "DELETE FROM customers WHERE id=$idd";
    $result = $db->query($query);
    if($result)       
    {        
        echo '{"success":"customer  deleted"}';
    } else {
        echo '{"error": "error occure"}';
    }
       
       
    
}