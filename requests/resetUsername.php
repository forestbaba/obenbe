<?php 
include_once '../functions/inc.php';  
if(isset($_POST['username'])){
  $isUsername = mysqli_real_escape_string($db, $_POST['username']);
if($isUsername != $dataUsername){ 
  if(strlen($isUsername) > 0){
	  if (preg_match('/[^A-Za-z0-9-_]/', $isUsername))  
     {
		echo '4';
		exit(); 
     }
      $CheckUsername = $Dot->Dot_CheckUserNameExistINData($isUsername);
	  if($CheckUsername){
		   echo '1';
	  } else{
		  echo '2'; 
	  }
  }
} 
}
?>