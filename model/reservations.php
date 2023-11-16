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

    extract($_POST);
    $created_by = $_SESSION['user_id'];

    $update = $db->prepare("INSERT INTO `reservations`(`room_id`, `customer_id`, `reservation_type_id`, `reserved_date`, `checkin`, `checkout`, `adults`, `children`, `guaranteed`, `meal`, `remark`, `created_by`) VALUES ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? )");

    try{
        if($update->execute([$room_id,$customer_id,$reservation_type_id,$reserved_date,$checkin,$checkout,$adults,$children,$guaranteed,$meal,$remark,$created_by])){
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
    $deleted_at = date('Y-m-d H:i:s');
    $deleted_by = $_SESSION['user_id'];

    $update = $db->prepare("UPDATE `reservations`
                               SET `deleted_by`= ? ,`deleted_at`= ?
                               WHERE `id` = ? ");

    try{
        if($update->execute([$deleted_by,$deleted_at,$id])){
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