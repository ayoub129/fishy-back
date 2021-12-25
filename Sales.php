<?php 

// get the type from the url
$type = $_GET['type']; 
if($type=='sales') sales(); 
elseif($type =='searching') searching(); 
elseif($type =='filtering') filtering(); 
elseif($type=='salesUpdate') salesUpdate(); 
elseif($type=='salesDelete') salesDelete(); 
elseif($type=='salesCreate') salesCreate(); 

//get the sales
function sales(){
    require 'config.php';
    $query = "SELECT * FROM sales ORDER BY id DESC ";
    $result = $db->query($query); 
    $sales = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $sales=json_encode($sales);
    echo $sales;
}


// search
function searching() {
    require 'config.php';
    $searching = $_GET['searching'];    
    $query = "SELECT * FROM `sales` WHERE `credit` = '$searching' OR `customer` = '$searching'  OR `type` = '$searching' OR `price` = '$searching'  OR `onp` = '$searching' OR `total` = '$searching' OR `number` = '$searching' OR `avance` = '$searching' OR `depance` = '$searching'  ORDER BY id DESC ";
    $result = $db->query($query); 
    $sales = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $sales=json_encode($sales);
    echo $sales;
}

function filtering() {
    require 'config.php';   
    $fromdate = $_GET['fromdate'];   
    $todate = $_GET['todate'];    
    $query = "SELECT * FROM `sales` WHERE `date` BETWEEN '$fromdate' AND '$todate' ORDER BY id DESC ";
    $result = $db->query($query); 
    $sales = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $sales=json_encode($sales);
    echo $sales;
}


function salesCreate(){
    
    require 'config.php';
    $json = json_decode(file_get_contents('php://input'), true);
    $credit =  $json['credit'];
    $customer =  $json['customer'];
    $number = $json['number'];
    $onp =  $json['onp'];
    $price =  $json['price'];
    $type =  $json['type'];
    $date = $json['date'];
    $avance = $json['avance'];
    $depance = $json['depance'];
    $total = $price * $number;
    
    if(isset($number) && isset($customer)){
        $query = "INSERT INTO `sales` (`credit`, `customer`, `price`, `total`, `number`, `onp`, `type`, `date` ,`avance` , `depance`)
        VALUES ('$credit', '$customer', '$price' ,  '$total'   , '$number' ,  '$onp' ,'$type' , '$date' , '$avance' , '$depance'  )";
        $db->query($query);
    }
}



function salesUpdate(){

    require 'config.php';
    $json = json_decode(file_get_contents('php://input'), true);
    $id =  $_GET['id'];
    $credit =  $json['credit'];
    $customer =  $json['customer'];
    $number = $json['number'];
    $onp =  $json['onp'];
    $price =  $json['price'];
    $type =  $json['type'];
    $date = $json['date'];
    $avance = $json['avance'];
    $depance = $json['depance'];

    if(isset($number) && isset($customer)){
     $query =  "UPDATE `sales` SET 
        `date` = '$date',
        `credit` = '$credit', 
        `customer` = '$customer', 
        `type` = '$type', 
        `price` = '$price',
        `number` = '$number',
        `onp` = '$onp',
        `avance` = '$avance',
        `depance` = '$depance'
          WHERE `sales`.`id`=$id ";

       $db->query($query);}
}

// majmo3 - onp - credit
// function sumMajmo3() {
//     require 'config.php';    
//     $query = "SELECT SUM(total) AS total FROM `sales` ORDER BY id DESC ";
//     $result = $db->query($query); 
//     $sales = mysqli_fetch_all($result,MYSQLI_ASSOC);
//     $sales=json_encode($sales);
//     echo $sales;
// }

// function sumOnp() {
//     require 'config.php';    
//     $query = "SELECT SUM(onp) AS onp FROM `sales` ORDER BY id DESC ";
//     $result = $db->query($query); 
//     $sales = mysqli_fetch_all($result,MYSQLI_ASSOC);
//     $sales=json_encode($sales);
//     echo $sales;
// }

// function sumCredit() {
//     require 'config.php';    
//     $query = "SELECT SUM(credit) AS credit FROM `sales` ORDER BY id DESC ";
//     $result = $db->query($query); 
//     $sales = mysqli_fetch_all($result,MYSQLI_ASSOC);
//     $sales=json_encode($sales);
//     echo $sales;
// }

function salesDelete(){
    require 'config.php';
    $id = $_GET['idtoDelete']; 
         
    $query = "DELETE FROM sales WHERE id=$id";
    $result = $db->query($query);
    if($result)       
    {        
        echo '{"success":"customer  deleted"}';
    } else {
        echo '{"error": "error occure"}';
    }
       
       
    
}