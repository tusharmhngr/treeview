<?php
error_reporting('E_ALL');
$mysqli = mysqli_connect('localhost', 'root', 'root', 'thoughti'); 
if (mysqli_connect_errno()) { 
  printf("Connect failed: %s\n", mysqli_connect_error()); exit(); 
} 

if(isset($_POST['nodeid'])) 
  {
      //echo $_POST['nodeid'];
      $parent_id=$_POST['nodeid'];
      //echo 'insert new node ';

      $insert_sql = "INSERT INTO items (name, title, parent)
      VALUES ('node', 'node', '".$parent_id."')";

      if (mysqli_query($mysqli, $insert_sql)) {
          echo json_encode("New record created successfully");
      } else {
          echo json_encode("Error: " . $insert_sql . "<br>" . mysqli_error($mysqli));
      }
      //exit;
  }

if(isset($_POST['delete_nodeid'])) 
  {
      echo $_POST['delete_nodeid'];
      $parent_id=$_POST['delete_nodeid'];
      echo 'deltee new node ';
      $items_deleted=[];
      do {
          $ch = getchild_byparent($parent_id,$mysqli);
          $items_deleted[] = $ch;
          $parent_id = $ch;
      } while (getchild_byparent($parent_id,$mysqli) != false);
      print_r($items_deleted);die;

      // $insert_sql = "INSERT INTO items (name, title, parent)
      // VALUES ('node', 'node', '".$parent_id."')";

      // if (mysqli_query($mysqli, $insert_sql)) {
      //     echo json_encode("New record created successfully");
      // } else {
      //     echo json_encode("Error: " . $insert_sql . "<br>" . mysqli_error($mysqli));
      // }
      //exit;
  }  

function getchild_byparent($parent_id,$mysqli) {
  $res = mysqli_query($mysqli, "SELECT id FROM `items` WHERE parent='".$parent_id."'"); 

  while($row = mysqli_fetch_assoc($res)){ 
      if(!empty($row)){
        echo $row['id'];
        return $row['id'];
       // getchild_byparent($row['id'],$mysqli); 
      }else{
        return false;
      }
      
  }
    
}