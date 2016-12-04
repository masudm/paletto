<?php
include_once("db_conx.php");
$col1 = "";
$col2 = "";
$col3 = "";
$col4 = "";
$likes = "";
$date = "";
if(isset($_GET["id"])){
    $id = preg_replace('#[^a-z0-9]#i', '', $_GET['id']);
    
    $sql = "SELECT id, col1, col2, col3, col4, likes, date FROM palletes WHERE id='$id' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
    $row = mysqli_fetch_row($query);
    $id = $row[0];
    $col1 = $row[1];
    $col2 = $row[2];
    $col3 = $row[3];
    $col4 = $row[4];
    $likes = $row[5];
    $date = $row[6];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
        <link rel=stylesheet href="styles.css" type="text/css">
        <script src="ajax.js"></script>
        <script>
            function like(id, action) {
                var ajax = ajaxObj("POST", "index.php");
                ajax.onreadystatechange = function() {
                    if(ajaxReturn(ajax) == true) {
                        if(ajax.responseText.indexOf("done") > -1){
                            //chnage the like amount and heart colour
                            value = parseInt(document.getElementById('like '+id).innerHTML);
                            document.getElementById('like '+id).innerHTML = value + 1;
                            document.getElementById('heart '+id).style.backgroundColor='red';
                        } else {
                            alert("error");
                        }
                    }
                }
                ajax.send("id="+id+"&action="+action);
            }
        </script>
        <style>
            .column-3 {
                text-shadow:1px 1px 0 #fff;
            }
            body {
                overflow-y: hidden;
            }
        </style>
    </head>
    <body>
        <div class="column column-4" id="<?php echo $id?>">
            <div class="row">
                <div class="column column-3" style="font-size: 25px;background-color: <?php echo $col1?>"><?php echo $col1?></div>
                <div class="column column-3" style="font-size: 25px;background-color: <?php echo $col2?>"><?php echo $col2?></div>
                <div class="column column-3" style="font-size: 25px;background-color: <?php echo $col3?>"><?php echo $col3?></div>
                <div class="column column-3" style="font-size: 25px;background-color: <?php echo $col4?>"><?php echo $col4?></div>
            </div>
            <div class="info">
                <span class="like">
                    <div class="heart" id="heart <?php echo $id?>" onclick="like(<?php echo $id?>,like)"></div>
                    <div class="likes" style="position:relative;left:14vw;font-size:6vw;" id="like <?php echo $id?>"><?php echo $likes?></div>
                </span>
                <span class="date" style="font-size: 6vw;"><?php echo $date?></span>
            </div>
        </div>
    </body>
</html>