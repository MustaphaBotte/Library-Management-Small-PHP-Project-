<?php
require_once __DIR__."/../ConfigurationDb/database.php";

class ManageCountries
{
 public static function GetAllCountries(): array
{
    $Query="SELECT * from countries";
   $PDO =ClsDataBase::GetConnection();
   if($PDO==null || $PDO instanceof PDOException)
   {
     return [$PDO->getMessage()];
   };
       try {
           $stmt = $PDO->query($Query);
           $result = $stmt->execute();
           if ($result) {
               $Rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
               if (count($Rows) > 0) {
                   return $Rows;
               }
               return [];
           }
       }
       catch(Exception $Ex)
       {
           return [];
       }
   return [];
}

}



?>