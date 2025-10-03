<?php
require_once __DIR__."/../ConfigurationDb/database.php";
 class Book
{
    public int $BookId=-1;
    public string $Isbn;
    public string $BookName;
    public ?string $BookDescription;  
    public ?int $NumberOfPages;
    public ?string $PublishedAt;    
    public ?string $BookLanguage;
    public ?int $AuthorID;
    public ?int $CategoryId;
}

class ManageBook
{
private static function TheSearchAttributAndValue(int $ID=-1,string $ISBN="",string $Name=""):array
{
    $Field ="";
    $Value="";
     if($ID!=-1)
     {
       $Field ="bookid";
       $Value=$ID;
     }
     else if($ISBN!="")
    {
      $Field = "Isbn";
      $Value = $ISBN;
    }
    else if($Name!="")
    {
        $Field = "BookName";
        $Value = $Name;
    }
    
    if($Value!= "" && $Field!="")
    {
        return ["Field"=>$Field , "Value"=>$Value];
        
    }
    return [];
}
public static function GetBook(int $ID=-1,string $ISBN="",string $Name=""): ?Book
{

   $Attr= self::TheSearchAttributAndValue($ID,$ISBN,$Name);
   if($Attr==[])
   {  
    return null;
   } 
   $Query="SELECT books.* from books 
   where ".$Attr['Field'] ."= :value 
   LIMIT 1";
   $PDO =ClsDataBase::GetConnection();
   if($PDO==null || $PDO instanceof PDOException)
   {  
    throw new Exception($PDO->getMessage()) ;
   }
        try 
        {
            $STMT = $PDO->prepare($Query);
            $Result = $STMT->execute([":value" => $Attr["Value"]]);
            if ($Result)
           {
                $Row = $STMT->fetch(PDO::FETCH_ASSOC);
                if (($Row)) {
                    $_Book = new Book();
                    $_Book->BookId = (int) $Row["BookId"];
                    $_Book->Isbn = (string) $Row["Isbn"];
                    $_Book->BookName = (string) $Row["BookName"];
                    $_Book->BookDescription = isset($Row["BookDescription"]) ? (string) $Row["BookDescription"] : null;
                    $_Book->NumberOfPages = isset($Row["NumberOfPages"]) ? (int) $Row["NumberOfPages"] : null;
                    $_Book->PublishedAt = isset($Row["PublishedAt"]) ? (string) $Row["PublishedAt"] : null;
                    $_Book->BookLanguage = isset($Row["BookLanguage"]) ? (string) $Row["BookLanguage"] : null;
                    $_Book->AuthorID = isset($Row["AuthorId"])  ? (int) $Row["AuthorId"] : null;
                    $_Book->CategoryId = isset($Row["CategoryId"]) ?$Row["CategoryId"]  : null;
                    return $_Book;
                }
            }
        }

        catch(Exception $Ex)
        {
          return null;
        }


   return null;
}
public static function GetAllBooks()
{
    $Query="SELECT Books.* ,authors.FirstName,authors.LastName,Categoryname from books
     inner join authors on books.authorid = authors.authorid
     inner join categories on categories.CategoryId = books.CategoryId";
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
public static function DeleteBook(int $ID=-1,string $ISBN="",string $Name=""):bool
{
    $Attr= self::TheSearchAttributAndValue($ID,$ISBN,$Name);
    if($Attr==[])
    {  
     return false;
    } 
    $Query="DELETE from Books where ".$Attr["Field"] ." = :Value";
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
 public static function AddBook( string $BookName, string $Isbn,string $BookDescription,?int $NumberOfPages,
                      ?string $PublishedAt ,?string $BookLanguage, ?string $AuthorID,?string $CategoryID):bool
 {

    if(empty($BookName) || empty($Isbn))
    {
        return false;
    }
    $Query="INSERT into Books (Isbn,bookname,bookdescription,numberofpages,publishedat,booklanguage,AuthorID,CategoryID)".
    "VALUES (
        :isbn, 
        :bookname, 
        :bookdescription, 
        :numberofpages, 
        :publishedat, 
        :booklanguage, 
        :authorid, 
        :categoryid
      )";
    $PDO = ClsDataBase::GetConnection();
    if($PDO==null ||$PDO instanceof PDOException)
    {
      return false;
    }
 
    try 
    {
     $stmt =  $PDO->prepare($Query);
     $Result = $stmt->execute([
        ':isbn' => $Isbn,
        ':bookname' => $BookName,
        ':bookdescription' => $BookDescription,
        ':numberofpages' => $NumberOfPages,
        ':publishedat' => $PublishedAt,
        ':booklanguage' => $BookLanguage,
        ':authorid' => $AuthorID,
        ':categoryid' => $CategoryID]);
        if($Result)
        {
          $RowsAffected = $stmt->rowCount();
          if($RowsAffected > 0)
          {
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

 public static function UpdateBook(Book $_Book):bool
 {
 if($_Book==null || empty($_Book->BookName)|| $_Book->BookId==-1 ||empty($_Book->Isbn))
 {
  return false;
 }
 $query = "UPDATE books  SET 
           Isbn = :isbn,
           BookName = :bookname,
           BookDescription = :bookdescription,
           NumberOfPages = :numberofpages,
           PublishedAt = :publishedat,
           BookLanguage = :booklanguage,
           AuthorId = :authorid,
           CategoryId = :categoryid
           WHERE BookId = :bookid";

  $PDO = ClsDataBase::GetConnection();
  if($PDO==null || $PDO instanceof PDOException)
  {

    return false;
  }

        try 
        {
          $stmt = $PDO->prepare($query);
          $Result = $stmt->execute([
            ':isbn' => $_Book->Isbn,
            ':bookname' => $_Book->BookName,
            ':bookdescription' => $_Book->BookDescription,
            ':numberofpages' => $_Book->NumberOfPages,
            ':publishedat' => $_Book->PublishedAt,
            ':booklanguage' => $_Book->BookLanguage,
            ':authorid' => $_Book->AuthorID,          
            ':categoryid' => $_Book->CategoryId,
            ':bookid' => $_Book->BookId
          ]);
          
          if($Result)
          {
           $RowsAffected = $stmt->rowCount();
           if($RowsAffected>0)
           {
            return true;
           }return false;
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