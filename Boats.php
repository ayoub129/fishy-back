<?php 

// get the type from the url
$type = $_GET['type']; 
if($type==='boats') boats();
elseif($type=='searching') searching(); 
elseif($type=='filtering') filtering(); 
elseif($type==='boatsUpdate') boatsUpdate(); 
elseif($type==='boatsDelete') boatsDelete(); 
elseif($type==='boatsCreate') boatsCreate(); 

//get the boats
function boats(){
    require 'config.php';    
    $query = "SELECT * FROM `boats` ORDER BY id DESC ";
    $result = $db->query($query); 
    $boats = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $boats=json_encode($boats);
    echo $boats;
}


// search
function searching() {
    require 'config.php';
    $searching = $_GET['searching'];    
    $query = "SELECT * FROM `boats` WHERE `boat` = '$searching' OR `number` = '$searching'  OR `type` = '$searching' OR `price` = '$searching'  OR `onp` = '$searching' OR `total` = '$searching'    ORDER BY id DESC ";
    $result = $db->query($query); 
    $boats = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $boats=json_encode($boats);
    echo $boats;
}

function filtering() {
    require 'config.php';   
    $fromdate = $_GET['fromdate'];   
    $todate = $_GET['todate'];    
    $query = "SELECT * FROM `boats` WHERE `date` BETWEEN '$fromdate' AND '$todate' ORDER BY id DESC ";
    $result = $db->query($query); 
    $boats = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $boats=json_encode($boats);
    echo $boats;
}

//create a new boat
function boatsCreate(){
    require 'config.php';
    $json = json_decode(file_get_contents('php://input'), true);
    $boat =  $json['boat'];
    $number =  $json['number'];
    $type =  $json['type'];
    $price =  $json['price'];
    $onp =  $json['onp'];
    $date = $json['date'];
    $total = $price * $number;
    
    if(isset($number) && isset($boat)){
        $query = "INSERT INTO boats (date, boat, number ,type , price ,onp , total)
        VALUES ('$date', '$boat', '$number' , '$type' , '$price' , '$onp' , '$total')";
        $db->query($query);
    } 
}





function boatsUpdate(){
    require 'config.php';
    $id = $_GET['id'];
    $json = json_decode(file_get_contents('php://input'), true);
    $boat =  $json['boat'];
    $number =  $json['number'];
    $type =  $json['type'];
    $price =  $json['price'];
    $onp =  $json['onp'];
    $date = $json['date'];

    if(isset($number) && isset($boat)){
     $query =  "UPDATE `boats` SET 
        `date` = '$date', 
        `boat` = '$boat', 
        `number` = '$number', 
        `type` = '$type', 
        `price` = '$price' ,
        `onp` = '$onp'
         WHERE `boats`.`id`=$id ";

       $db->query($query); }
      
}

//boats delete
function boatsDelete(){
    require 'config.php';
    $id = $_GET['idtoDelete'];   
    $query = "DELETE FROM boats WHERE id=$id";
    $result = $db->query($query);
    if($result)       
    {        
        echo '{"success":"boat stock deleted"}';
    } else {
        echo '{"error": "error occure"}';
    }  
}