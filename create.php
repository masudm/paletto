<?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["col1"])){
	// CONNECT TO THE DATABASE
	include_once("db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$col1 = mysqli_real_escape_string($db_conx, $_POST['col1']);
	$col2 = mysqli_real_escape_string($db_conx, $_POST['col2']);
	$col3 = mysqli_real_escape_string($db_conx, $_POST['col3']);
	$col4 = mysqli_real_escape_string($db_conx, $_POST['col4']);
	// FORM DATA ERROR HANDLING
	if($col1 == "" || $col2 == "" || $col3 == "" || $col4 == ""){
		echo "failed";
        exit();
	} else {
        // Insert the post into the database now
        $sql = "INSERT INTO palletes(col1, col2, col3, col4, date) 
                VALUES('$col1','$col2','$col3','$col4',now())";
        $query = mysqli_query($db_conx, $sql);
        $id = mysqli_insert_id($db_conx);
        mysqli_close($db_conx);
        echo "success";
        exit();
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Paletto: Create!
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
        <link rel=stylesheet href="styles.css" type="text/css">
        <style>
            #create {
                text-align: center;
            }
        </style>
        <script type="text/javascript">
            function submit() {
                var col1 = document.getElementById('col1input').value;
                var col2 = document.getElementById('col2input').value;
                var col3 = document.getElementById('col3input').value;
                var col4 = document.getElementById('col4input').value;
                postToStatus(col1,col2,col3,col4);
                
            }
            function postToStatus(col1,col2,col3,col4){
                var ajax = ajaxObj("POST", "create.php");
                    ajax.onreadystatechange = function() {
                        if(ajaxReturn(ajax) == true) {
                            if(ajax.responseText == "failed"){
                                alert("Error. Could not send to server. Try again later.");
                            } else if(ajax.responseText.indexOf("success") > -1) {
                                window.location = "index.php";
                            }
                        }
                    }
                    ajax.send("col1="+col1+"&col2="+col2+"&col3="+col3+"&col4="+col4);
            }
        </script>
    </head>
    <body>
        <div id="main">
            <?php include("header.php")?>
            <div id="motto">
                <span>Create a new pallete!</span>
            </div>
            <div id="create">
                <div id="col1">
                    <span>Colour 1</span>
                    <input id="col1input"class="color no-alpha" value="#ffffff"/>
                </div>
                <div id="col2">
                    <span>Colour 2</span>
                    <input id="col2input"class="color no-alpha" value="#000000"/>
                </div>
                <div id="col3">
                    <span>Colour 3</span>
                    <input id="col3input"class="color no-alpha" value="#ffffff"/>
                </div>
                <div id="col4">
                    <span>Colour 4</span>
                    <input id="col4input"class="color no-alpha" value="#000000"/>
                </div>
                <div id="submit">
                    <a onclick="submit()">Submit</a>
                </div>
            </div>
            <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
            <script type="text/javascript" src="colors.js"></script>
            <script type="text/javascript" src="jqColorPicker.min.js"></script> 
            <script type="text/javascript" src="index.js"></script>
        </div>
    </body>
</html>