<?php
require_once __DIR__."/../ConfigurationDb/database.php";

class User
{
    public int $UserId = -1;
    public string $FirstName;
    public string $LastName;
    public string $Phone;
    public ?string $Email;
    public ?int $NationalityId;
    public ?string $Address;
    public string $UserStatus = 'active'; // default active
    public string $Username;
    public string $Password;
    public string $DateOfBirth;
    public string $Gender;
    public ?string $CreatedAt;
    public ?int $CreatedBy;
}

class ManageUser
{
    private static function SearchAttributeAndValue(int $ID = -1, string $Username = ""): array
    {
        $Field = "";
        $Value = "";
        if ($ID != -1) {
            $Field = "UserId";
            $Value = $ID;
        } elseif ($Username != "") {
            $Field = "Username";
            $Value = $Username;
        }

        if ($Value != "" && $Field != "") {
            return ["Field" => $Field, "Value" => $Value];
        }
        return [];
    }

    public static function GetUser(int $ID = -1, string $Username = ""): ?User
    {
        $Attr = self::SearchAttributeAndValue($ID, $Username);
        if ($Attr == []) {
            return null;
        }
        $Query = "SELECT * FROM Users WHERE " . $Attr['Field'] . " = :value LIMIT 1";
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
                    $User = new User();
                    $User->UserId = (int)$Row["UserId"];
                    $User->FirstName = $Row["FirstName"];
                    $User->LastName = $Row["LastName"];
                    $User->Phone = $Row["Phone"];
                    $User->Email = $Row["Email"] ?? null;
                    $User->NationalityId = isset($Row["NationalityId"]) ? (int)$Row["NationalityId"] : null;
                    $User->Address = $Row["Address"] ?? null;
                    $User->UserStatus = $Row["UserStatus"];
                    $User->Username = $Row["Username"];
                    $User->Password = $Row["Password"];
                    $User->DateOfBirth = $Row["DateOfBirth"];
                    $User->Gender = $Row["Gender"];
                    $User->CreatedAt = $Row["CreatedAt"] ?? null;
                    $User->CreatedBy = isset($Row["CreatedBy"]) ? (int)$Row["CreatedBy"] : null;                  
                    return $User;
                }
            }
        } catch (Exception $Ex) {
            
            return null;
        }
        return null;
    }
    public static function GetAllUsers(): ?array
    {
        $Query = "SELECT * FROM Users";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return null;
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

    public static function AddUser(string $FirstName,string $LastName,string $Phone,?string $Email,?int $NationalityId,?string $Address,string $UserStatus,string $Username,string $Password,string $DateOfBirth,string $Gender,?int $CreatedBy = null): bool {
        if (empty($FirstName) || empty($LastName) || empty($Phone) || empty($Username) || empty($Password) 
        || strlen($Password)<8|| empty($DateOfBirth) || empty($Gender)) 
        {   
            return false;
        }
        $Query = "INSERT INTO Users
            (FirstName, LastName, Phone, Email, NationalityId, Address, UserStatus, Username, Password, DateOfBirth, Gender, CreatedAt, CreatedBy)
            VALUES
            (:firstname, :lastname, :phone, :email, :nationalityid, :address, :userstatus, :username, :password, :dateofbirth, :gender, NOW(), :createdby)";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return false;
        }
        try {
            $stmt = $PDO->prepare($Query);
            $Result = $stmt->execute([
                ':firstname' => $FirstName,
                ':lastname' => $LastName,
                ':phone' => $Phone,
                ':email' => $Email,
                ':nationalityid' => $NationalityId,
                ':address' => $Address,
                ':userstatus' => $UserStatus,
                ':username' => $Username,
                ':password' => password_hash($Password, PASSWORD_DEFAULT),
                ':dateofbirth' => $DateOfBirth,
                ':gender' => $Gender,
                ':createdby' => $CreatedBy
            ]);
            if ($Result) {
                $RowsAffected = $stmt->rowCount();
                return $RowsAffected > 0;
            }
        } catch (Exception $Ex) {
          
            return false;
        }
        return false;
    }

    public static function UpdateUser(User $_User): bool
    {
        if ($_User == null || $_User->UserId == -1 || empty($_User->FirstName) || empty($_User->LastName) || empty($_User->Phone) || empty($_User->Username) || empty($_User->Password)|| strlen($_User->Password)<8 || empty($_User->DateOfBirth) || empty($_User->Gender)) {
            return false;
        }
        $Query = "UPDATE Users SET 
            FirstName = :firstname,
            LastName = :lastname,
            Phone = :phone,
            Email = :email,
            NationalityId = :nationalityid,
            Address = :address,
            UserStatus = :userstatus,
            Username = :username,
            Password = :password,
            DateOfBirth = :dateofbirth,
            Gender = :gender,
            CreatedBy = :createdby
            WHERE UserId = :userid";

        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return false;
        }
        try {
            $stmt = $PDO->prepare($Query);
            $Result = $stmt->execute([
                ':firstname' => $_User->FirstName,
                ':lastname' => $_User->LastName,
                ':phone' => $_User->Phone,
                ':email' => $_User->Email,
                ':nationalityid' => $_User->NationalityId,
                ':address' => $_User->Address,
                ':userstatus' => $_User->UserStatus,
                ':username' => $_User->Username,
                ':password' => $_User->Password,
                ':dateofbirth' => $_User->DateOfBirth,
                ':gender' => $_User->Gender,
                ':createdby' => $_User->CreatedBy,
                ':userid' => $_User->UserId
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

    public static function DeleteUser(int $ID = -1, string $Username = ""): bool
    {
        $Attr = self::SearchAttributeAndValue($ID, $Username);
        if ($Attr == []) {
            return false;
        }
        $Query = "DELETE FROM Users WHERE " . $Attr["Field"] . " = :Value";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            throw new Exception($PDO->getMessage());
        }
        try {
            $STMT = $PDO->prepare($Query);
            $Result = $STMT->execute([":Value" => $Attr["Value"]]);
            if ($Result) {
                $RowsAffected = $STMT->rowCount();
                return $RowsAffected > 0;
            }
            return false;
        } catch (Exception $Ex) {
            return false;
        }
    }
}

?>
