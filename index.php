<?php
    include_once("db_conx.php");
    
    $sql = "";
    // Make sure the _GET username is set, and sanitize it
    if(isset($_GET["type"])){
        $type = preg_replace('#[^a-z0-9]#i', '', $_GET['type']);
        switch($type) {
            case "popular": $sql = "SELECT * FROM palletes ORDER BY likes DESC";
                break;
            case "random": $sql = "SELECT * FROM palletes ORDER BY RAND()";
                break;
            case "new": $sql = "SELECT * FROM palletes ORDER BY id DESC";
                break;
            default: $sql = "SELECT * FROM palletes";
                break;
                
        }
    } else {
        $sql = "SELECT * FROM palletes ORDER BY RAND()";
    }

    $statuslist = "";
    $localid = 0;
    $query = mysqli_query($db_conx, $sql);
    $statusnumrows = mysqli_num_rows($query);
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $localid += 1;
        $id = $row["id"];
        $col1 = $row["col1"];
        $col2 = $row["col2"];
        $col3 = $row["col3"];
        $col4 = $row["col4"];
        $likes = $row["likes"];
        $date = $row["date"];
        if($localid == 1)  {
            $statuslist .= '<div class="row"><div class="column column-4" id="'.$id.'"><div class="row"><a href="pallete.php?id='.$id.'" class="lytebox" data-lyte-options="width:200 height:350"><div class="column column-3" style="background-color: '.$col1.'"></div><div class="column column-3" style="background-color: '.$col2.';"></div><div class="column column-3" style="background-color: '.$col3.';"></div><div class="column column-3" style="background-color: '.$col4.'"></div></div></a><div class="info"><span class="like"><div class="heart" id="heart '.$id.'" onclick="like('.$id.',like)"></div><div class="likes" id="like '.$id.'">'.$likes.'</div></span><span class="date">'.$date.'</span></div></div>';
        } elseif($localid == 3)  {
            $statuslist .= '<div class="column column-4" id="'.$id.'"><div class="row"><a href="pallete.php?id='.$id.'" class="lytebox" data-lyte-options="width:200 height:350"><div class="column column-3" style="background-color: '.$col1.'"></div><div class="column column-3" style="background-color: '.$col2.';"></div><div class="column column-3" style="background-color: '.$col3.';"></div><div class="column column-3" style="background-color: '.$col4.'"></div></div></a><div class="info"><span class="like"><div class="heart" id="heart '.$id.'" onclick="like('.$id.',like)"></div><div class="likes" id="like '.$id.'">'.$likes.'</div></span><span class="date">'.$date.'</span></div></div></div>';
        } else {
            $statuslist .= '<div class="column column-4" id="'.$id.'"><div class="row"><a href="pallete.php?id='.$id.'" class="lytebox" data-lyte-options="width:200 height:350"><div class="column column-3" style="background-color: '.$col1.'"></div><div class="column column-3" style="background-color: '.$col2.';"></div><div class="column column-3" style="background-color: '.$col3.';"></div><div class="column column-3" style="background-color: '.$col4.'"></div></div></a><div class="info"><span class="like"><div class="heart" id="heart '.$id.'" onclick="like('.$id.',like)"></div><div class="likes" id="like '.$id.'">'.$likes.'</div></span><span class="date">'.$date.'</span></div></div>';
        }
        if ($localid >= 3) {
            $localid=0;
        }
    }
?>
<?php
if (isset($_POST['action'])){
	$id = $_POST['id'];
    // Insert the status post into the database now
    $sql = "UPDATE palletes SET likes = likes + 1 WHERE id='$id'";
	$query = mysqli_query($db_conx, $sql);
	$id = mysqli_insert_id($db_conx);
    mysqli_close($db_conx);
    echo("done");    
    exit();
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Paletto</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
        <link rel=stylesheet href="styles.css" type="text/css">
        <script type="text/javascript" language="javascript" src="lytebox.js"></script>
        <link rel="stylesheet" href="lytebox.css" type="text/css" media="screen" />
        <script>
			function pop(id){
				document.getElementById('heart ' + id).className ='hvr-pop-click heart';
				  setTimeout(function() {
				  document.getElementById('heart ' + id).className ='heart';
				}, 750);
			}
            function like(id, action) {
                var ajax = ajaxObj("POST", "index.php");
                ajax.onreadystatechange = function() {
                    if(ajaxReturn(ajax) == true) {
                        if(ajax.responseText.indexOf("done") > -1){
                            //chnage the like amount and heart colour
                            value = parseInt(document.getElementById('like '+id).innerHTML);
                            document.getElementById('like '+id).innerHTML = value + 1;
                            document.getElementById('heart '+id).style.backgroundColor='red';
							pop(id);
                        } else {
                            alert("error");
                        }
                    }
                }
                ajax.send("id="+id+"&action="+action);
            }
        </script>
	</head>
	<body>
        <div id="main">
            <?php include_once("header.php");?>
            <div id="motto">
                <span>Discover brand new colours.</span>
            </div>
            <div class id="grid">
                <?php echo $statuslist?>
            </div>
        </div>
	</body>
</html>