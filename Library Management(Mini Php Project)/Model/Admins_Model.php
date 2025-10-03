<?php
require_once __DIR__ ."/../ConfigurationDb/database.php";
class Admin
{
    public int $AdminId = -1;
    public string $FirstName;
    public string $LastName;
    public string $Phone;
    public ?string $Mail = null;
    public ?string $DateOfBirth = null;
    public string $Gender; 
    public ?int $NationalityId = null;
    public ?string $Address = null;
    public string $AdminStatus = 'active'; // 'active', 'inactive', or 'suspended'
    public string $UserName;
    public string $Password;
    public ?int $CreatedBy = null;
    public ?string $CreatedAt = null;
}


class ManageAdmins
{

    private static function TheSearchAttributAndValue(int $ID=-1,string $UserName=""):array
    {
        $Field ="";
        $Value="";
         if($ID!=-1)
         {
           $Field ="adminid";
           $Value=$ID;
         }
         else if($UserName!="")
        {
          $Field = "username";
          $Value = $UserName;
        }
        
        if($Value!= "" && $Field!="")
        {
            return ["Field"=>$Field , "Value"=>$Value];
            
        }
        return [];
    }
    public static function GetAdmin(string $username,$password): ?Admin
    {
    
       
       if(empty($username)|| empty($password))
       {  
        return null;
       } 
       $Query="SELECT admins.* from admins 
       where username= :user and password =:password 
       LIMIT 1";
       $PDO =ClsDataBase::GetConnection();
       if($PDO==null || $PDO instanceof PDOException)
       {  
        throw new Exception($PDO->getMessage()) ;
       }
            try 
            {
                $STMT = $PDO->prepare($Query);
                $Result = $STMT->execute([":user" => $username,"password"=> $password]);
                if ($Result)
               {
                    $row = $STMT->fetch(PDO::FETCH_ASSOC);
                    if (($row)) {
                        $_Admin= new Admin();
                        $_Admin->AdminId = $row['AdminId'] ?? -1;
                        $_Admin->FirstName = $row['FirstName'];
                        $_Admin->LastName = $row['LastName'];
                        $_Admin->Phone = $row['Phone'];
                        $_Admin->Mail = $row['Mail'] ?? null;
                        $_Admin->DateOfBirth = $row['DateOfBirth'] ?? null;
                        $_Admin->Gender = $row['Gender'];
                        $_Admin->NationalityId = $row['NationalityId'] ?? null;
                        $_Admin->Address = $row['Address'] ?? null;
                        $_Admin->AdminStatus = $row['AdminStatus'] ?? 'active';
                        $_Admin->UserName = $row['UserName'];
                        $_Admin->Password = $row['PassWord'];
                        $_Admin->CreatedBy = $row['CreatedBy'] ?? null;
                        $_Admin->CreatedAt = $row['CreatedAt'] ?? null;
                        return $_Admin;
                    }
                }
            }
    
            catch(Exception $Ex)
            {
              return null;
            } 
       return null;
    }

