<?php
session_start();
include("dbconnection.php");
if(!isset($_SESSION["login"]) || !$_SESSION["login"]):
    echo '<script>window.location.href = "../login.php"</script>';
    exit(0);
endif;

if(!isset($_POST) || !isset($_POST['action'])):
  echo "Nothing to show!";

else:

  if($_POST['action'] == 'create'):
   if(!$_SESSION['is_admin']){
        echo json_encode(array('done' => -1));
        exit(0);
    }

    extract($_POST);
    $password = sha1($password);

    $update = $db->prepare("INSERT INTO `users`(`full_name`, `username`, `email`, `password`, `permission`) VALUES ( ? , ? , ? , ? , ? )");

    try{
        if($update->execute([$full_name,$username,$email,$password,$permission])){
            echo json_encode(array('done' => 0));
        }else{
            echo json_encode(array('done' => 1 , 'error' => $db->errorInfo()));
        }
    }catch(Exception $e){
        echo json_encode(array('done' => 2, 'error' => $e->getMessage()));
    }

    
  elseif($_POST['action']=="update_password"):
   if(!$_SESSION['is_admin']){
        echo json_encode(array('done' => -1));
        exit(0);
    }

    $id = $_POST["id"];
    $password = sha1($_POST['password']);

    $update = $db->prepare("UPDATE `users`
                               SET `password`= ?
                               WHERE `id` = ? ");

    try{
        if($update->execute([$password,$id])){
            echo json_encode(array('done' => 0));
        }else{
            echo json_encode(array('done' => 1 , 'error' => $db->errorInfo()));
        }
    }catch(Exception $e){
        echo json_encode(array('done' => 2, 'error' => $e->getMessage()));
    }


  elseif($_POST['action']=="delete"):
   if(!$_SESSION['is_admin']){
        echo json_encode(array('done' => -1));
        exit(0);
    }

    $id = $_POST["id"];

    $update = $db->prepare("DELETE FROM users WHERE id = ?");

    try{
        if($update->execute([$id])){
            echo json_encode(array('done' => 0));
        }else{
            echo json_encode(array('done' => 1 , 'error' => $db->errorInfo()));
        }
    }catch(Exception $e){
        echo json_encode(array('done' => 2, 'error' => $e->getMessage()));
    }

  


  else:
    echo json_encode(array('done' => -1));
  endif;


endif;
    ?>