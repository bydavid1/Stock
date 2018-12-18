<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

  $outlayDate = date('Y-m-d', strtotime($_POST['outlayDate']));	
  $description = $_POST['description'];

  $sql = "INSERT INTO outlay (outlay_description, outlay_date) VALUES ('$description', '$outlayDate');";
  $res = $connect->query($sql);

  if($res > 0){
      $insert = true;
  }else{
      $insert = false;
  }

  if($insert === TRUE){
    $valid['success'] = true;
    $valid['messages'] = $sql;
  }else{
    $valid['success'] = false;
    $valid['messages'] = $sql;
  }

  $connect->close();

	echo json_encode($valid);