    public static function GetAllAdmins()
    {
        $Query="SELECT *  from admins "
        ."INNER JOIN countries on nationalityid= countries.countryid";
        
        $PDO =ClsDataBase::GetConnection();
        if($PDO==null || $PDO instanceof PDOException)
        {
          return (object)[$PDO->getMessage()];
        };
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
            }
            catch(Exception $Ex)
            {
                return null;
            }
        return null;
    }
    public static function DeleteAdmin(int $ID=-1,string $UserName=""):bool
    {
        $Attr= self::TheSearchAttributAndValue($ID,$UserName);
        if($Attr==[])
        {  
         return false;
        } 
        $Query="DELETE from Admins where ".$Attr["Field"] ." = :Value";
        $PDO =ClsDataBase::GetConnection();
        if($PDO==null || $PDO instanceof PDOException)
        {  
         throw new Exception($PDO->getMessage()) ;
        }
            try {
                $STMT = $PDO->prepare($Query);
                $Result = $STMT->execute([":Value" => $Attr["Value"]]);
                if ($Result) {
                    $RowsAffected = $STMT->rowCount();
                    if ($RowsAffected > 0) {
                        return true;
                    }
                    
                    return false;
                }
            }
            catch(Exception $Ex)
            {
                return false;
            }
        return false;
    }
    
    public static function AddAdmin(string $FirstName,string $LastName,string $Phone,?string $Mail,?string $DateOfBirth,string $Gender,
    ?int $NationalityId,?string $Address,string $Status ,string $UserName,string $Password,?int $CreatedBy,?string $CreatedAt ): bool
    {

        if (empty($FirstName) || empty($LastName)|| empty($Phone)|| empty($Gender)|| empty($Status)|| empty($UserName)
        || empty($Password) || strlen( $Password)<8) {
            return false;
        }
        if(! in_array(strtolower($Gender),["male","female"]))
        {
            return false;
        }
        if(! in_array(strtolower($Status),["active","inactive","suspended"]))
        {
            return false;
        }

        $Query = "INSERT into Admins (FirstName,LastName,Phone, Mail, DateOfBirth, Gender, NationalityId,"
         ."Address, AdminStatus, UserName, Password, CreatedBy, CreatedAt)"
            ."VALUES (
                :firstName,
                :lastName,
                :phone,
                :mail,
                :dateOfBirth,
                :gender,
                :nationalityId,
                :address,
                :status,
                :userName,
                :password,
                :createdBy,
                :createdAt
                )";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return false;
        }
        echo $Password;
        try {
            $stmt = $PDO->prepare($Query);
            $Result = $stmt->execute([
            ':firstName' => $FirstName,
            ':lastName' => $LastName,
            ':phone' => $Phone,
            ':mail' => $Mail,
            ':dateOfBirth' => $DateOfBirth,
            ':gender' => $Gender,
            ':nationalityId' => $NationalityId,
            ':address' => $Address,
            ':status' => $Status,
            ':userName' => $UserName,
            ':password' => password_hash($Password, PASSWORD_DEFAULT),
            ':createdBy' => $CreatedBy,
            ':createdAt' => $CreatedAt
            ]);
            if ($Result) {
                $RowsAffected = $stmt->rowCount();
                if ($RowsAffected > 0) {
                    return true;
                }
                return false;
            }
           }
         catch (Exception $Ex) 
         {
            return false;
         }
        return false;
    }

    public static function UpdateAdmin(Admin $_Admin)
    {
        if (empty($_Admin->FirstName) || empty($_Admin->LastName)|| empty($_Admin->Phone)
        || empty($_Admin->Gender)||  empty($_Admin->AdminStatus)|| empty($_Admin->UserName)
        || empty($_Admin->Password) || strlen( $_Admin->Password)<8)
        {
            return false;
        }
        if(! in_array(strtolower($_Admin->Gender),["male","female"]))
        {
            return false;
        }
        if(! in_array(strtolower($_Admin->AdminStatus),["active","inactive","suspended"]))
        {
            return false;
        }
        $query = 'UPDATE admins  SET 
            firstName =:firstname,    
            lastName = :lastname, 
            phone = :phone, 
            mail = :mail, 
            dateOfBirth = :dateOfBirth, 
            gender = :gender, 
            nationalityId = :nationalityId, 
            address = :address, 
            AdminStatus = :status, 
            userName =:userName, 
            password =:password, 
            createdBy = :createdBy, 
            createdAt = :createdAt
            WHERE adminid = :adminid or username = :username';
        $PDO =ClsDataBase::GetConnection();
        if($PDO==null || $PDO instanceof PDOException)
            {  
              throw new Exception($PDO->getMessage()) ;
            }
        try 
        {
            $stmt = $PDO->prepare($query);
            
            $Result = $stmt->execute([
            ':firstname' => $_Admin->FirstName,
            ':lastname' => $_Admin->LastName,
            ':phone' => $_Admin->Phone,
            ':mail' => $_Admin->Mail,
            ':dateOfBirth' => $_Admin->DateOfBirth,
            ':gender' => $_Admin->Gender,
            ':nationalityId' => $_Admin->NationalityId,
            ':address' => $_Admin->Address,
            ':status' => $_Admin->AdminStatus,
            ':userName' => $_Admin->UserName,
            ':password' => password_hash($_Admin->Password, PASSWORD_DEFAULT),
            ':createdBy' => $_Admin->CreatedBy,
            ':createdAt' => $_Admin->CreatedAt,
            ':adminid' => $_Admin->AdminId,
            ':username' => $_Admin->UserName
            ]);
          
          if($Result)
          {
              $RowsAffected = $stmt->rowCount();
              if($RowsAffected>0)
             {
                return true;
             }
             return false;
          }
        }
        catch (Exception $EX) 
        {
            return false;
        }
        return false;
    } 


}
?>