<?php
//create database : thoughti
//import items.sql file i it 
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
      echo 'deltee new node ='.$parent_id;
      $items_deleted=[];
      /*do {
          $ch = getchild_byparent($parent_id,$mysqli);
          $items_deleted[] = $ch;
          $parent_id = $ch;
      } while (getchild_byparent($parent_id,$mysqli) != false);
      print_r($items_deleted);die;*/
	  
	  $items_deleted=categoryChild($parent_id,$mysqli);
	  $all_node_tobe_deleted=array_keys_multi($items_deleted);
	  array_push($all_node_tobe_deleted,$parent_id);
	  echo '<pre>final=';
	  $final_arr=array_unique($all_node_tobe_deleted);
	  print_r($final_arr);
	  $finalids=implode(",",$final_arr);
	  echo $finalids;
	  
	// sql to delete a record
	$sql = "DELETE FROM items WHERE id in ($finalids)";
	echo $sql;
	if (mysqli_query($mysqli, $sql)) {
		 echo json_encode("node  record deleted successfully");
	} else {
		 echo json_encode("Error: " . $insert_sql . "<br>" . mysqli_error($mysqli));
	}
	  

     
  }  

function array_keys_multi(array $array)
{
    $keys = array();
    foreach ($array as $key => $value) {
        $keys[] = $key;
        if (is_array($array[$key])) {
            $keys = array_merge($keys, array_keys_multi($array[$key]));
        }
    }
    return $keys;
}
function categoryChild($id,$mysqli) {
	echo $id;
    $sql = "SELECT id FROM `items` WHERE parent='".$id."'";
	echo '<br>'.$sql;
    $r = mysqli_query($mysqli,$sql);
	//print_r($r);
    $children = array();

    if(mysqli_num_rows($r) > 0) {
        # It has children, let's get them.
        while($row = mysqli_fetch_assoc($r)) {
            # Add the child to the list of children, and get its subchildren
			//echo '<br>ss='.$row['id'];
            $children[$row['id']] = categoryChild($row['id'],$mysqli);
        }
    }else{
		echo 'blank its a leaf node';
		$children[$id]=$id;
	}
	//echo 'c1';
	//print_r($children);
    return $children;
}