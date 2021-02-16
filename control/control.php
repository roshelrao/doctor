<?php
include_once("model/model.php");

class control{
   function invoke()
   {
       $obj = new clinic();
       
       if(isset($_REQUEST['value'])){
        $request = $_REQUEST['value'];
       }
       else{
           $request = "";
       }
       
       switch($request){
            case "register":
                $obj->register($_REQUEST['fname'],$_REQUEST['lname'],$_REQUEST['email'],$_REQUEST['pwd'],$_REQUEST['card']);
            break;
            case "login":
                $obj ->login($_REQUEST['email'],$_REQUEST['pass']);
            break;
            case "list":
                $obj->doctorList();
                include('view/docList.php');
            break;
            case "search":
                $obj->GETsearch($_REQUEST['key']);
            break;
            case "delete":
                $obj->deleteDoc($_REQUEST['id']);
            break;
            case "logout":
                $obj->logout();
            break;
            case "profile":
                include('view/profile.php');
            break;
            case "modify":
                include('view/addDoctors.php');
            break;
            case "addDoc":
                $obj->addDoctor($_REQUEST['dname'],$_REQUEST['dsurname'],$_REQUEST['spec'],$_REQUEST['fee'],$_REQUEST['date'],$_REQUEST['timefrom'],$_REQUEST['timeto']);
            break;
            case "editDocDB":
                $obj->editDoctor($_REQUEST['dname'],$_REQUEST['dsurname'],$_REQUEST['spec'],$_REQUEST['fee'],$_REQUEST['date'],$_REQUEST['timefrom'],$_REQUEST['timeto'],$_REQUEST['id']);
            break;
            case "bookDoc":
                $obj ->bookDoc($_REQUEST['docid'],$_REQUEST['userid']);
            break;
            case "cancelApp":
                $obj ->cancelApp($_REQUEST['appID']);
            break;
            default:
                include('view/home.php');
            break;
       }
   }
}