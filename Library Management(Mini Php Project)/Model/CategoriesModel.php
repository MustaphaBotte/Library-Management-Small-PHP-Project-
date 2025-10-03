<?php
require_once __DIR__."/../ConfigurationDb/database.php";

class ManageCategories
{
 public static function GetAllCategories(): array
{
    $Query="SELECT * from categories";
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