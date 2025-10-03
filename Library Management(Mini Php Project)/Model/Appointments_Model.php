<?php
require_once __DIR__."/../ConfigurationDb/database.php";

class Appointment
{
    public int $AppointmentId = -1;
    public int $UserId;
    public string $AppointmentDate;
    public string $AppointmentTime;
    public ?string $Description;
    public string $CreatedAt;
    public ?int $CreatedBy;
}

class ManageAppointment
{
    private static function TheSearchAttributAndValue(int $ID = -1, int $UserId = -1, string $Date = ""): array
    {
        $Field = "";
        $Value = "";

        if ($ID != -1) {
            $Field = "AppointmentId";
            $Value = $ID;
        } 
        else if ($UserId != -1) {
            $Field = "UserId";
            $Value = $UserId;
        } else if ($Date != "") {
            $Field = "AppointmentDate";
            $Value = $Date;
        }

        if ($Value !== "" && $Field !== "") {
            return ["Field" => $Field, "Value" => $Value];
        }
        return [];
    }

    public static function GetAppointment(int $ID = -1, int $UserId = -1, string $Date = ""): ?Appointment
    {
        $Attr = self::TheSearchAttributAndValue($ID, $UserId, $Date);
        if ($Attr == []) {
            return null;
        }

        $Query = "SELECT * FROM Appointments WHERE " . $Attr['Field'] . " = :value LIMIT 1";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            throw new Exception($PDO->getMessage());
        }

        try {
            $STMT = $PDO->prepare($Query);
            $Result = $STMT->execute([":value" => $Attr["Value"]]);
            if ($Result) {
                $Row = $STMT->fetch(PDO::FETCH_ASSOC);
                if ($Row) {
                    $_Appointment = new Appointment();
                    $_Appointment->AppointmentId = (int)$Row["AppointmentId"];
                    $_Appointment->UserId = (int)$Row["UserId"];
                    $_Appointment->AppointmentDate = (string)$Row["AppointmentDate"];
                    $_Appointment->AppointmentTime = (string)$Row["AppointmentTime"];
                    $_Appointment->Description = isset($Row["Description"]) ? (string)$Row["Description"] : null;
                    $_Appointment->CreatedAt = (string)$Row["CreatedAt"];
                    $_Appointment->CreatedBy = isset($Row["CreatedBy"]) ? (int)$Row["CreatedBy"] : null;
                    return $_Appointment;
                }
            }
        } catch (Exception $Ex) {
            echo $Ex->getMessage();
            return null;
        }
        return null;
    }

    public static function GetAllAppointments()
    {
        $Query = "SELECT * FROM Appointments";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return (object)[$PDO->getMessage()];
        }

        try {
            $stmt = $PDO->query($Query);
            $result = $stmt->execute();
            if ($result) {
                $Rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($Rows) > 0) {
                    return $Rows;
                }
                return null;
            }
        } catch (Exception $Ex) {
            return null;
        }
        return null;
    }

    public static function DeleteAppointment(int $ID = -1): bool
    {
        if ($ID == -1) {
            return false;
        }
        $Query = "DELETE FROM Appointments WHERE AppointmentId = :Value";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            throw new Exception($PDO->getMessage());
        }
        try {
            $STMT = $PDO->prepare($Query);
            $Result = $STMT->execute([":Value" => $ID]);
            if ($Result) {
                $RowsAffected = $STMT->rowCount();
                return $RowsAffected > 0;
            }
            return false;
        } catch (Exception $Ex) {
            return false;
        }
    }

    public static function AddAppointment(int $UserId=-1,string $AppointmentDate,string $AppointmentTime,?string $Description,string $CreatedAt,?int $CreatedBy): bool {
        if ($UserId==-1 || empty($AppointmentDate) || empty($AppointmentTime) || empty($CreatedAt)) {
            return false;
        }
        $Query = "INSERT INTO Appointments (UserId, AppointmentDate, AppointmentTime, Description, CreatedAt, CreatedBy) 
                  VALUES (:userid, :appointmentdate, :appointmenttime, :description, :createdat, :createdby)";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return false;
        }
        try {
            $stmt = $PDO->prepare($Query);
            $Result = $stmt->execute([
                ':userid' => $UserId,
                ':appointmentdate' => $AppointmentDate,
                ':appointmenttime' => $AppointmentTime,
                ':description' => $Description,
                ':createdat' => $CreatedAt,
                ':createdby' => $CreatedBy,
            ]);
            if ($Result) {
                $RowsAffected = $stmt->rowCount();
                return $RowsAffected > 0;
            }
            return false;
        } catch (Exception $Ex) {
            
            return false;
        }
    }

    public static function UpdateAppointment(Appointment $_Appointment): bool
    {
        if ($_Appointment == null || $_Appointment->AppointmentId == -1 || empty($_Appointment->UserId) || empty($_Appointment->AppointmentDate) || empty($_Appointment->AppointmentTime)) {
            return false;
        }
        $Query = "UPDATE Appointments SET 
                  UserId = :userid,
                  AppointmentDate = :appointmentdate,
                  AppointmentTime = :appointmenttime,
                  Description = :description,
                  CreatedAt = :createdat,
                  CreatedBy = :createdby
                  WHERE AppointmentId = :appointmentid";

        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return false;
        }
        try {
            $stmt = $PDO->prepare($Query);
            $Result = $stmt->execute([
                ':userid' => $_Appointment->UserId,
                ':appointmentdate' => $_Appointment->AppointmentDate,
                ':appointmenttime' => $_Appointment->AppointmentTime,
                ':description' => $_Appointment->Description,
                ':createdat' => $_Appointment->CreatedAt,
                ':createdby' => $_Appointment->CreatedBy,
                ':appointmentid' => $_Appointment->AppointmentId,
            ]);
            if ($Result) {
                $RowsAffected = $stmt->rowCount();
                return $RowsAffected > 0;
            }
            return false;
        } catch (Exception $Ex) {
            return false;
        }
    }
}

?>
