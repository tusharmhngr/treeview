<html>
<body>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>    
  </head>
  <?php
      // if(isset($_POST['nodeid'])) 
      // {
      //     echo $_POST['nodeid'];
      //     $parent_id=$_POST['nodeid'];
      //     echo 'insert new node ';

      //     $sql = "INSERT INTO items (name, title, parent)
      //     VALUES ('node', 'node', parent_id)";

      //     if ($conn->query($sql) === TRUE) {
      //         echo "New record created successfully";
      //     } else {
      //         echo "Error: " . $sql . "<br>" . $conn->error;
      //     }
      //     exit;
      // }
  ?> 
<?php 

$mysqli = mysqli_connect('localhost', 'root', 'root', 'thoughti'); 
if (mysqli_connect_errno()) { 
  printf("Connect failed: %s\n", mysqli_connect_error()); exit(); 
} 

  //----insert node-----
/*    if(isset($_POST['nodeid'])) 
      {
          //echo $_POST['nodeid'];
          $parent_id=$_POST['nodeid'];
          //echo 'insert new node ';

          $insert_sql = "INSERT INTO items (name, title, parent)
          VALUES ('node', 'node', '".$parent_id."')";

          if (mysqli_query($mysqli, $insert_sql)) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $insert_sql . "<br>" . mysqli_error($mysqli);
          }
          //exit;
      }*/
 //--------------------------
$res = mysqli_query($mysqli, "SELECT itm.*, (SELECT COUNT(*) FROM `items` WHERE parent = itm.id) as hasChild FROM `items` as itm"); 
$items = array(); 

while($row = mysqli_fetch_assoc($res)){ 
$items[$row['id']] = array("parent_id" => $row['parent'], "name" => $row['name'], "hasChild" => $row['hasChild']); 
}

?>
<?php 
function generateTreeView($items, $currentParent, $currLevel = 0, $prevLevel = -1) {
    foreach ($items as $itemId => $item) {
        if ($currentParent == $item['parent_id']) {                       
            if ($currLevel > $prevLevel){
                echo " 
 
<ol style='list-style:none;' class='tree'> "; 
            }
             
            if ($currLevel == $prevLevel){
                echo " </li>
 
 
 ";
            }
             
            $menuLevel = $item['parent_id'];
            if($item['hasChild'] > 0){
                $menuLevel = $itemId;
            }
             
            echo '
 
<li> <label for="level'.$menuLevel.'">'.$item['name'].'</label>

<a node-id="'.$itemId.'" class="plus" href="#" id="level'.$menuLevel.'">+</a>  
<a class="delete" node-id="'.$itemId.'" href="#" id="level'.$menuLevel.'">-</a>';
             
            if ($currLevel > $prevLevel) { 
                $prevLevel = $currLevel; 
            }
             
            $currLevel++; 
             
            generateTreeView ($items, $itemId, $currLevel, $prevLevel);
            $currLevel--;
        }
    }
     
    if ($currLevel == $prevLevel) echo " </li>
 
</ol>
 
 
 ";
}
?>
 
<div class="treemenu">
<?php if(count($items) > 0){
    generateTreeView($items, 0);
}
?>
</div>

<script>
$(document).ready(function(){
  
  $('.plus').click(function(){alert('ajax');
    var nodeid=$(this).attr('node-id');
    alert(nodeid);
      $.ajax({ 
         url: "/thoughti/response.php",
         method:"POST",
         data:{nodeid:nodeid},
         dataType: "json",       
         success: function(data)  
         {
            window.location.reload();    
         }   
      });
  });

  $('.delete').click(function(){alert('ajax delete');
    var delete_nodeid=$(this).attr('node-id');
    alert(delete_nodeid);
      $.ajax({ 
         url: "/thoughti/response.php",
         method:"POST",
         data:{delete_nodeid:delete_nodeid},
         dataType: "text",       
         success: function(data)  
         {
           // window.location.reload();    
         }   
      });
  });
 
 
});
</script>
</body>
</html>