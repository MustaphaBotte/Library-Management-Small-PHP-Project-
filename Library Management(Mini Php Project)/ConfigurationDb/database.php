<?php

class ClsDataBase
{
  private static $Host='localhost';
  private static $Db='Biblio';
  private static $user='root';
  private static $pass='';
  private static $PDO=null;

  public static function GetConnection():?object
  {
    $Data_Source="mysql:host=".self::$Host .";dbname=".self::$Db .";charset=utf8mb4";
    if(self::$PDO!=null)
    {
        return self::$PDO;
    }
    try
    {      
        $PDO =new PDO($Data_Source,self::$user,self::$pass);
        $PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $PDO;
        
    }catch(PDOException $EX)
    {
        return $EX;
    }

  }

}
?>

