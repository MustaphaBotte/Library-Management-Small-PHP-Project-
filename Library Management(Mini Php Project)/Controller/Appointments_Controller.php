<?php
require_once __DIR__ . '/../Model/Appointments_Model.php';

class Appointment_Controller
{
    public static function Handler(): void
    {
        $action = $_GET['action'] ?? 'appointments';

        switch ($action) {
            case 'appointments':
                self::GetAllAppointments();
                break;

            case 'addappointment':
                self::AddAppointment();
                break;

            case 'deleteappointment':
                self::DeleteAppointment();
                break;

            case 'editappointment':
                self::UpdateAppointment();
                break;

            case 'update':
                self::UpdateAppointment();
                break;

            default:
                echo "Unknown action.";
        }
    }

    public static function GetAllAppointments(): void
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: ../View/Login.php");
            exit();
        }

        $appointments = ManageAppointment::GetAllAppointments();
        include "View/Appointments/Appointments.php"; 
    }

    public static function GetAppointment(): void
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: ../View/Login.php");
            exit();
        }

        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $appointment = ManageAppointment::GetAppointment($id);

            if ($appointment !== null) {
                include "../View/EditAppointment.php"; // your edit form view
            } else {
                header("Location: index.php?action=appointments&error=notfound");
            }
        } else {
            header("Location: index.php?action=appointments&error=no_id");
        }
    }

    public static function AddAppointment(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $UserId = $_POST['userid'] ?? -1;
            $AppointmentDate = $_POST['AppointmentDate'] ?? '';
            $AppointmentTime = $_POST['AppointmentTime'] ?? '';
            $Description = $_POST['Description'] ?? null;
            $CreatedAt = date('Y-m-d H:i:s');
            $CreatedBy = $_SESSION['admin']['id'] ?? null;

            $result = ManageAppointment::AddAppointment(
                $UserId,
                $AppointmentDate,
                $AppointmentTime,
                $Description,
                $CreatedAt,
                $CreatedBy
            );

            if ($result) {
                header("Location: index.php?action=appointments&msg=added");
            } else {
                header("Location: ../View/AddAppointment.php?error=add_failed");
            }
        }
    }

    public static function DeleteAppointment(): void
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: ../View/Login.php");
            exit();
        }

        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $deleted = ManageAppointment::DeleteAppointment($id);

            if ($deleted) {
                header("Location: index.php?action=appointments&msg=deleted");
            } else {
                header("Location: index.php?action=appointments&error=delete_failed");
            }
        } else {
            header("Location: index.php?action=appointments&error=no_id");
        }
    }

    public static function UpdateAppointment(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['AppointmentId'])) {
            $appointment = new Appointment();
            $appointment->AppointmentId = (int)$_POST['AppointmentId'];
            $appointment->UserId = (int)$_POST['userid'];
            $appointment->AppointmentDate = $_POST['AppointmentDate'] ?? '';
            $appointment->AppointmentTime = $_POST['AppointmentTime'] ?? '';
            $appointment->Description = $_POST['Description'] ?? null;
            $appointment->CreatedAt = $_POST['CreatedAt'] ?? date('Y-m-d H:i:s');
            $appointment->CreatedBy = $_SESSION['admin']['id'] ?? null;

            $updated = ManageAppointment::UpdateAppointment($appointment);

            if ($updated) {
                header("Location: index.php?action=appointments&msg=updated");
            } else {
                header("Location: ../View/EditAppointment.php?id={$appointment->AppointmentId}&error=update_failed");
            }
        }
    }
}
