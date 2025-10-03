<?php
require_once __DIR__."/../Model/Admins_Model.php";
session_start();
class Admin_Controller
{

 public static function Handler()
 {
  $Action = isset($_GET['action'])? $_GET['action'] :'login';
 
   switch ($Action)
  {
    case 'login':
       
        Admin_Controller::Login();
        break;

    case 'admins':
       
            Admin_Controller::GetAllAdmins();
            break;
    
    case 'addadmin':
                Admin_Controller::AddAdmin();
                break;
    case 'delete':
                    Admin_Controller::DeleteAdmin();
                    break;

  }

 }
    private static function Login(): void
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $_Admin = new Admin();
            $_Admin = ManageAdmins::GetAdmin($username, $password);
            if ($_Admin != null) {
                
                $_SESSION["admin"] = ["username" => $_Admin->UserName, "password" => $_Admin->Password,"id"=>$_Admin->AdminId];
                header("location: ../View/DashBoard");
            }
        }
    }
    private static function LogOut(): void
    {
        if (isset($_SESSION['admin']))
        {            
                session_destroy();        
                header("location: ../View/Login.php");
        }
    }
 
    public static function GetAllAdmins()
    {
        if (isset($_SESSION['admin']))
        {            
               if($_SESSION['admin']['username']=='admin')
               {
                return ManageAdmins::GetAllAdmins();
               }
               else
               {
                header("location: View/Dashboard.php");
               }
        }
    }
    public static function AddAdmin()
    {
        $firstName = trim($_POST['firstName'] ?? '');
        $lastName = trim($_POST['lastName'] ?? '');
        $userName = trim($_POST['userName'] ?? '');
        $password = $_POST['password'] ?? '';
        $phone = trim($_POST['phone'] ?? '');
        $mail = !empty($_POST['mail']) ? trim($_POST['mail']) : null;
        $dateOfBirth = !empty($_POST['dateOfBirth']) ? trim($_POST['dateOfBirth']) : null;
        $gender = trim($_POST['gender'] ?? '');
        $adminStatus = trim($_POST['adminStatus'] ?? '');
        $address = !empty($_POST['address']) ? trim($_POST['address']) : null;
        $createdBy = $_SESSION['id'] ?? null; 
        $createdAt = date('Y-m-d H:i:s');
        $result = ManageAdmins::AddAdmin($firstName,$lastName,$phone,$mail,$dateOfBirth,
        $gender,1,$address,$adminStatus,$userName,$password,$createdBy,$createdAt);
        if($result)
        {
           header("location: index.php?action=admins");
        }

    }

    public static function DeleteAdmin()
    {
        if(isset($_GET["id"]))
        {

           $id = $_GET["id"];
           if($id==3)
           {
            header("location: index.php?action=admins");
           }
           ManageAdmins::DeleteAdmin($id);
           header("location: index.php?action=admins");



        }









    }




}

?>