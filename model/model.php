<?php
session_start();
class clinic
{
    private $searchKEY = "";

    public function __construct() {
        $mysql = new MySQLi("localhost" , "root", "")  or die(mysqli_connect_error());

        if (!mysqli_select_db($mysql,'doctorsdb')) {
            $sql = "CREATE DATABASE IF NOT EXISTS doctorsdb";
           // $sql2 = "CREATE DATABASE IF NOT EXISTS doctorsdb";
            if (!mysqli_query($mysql, $sql)) {
               echo "Error creating database: " . mysqli_error($mysql);
            }
            }
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $sql = "CREATE TABLE IF NOT EXISTS clients(
                id int primary key AUTO_INCREMENT,
                name varchar(50) NOT NULL,
                surname varchar(50) not null,
                email varchar(100) not null,
                card varchar(20) not null,
                pass varchar(100) not null
                );";
            if (!mysqli_query($mysql, $sql)) {
                echo "Error creating table client: " . mysqli_error($mysql);
            }    
        
            $sql2 = "CREATE TABLE IF NOT EXISTS doctors(
                id int primary key AUTO_INCREMENT,
                name varchar(50) NOT NULL,
                surname varchar(50) not null,
                speciality varchar(50) not null,
                fee varchar(100) not null,
                date varchar(50) NOT NULL,
                timefrom varchar(50) not null,
                timeto varchar(50) not null
                );";
            if (!mysqli_query($mysql, $sql2)) {
                echo "Error creating table doctors: " . mysqli_error($mysql);
            }
            
            $sql3 = "CREATE TABLE IF NOT EXISTS booking(
                id int primary key AUTO_INCREMENT,
                clientID int,
                docID int,
                date varchar(50) NOT NULL,
                time varchar(50) NOT NULL
                );";
            if (!mysqli_query($mysql, $sql3)) {
                echo "Error creating table booking: " . mysqli_error($mysql);
            }

            mysqli_close($mysql);
    }

    public function register($fname,$lname,$email,$pass,$card)
    {
    $sql = new MySQLi("localhost" , "root", "" , "doctorsdb");

    $sql->query("INSERT INTO clients (name,surname,email,pass,card) VALUES('$fname','$lname','$email','$pass','$card');");
        if(!$sql)
        {
            $this->error();
            include('view/error.php');
        }
        else
        {
            header("Location:index.php");
            //include('view/home.php');
        }
    mysqli_close($sql);
    }

    public function login($email,$pass)
    {
    $sql = new MySQLi("localhost" , "root", "" , "doctorsdb");
    $result = $sql->query("SELECT `id`,`email`,`pass` FROM `clients` WHERE email='$email' and pass='$pass';");
    
    if(!$sql)
        {
            die("Connection failed : " . mysqli_connect_error());
        }
        else
        {
            $a = $result->fetch_assoc();
            if($a['email'] != '' && $a['pass'] != ''){
                $_SESSION['user'] = $email;
                $_SESSION['id'] = $a['id'];
                header("Location:index.php?value=list");
            }
            else{
                $this->error();
                include('view/error.php');            }
        }
        mysqli_close($sql);
    }

    public function bookDoc($docid, $clientid)
    {
        $sql = new MySQLi("localhost" , "root", "" , "doctorsdb"); 
        
        $sql->query("INSERT INTO booking (clientID, docID, date, time) VALUES ($clientid, $docid, CURDATE(), CURTIME());");
        
        mysqli_close($sql);
        include('view/docList.php');
    }
    
    public function error(){
        echo"Error!";
    }
    
    public function addDoctor($name,$surname,$spec,$fee,$date,$from,$to)
    {  
        $sql = new MySQLi("localhost" , "root", "", "doctorsdb");

        $sql->query("INSERT INTO doctors (name,surname,speciality,fee,date,timefrom,timeto) VALUES ('$name','$surname','$spec','$fee','$date','$from','$to')");
        if(!$sql)
        {
            $this->error();
            include('view/error.php');
        }
        else
        {
            include('view/home.php');
        }
        mysqli_close($sql);
    }

    public function doctorList()
    {
        $sql = new MySQLi("localhost" , "root", "" , "doctorsdb");
        $result = $sql->query("SELECT * FROM `doctors`;");
        $i = 0;
        $set = [];

        if(!$sql)
        {
            die("Connection failed : " . mysqli_connect_error());
        }
        else
        {
            while($result->num_rows!=$i){
                $row = $result->fetch_assoc();
                $set[$i] = array($row['name'],$row['surname'],$row['speciality'],$row['fee'],$row['id'],$row['date'],$row['timefrom'],$row['timeto']);
                $i++;
            }
        }
        
        mysqli_close($sql);
        
        return $set;
    }
    public function GETsearch($docKEY){
        $_SESSION['search'] = $docKEY;
        include('view/docList.php');
    }
    
    public function SETsearch(){
        $sql = new MySQLi("localhost" , "root", "" , "doctorsdb"); 
        $set = [];
        $i = 0;
        
        if(isset($_SESSION['search'])){
            $key = $_SESSION['search'];
        
        $doc = $sql->query("SELECT * FROM `doctors` WHERE `name` LIKE '%$key%' OR `surname` LIKE '%$key%' OR `speciality` LIKE '%$key%';");        
        if(!$sql)
        {
            die("Connection failed : " . mysqli_connect_error());
        }
        else
        {
            while($doc->num_rows!=$i){
                $row = $doc->fetch_assoc();
                $set[$i] = array($row['name'],$row['surname'],$row['speciality'],$row['fee'],$row['id'],$row['date'],$row['timefrom'],$row['timeto']);
                $i++;
            }
        }
    }
        mysqli_close($sql);          
        return $set;
    }


    public function notificationClient()
    {
        $clientID = $_SESSION['id'];
        $clientName=$_SESSION['user'];

        //echo $clientID;

        $sql = new MySQLi("localhost", "root", "", "doctorsdb");
        $i = 0;
        $set = [];
        $set2 = [];
        $set3 = [];

         //print_r($doc);
         if(!$sql)
         {
             die("Connection failed : " . mysqli_connect_error());
         }
         else if($clientName=="admin@admin.com")
         {
            $data = $sql->query("SELECT `id`,`clientID`, `docID`, `date`, `time` FROM `booking`;");
             while($data->num_rows!=$i){
                 $row = $data->fetch_assoc();
                 $patientId=$row['clientID'];
                 $data4=$sql->query("SELECT `email` FROM `clients` WHERE `id`=".$patientId.";");
                 $row2 = $data4->fetch_assoc();
                 $patientName=$row2['email'];
                 $set[$i] = array($row['id'],$row['docID'],$row['date'],$row['time'],$patientName);
                 $i++;
             }
            /* while($data4->num_rows!=$i){
                 $patientName=$sql->query("SELECT `email` FROM `clients` WHERE `id` = ".$row['id'].";");
                 $row2 = $data4->fetch_assoc();
                 $i++;
             }*/

        for($j=0; $j<count($set); $j++){
            if(!$sql)
            {
                die("Connection failed : " . mysqli_connect_error());
            }
            else
            {
                $dataDoc = $sql->query("SELECT * FROM `doctors` WHERE `id` = ".$set[$j][1].";");
                $row = $dataDoc->fetch_assoc();
                $set2[$j] = array($row['name'], $row['surname'], $row['fee'], $row['date']);
            }
            }
        }
        else {
          $data = $sql->query("SELECT `id`, `docID`, `date`, `time` FROM `booking` WHERE `clientID` = '$clientID';");
           while($data->num_rows!=$i){
               $row = $data->fetch_assoc();
               $patientName="";
               $set[$i] = array($row['id'],$row['docID'],$row['date'],$row['time'],$patientName);
               $i++;
           }

      for($j=0; $j<count($set); $j++){
          if(!$sql)
          {
              die("Connection failed : " . mysqli_connect_error());
          }
          else
          {
              $dataDoc = $sql->query("SELECT * FROM `doctors` WHERE `id` = ".$set[$j][1].";");
              $row = $dataDoc->fetch_assoc();
              $set2[$j] = array($row['name'], $row['surname'], $row['fee'], $row['date']);
          }
          }
        }

        mysqli_close($sql);
        //print_r($set2);

        for($i=0; $i<count($set); $i++){
            $set3[$i] = array_merge($set[$i], $set2[$i]);
        }

        return $set3;
    }

   /* public function notificationDoctor($docID)
    {
        $sql = new MySQLi("localhost", "root", "", "doctorsdb");
        
        $data = $sql->query("SELECT `clientID`, `date`, `time` FROM `booking` WHERE `docID` = '$docID';");
        $data2 = $data->fetch_assoc();
        
        $id = $data2['clientID'];
        
        $dataClient = $sql->query("SELECT * FROM `clients` WHERE `id` = $id;");
        $dataClient2 = $dataDoc->fetch_assoc();

        $set = merge_array($data2, $dataClient2);

        return $set;
    }
*/
    public function editDoctor($name,$surname,$spec,$fee,$date,$from,$to,$id)
    {
        $sql = new MySQLi("localhost" , "root", "", "doctorsdb");
        echo $name.$surname.$spec.$fee." ".$date." ".$from." ".$to." ".$id;
        $sql->query("UPDATE `doctors` SET `name`='".$name."',`surname`='".$surname."',`speciality`='".$spec."',`fee`='".$fee."',`date`='".$date."',`timefrom`='".$from."',`timeto`='".$to."' WHERE `id`= $id");
        if(!$sql)
        {
            $this->error();
            include('view/error.php');
        }
        else
        {
            include('view/addDoctors.php');
        }
        mysqli_close($sql);
    }

    public function deleteDoc($id)
    {
        $sql = new MySQLi("localhost" , "root", "", "doctorsdb");

        $sql->query("DELETE FROM `doctors` WHERE `id` = $id");
        if(!$sql)
        {
            $this->error();
            include('view/error.php');
        }
        else
        {
            include('view/addDoctors.php');
        }
        mysqli_close($sql);
        
    }

    public function cancelApp($appID)
    {
        $sql = new MySQLi("localhost" , "root", "", "doctorsdb");

        $sql->query("DELETE FROM `booking` WHERE `id` = $appID");
        if(!$sql)
        {
            $this->error();
            include('view/error.php');
        }
        else
        {
            include('view/profile.php');
        }
        mysqli_close($sql);
    }

    public function logout()
    {   
        unset($_SESSION['user']);
        unset($_SESSION['id']);
        unset($_SESSION['search']);
        session_destroy();
        include('view/home.php');
        return 1;
    }
}
