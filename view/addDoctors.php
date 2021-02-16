<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="libCSS\main.css">
    <script src="https://kit.fontawesome.com/5c4e1169df.js" crossorigin="anonymous"></script>
    <script src="libJs\main.js">
    </script>
    <title>Document</title>
</head>
<body>
<nav>
        <ul>
        <li><a style="font-size:100%;font-family:fantasy;"><b>Doctors.lk</b></a></li>
        <li><a class="active" href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="index.php?value=list">All doctors</a></li>
            <?php
           if(!isset($_SESSION['user'])){
              $name = "";
            ?>
            <li><a onclick="show_hide_log()">Login</a></li>
            <li><a onclick="show_hide_reg()">Sign up</a></li>
            <?php
            }
            else if($_SESSION['user'] == "admin@admin.com"){
                $name = "Welcome ".$_SESSION['user'];
            ?>
            <li style="float:right;"><a href="index.php?value=profile">Profile <i class="fas fa-user"></i></a></li>
            <li><a href="index.php?value=modify">Edit</a></li>
            <li><a href="index.php?value=logout">Logout</a></li>
            <?php
            }
            else{
            $name = "Welcome ".$_SESSION['user'];
            ?>
            <li><a href="index.php?value=logout">Logout</a></li>
            <li style="float:right;"><a href="index.php?value=profile">Profile <i class="fas fa-user"></i></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
<nav>
  <h3 style="color:white">
  <?php
  echo $name;
  ?>
  </h3>
</nav>

        <div class="subDiv">
            <h1 onClick="addDoc1()">ADD <i class="fas fa-user-plus"></i></h1>
        </div>

        <div class="subDiv">
            <h1 onClick="editDoc()">EDIT <i class="fas fa-edit"></i></h1>
        </div>

        <div class="subDiv">
            <h1 onClick="delDoc()">DELETE <i class="far fa-trash-alt"></i></h1>
        </div>



    <center id="add" class="reg" style="display:none;color:white;">

    <form name="addDoc" method="POST">
        <input type="text" name="dname" placeholder="Doctor's first name"><br>
        <input type="text" name="dsurname" placeholder="Doctor's surname"><br>
        <input type="text" name="spec" placeholder="Speciality"><br>
        <input type="number" name="fee" placeholder="Fee"><br>
        Day :<br>
        <select name="date">
        <option value="">-----</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        </select><br>
        From : <br><input type="time" name="timefrom"><br>
        To : <br><input type="time" name="timeto">
        <input type="button" name="value" value="Add" onclick="addDoctors1()">
    </form>
    </center>

    <center id="edit" class="reg" style="display:none; width:80%; margin:10%">
    <table style="color:white">
    <form name="editDocDB2" method="POST">
    <?php
    $obj = new clinic();
    $arr = $obj-> doctorList();
    // print_r($arr);
    for($i=0; $i<sizeof($arr); $i++){
        // echo $arr[$i][0];
    ?>
    
    <tr name="tr">
    <td name="td" width=150 height=150><img src="banner3.jpg" width=150 height=150></td>
    <td name="td"><input type="text" name="dname" value="<?php echo $arr[$i][0]?>"></td>
    <td name="td"><input type="text" value="<?php echo $arr[$i][1]?>" name="dsurname"></td>
    <td name="td"><input type="text" value="<?php echo $arr[$i][2]?>" name="spec"></td>
    <td name="td"><input type="text" value="<?php echo $arr[$i][3]?>" name="fee"></td>
    <td name="td"><select value="<?php echo $arr[$i][5]?>" name="date">
        <option value="">-----</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        </select></td>
    <td name="td"><input type="time" value="<?php echo $arr[$i][6] ?>" name="timefrom"></td>
    <td name="td"><input type="time" value="<?php echo $arr[$i][7] ?>" name="timeto"></td>
    <td><input type="button" style="width:100%; background-color: green; border: 2px solid #00ff5a" onclick="editDB('<?php echo $arr[$i][4]?>')" value="Edit"></td>
    </tr>
    
    <?php
    }
    ?>
    </form>
    </table>
    </center>

    <center id="delete" class="reg" style="display:none">
    <table style="color:white">
    <?php
    $obj = new clinic();
    $arr = $obj-> doctorList();
    // print_r($arr);
    for($i=0; $i<sizeof($arr); $i++){
        // echo $arr[$i][0];
    ?>
    <tr>
    <td width=200 height=150><img src="banner3.jpg" width=150 height=100></td>
    <td style="width:100%; height: 250px; text-align:center"><b>Dr.<?php echo $arr[$i][0]." ".$arr[$i][1] ?> <br>
    <i><?php echo $arr[$i][2] ?></i>
    <p>Fee Rs: <?php echo $arr[$i][3] ?></p>
    <p><?php echo "from :".$arr[$i][6]." to :".$arr[$i][7]." on ".$arr[$i][5]."'s"; ?></p>
    <button name="delete" style="background-color: red; border: 2px solid #ff2d2d" onclick="delDocDB(<?php echo $arr[$i][4]?>)">Delete <i class="far fa-trash-alt"></i></button></td>
    </tr>
    <?php
    }
    ?>
    </table>
    </center>

<div style="padding: 5%">
    <center class="reg" id="reg" style="display: none;">
    <form name="register" method="POST" action="index.php" inactive>
        <input type="text" name="fname" placeholder="First name"><br>
        <input type="text" name="lname" placeholder="Last name"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="number" name="card" placeholder="Credit Card number"><br>
        <input type="password" name="pwd" placeholder="Password"><br>
        <input type="password" name="rpwd" placeholder="Re-type password"><br>
        <input type="button" name="value" value="register" onClick="register1()">
    </form>
    </center>
    <center class="reg" id="log" style="display: none;">
    <form name="login"  action="index.php" method="post">
    <input type="email" name="email" placeholder="username">
    <input type="password" name="pass" placeholder="Passowrd">
    <input type="button" name="value" value="login" onClick="login1()">
    </form>
    </center>
</div>


</body>
</html>