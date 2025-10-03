<?php
require_once __DIR__ ."/Controller/Admin_Controller.php";
require_once __DIR__ ."/Controller/Books_Controller.php";
require_once __DIR__ ."/Controller/Appointments_Controller.php";

if (isset($_GET["action"]))
{
    $action = $_GET["action"];
   
    if ($action == "login") 
    {

        Admin_Controller::Handler();
        if (isset($_SESSION["admin"]))
        {
            header("location: View/Dashboard.php");
        }
        else 
        {
            $errors = "Login Failed";
            header("location: View/Login.php?errors=" . $errors);
        }
    }

    if ($action == "admins") 
    {
        if (isset($_SESSION["admin"]))
        {
            $_admins = Admin_Controller::GetAllAdmins();
            if($_admins!=null)
            {
                header("location: View/ManageAdmins.php");
            }
        }
        else 
        {
           header("location: View/Dashboard.php");
        }
    }

    if ($action == "dashboard") 
    {
        
           header("location: View/Dashboard.php");
        
    }






    if ($action == "addadmin") 
    {
        
        if (isset($_SESSION["admin"]))
        {
          Admin_Controller::Handler();
        }
        else 
        {
           header("location: View/Dashboard.php");
        }
    }
    if ($action == "delete") 
    {
        
        if (isset($_SESSION["admin"]))
        {
          Admin_Controller::Handler();
        }
        else 
        {
           header("location: View/Dashboard.php");
        }
    }
    if ($action == "books") 
    {
        
        if (isset($_SESSION["admin"]))
        {
            Book_Controller::Handler();
        }
        else 
        {
           header("location: View/Dashboard.php");
        }
    }
    if ($action == "addbook") 
    {
        
        if (isset($_SESSION["admin"]))
        {
           
            Book_Controller::Handler();
        }
        else 
        {
           header("location: View/Dashboard.php");
        }
    }
    if ($action == "deletebook") 
    {
        
        if (isset($_SESSION["admin"]))
        {
            Book_Controller::Handler();
        }
        else 
        {
           header("location: View/Dashboard.php");
        }
    }
    if ($action == "appointments") 
    {
        
        if (isset($_SESSION["admin"]))
        {
            Appointment_Controller::Handler();
        }
        else 
        {
           header("location: View/Dashboard.php");
        }
    }
    if ($action == "deleteappointment" ||$action == "editappointment" || $action == "addappointment") 
    {
        
        if (isset($_SESSION["admin"]))
        {
            Appointment_Controller::Handler();
        }
        else 
        {
           header("location: View/Dashboard.php");
        }
    }
    

}

    






?>