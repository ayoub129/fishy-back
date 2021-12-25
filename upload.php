<?php
$table = $_GET['table']; 
if($table=='sales') sales(); 
elseif($table=='boats') boats(); 
elseif($table=='users') users(); 
elseif($table=='customers') customers(); 


function sales(){
if($_FILES["xlsx"]){
	include "xlsx.php";
	require 'config.php';
	if($db){
		$excel=SimpleXLSX::parse($_FILES['xlsx']['tmp_name']);
        for ($sheet=0; $sheet < sizeof($excel->sheetNames()) ; $sheet++) { 
        $rowcol=$excel->dimension($sheet);
        $i=0;
        if($rowcol[0]!=1 &&$rowcol[1]!=1){
		foreach ($excel->rows($sheet) as $key => $row) {
			//print_r($row);
			$q="";
			foreach ($row as $key => $cell) {
     		if($i==0){
					$q.=$cell. " varchar(50),";
				}else{
					$q.="'".$cell. "',";
				}
			}

		
		    $query="INSERT INTO sales (`credit` , `customer` , `type` , `number` , `price` , `onp` , `total` , `date` , `avance` , `depance`)  values (".rtrim($q,",").");";
			if(mysqli_query($db,$query))
			{
				echo "true";
			} else {
				echo "false";
			}
			echo "<br>";
			$i++;
		}
	}
		}
	}
}}



function boats(){
	if($_FILES["xlsx"]){
		include "xlsx.php";
		require 'config.php';
		if($db){
			$excel=SimpleXLSX::parse($_FILES['xlsx']['tmp_name']);
			for ($sheet=0; $sheet < sizeof($excel->sheetNames()) ; $sheet++) { 
			$rowcol=$excel->dimension($sheet);
			$i=0;
			if($rowcol[0]!=1 &&$rowcol[1]!=1){
			foreach ($excel->rows($sheet) as $key => $row) {
				//print_r($row);
				$q="";
				foreach ($row as $key => $cell) {
					if($i==0){
						$q.=$cell. " varchar(50),";
					}else{
						$q.="'".$cell. "',";
					}
				}
	
			
				$query="INSERT INTO  `boats` (`boat`, `type`, `number` ,`price` , `onp` , `total` , `date`)  values (".rtrim($q,",").");";
				if(mysqli_query($db,$query))
				{
					echo "true";
				} else {
					echo "false";
				}
				echo "<br>";
				$i++;
			}
		}
			}
		}
	}}

	
function customers(){
	if($_FILES["xlsx"]){
		include "xlsx.php";
		require 'config.php';
		if($db){
			$excel=SimpleXLSX::parse($_FILES['xlsx']['tmp_name']);
			for ($sheet=0; $sheet < sizeof($excel->sheetNames()) ; $sheet++) { 
			$rowcol=$excel->dimension($sheet);
			$i=0;
			if($rowcol[0]!=1 &&$rowcol[1]!=1){
			foreach ($excel->rows($sheet) as $key => $row) {
				//print_r($row);
				$q="";
				foreach ($row as $key => $cell) {
					if($i==0){
						$q.=$cell. " varchar(50),";
					}else{
						$q.="'".$cell. "',";
					}
				}
	
			
				$query="INSERT INTO customers ( `lastName` , `firstname` , `phone` , `address`) values (".rtrim($q,",").");";
				if(mysqli_query($db,$query))
				{
					echo "true";
				} else {
					echo "false";
				}
				echo "<br>";
				$i++;
			}
		}
			}
		}
	}}

	
function users(){
	if($_FILES["xlsx"]){
		include "xlsx.php";
		require 'config.php';
		if($db){
			$excel=SimpleXLSX::parse($_FILES['xlsx']['tmp_name']);
			for ($sheet=0; $sheet < sizeof($excel->sheetNames()) ; $sheet++) { 
			$rowcol=$excel->dimension($sheet);
			$i=0;
			if($rowcol[0]!=1 &&$rowcol[1]!=1){
			foreach ($excel->rows($sheet) as $key => $row) {
				//print_r($row);
				$q="";
				foreach ($row as $key => $cell) {
					if($i==0){
						$q.=$cell. " varchar(50),";
					}else{
						$q.="'".$cell. "',";
					}
				}
	
			
				$query="INSERT INTO users (`firstName`, `lastName` ,`email` ,`number` , `password`) values (".rtrim($q,",").");";
				if(mysqli_query($db,$query))
				{
					echo "true";
				} else {
					echo "false";
				}
				echo "<br>";
				$i++;
			}
		}
			}
		}
	}}

?>
