<?php

  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Credentials: true");
  header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
  header("Content-Type: application/json; charset=utf-8");

  include "config/config.php";
  
  $postjson = json_decode(file_get_contents('php://input'), true);
  $today    = date('Y-m-d');

  //update html
  if($postjson['aksi']=='update'){
        $query = mysqli_query($mysqli, "UPDATE master_user SET 
        
        html='$postjson[html]'
       
        WHERE user_id='$postjson[user_id]'
        ");

      if($query) $result = json_encode(array('success'=>true, 'result'=>'success'));
      else $result = json_encode(array('success'=>false, 'result'=>'error'));

      echo $result;
  }

  //updatecss
  elseif($postjson['aksi']=='updatecss'){
    $query = mysqli_query($mysqli, "UPDATE master_user SET 
    
    css='$postjson[css]'
    
    WHERE user_id='$postjson[user_id]'
    ");

  if($query) $result = json_encode(array('success'=>true, 'result'=>'success'));
  else $result = json_encode(array('success'=>false, 'result'=>'error'));

  echo $result;
}

  //update php
  elseif($postjson['aksi']=='updatephp'){
        $query = mysqli_query($mysqli, "UPDATE master_user SET 
        
        php ='$postjson[php]'
        
        WHERE user_id='$postjson[user_id]'
        ");

      if($query) $result = json_encode(array('success'=>true, 'result'=>'success'));
      else $result = json_encode(array('success'=>false, 'result'=>'error'));

      echo $result;
  }

  elseif($postjson['aksi']=='getdata'){
  	$data = array();
  	$query = mysqli_query($mysqli, "SELECT * FROM master_user ORDER BY user_id ");

  	while($row = mysqli_fetch_array($query)){

  		$data = array(
  			'user_id' => $row['user_id'],
  			'username' => $row['username'],
  			'html' => $row['html'],
        'css' => $row['css'],
        'php' => $row['php'],

  		);
  	}

  	if($query) $result = json_encode(array('success'=>true, 'result'=>$data));
  	else $result = json_encode(array('success'=>false));

  	echo $result;

  }

  /*elseif($postjson['aksi']=='delete'){
  	$query = mysqli_query($mysqli, "DELETE  
    
    html='$postjson[html]'
    FROM master_user WHERE user_id='$postjson[user_id]' ");

  	if($query) $result = json_encode(array('success'=>true, 'result'=>'success'));
  	else $result = json_encode(array('success'=>false, 'result'=>'error'));

  	echo $result;

  }*/

  elseif($postjson['aksi']=='create'){
   $password = md5($postjson['password']);
  	$query = mysqli_query($mysqli, "INSERT INTO master_user SET
  		username = '$postjson[username]',
  		password = '$password',
        status = 'y',
  		created_at	  = '$today' ,
      html = '',
      php = '',
      css = ''

  	");

  if($query) $result = json_encode(array('success'=>true));
  else $result = json_encode(array('success'=>false, 'msg'=>'error, please try again'));

  echo $result;
}

elseif($postjson['aksi']=='login'){
  
  $password = md5($postjson['password']);
   $query = mysqli_query($mysqli, "SELECT * FROM master_user  WHERE username='$postjson[username]' AND password = '$password'");
   $check = mysqli_num_rows($query);

   if($check>0){
     $data = mysqli_fetch_array($query);
     $datauser = array(
       'user_id' => $data['user_id'],
       'username' => $data['username'],
       'password' => $data['password'],
       'html' => $data['html'],
       'css' => $data['css'],
       'php' => $data['php']
     );
        if($data['status']=='y'){
          $result = json_encode(array('success'=>true, 'result' =>$datauser));
        }
        else{
          $result = json_encode(array('success'=>false, 'msg' =>'Account Inactive'));
        }
   }
   else{
    $result = json_encode(array('success'=>false, 'msg' =>'Unregister Account'));
   }



 echo $result;
}
  ?>