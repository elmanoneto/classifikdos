<?php

	header('Content-type: application/json; charset=UTF-8');
	 
	$users_selecteds = array();
	 
	if(!empty($_GET['term'])){
	  foreach($users as $user){
	    if(strripos($user, $_GET['term']) !== false){
	      array_push($users_selecteds, $user);
	    }
	  }
	}
	 
	echo json_encode($users_selecteds);

?>