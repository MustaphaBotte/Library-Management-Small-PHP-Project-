<?php
require_once __DIR__ . "/../ConfigurationDb/database.php";

class Author
{
    public int $AuthorId = -1;
    public string $FirstName;
    public string $LastName;
    public ?int $NationalityId;
    public ?string $DateOfBirth;  // YYYY-MM-DD format
    public string $Gender;
}

class ManageAuthor
{
    public static function AddAuthor(string $FirstName, string $LastName, ?int $NationalityId, ?string $DateOfBirth, string $Gender): bool
    {
        if (empty($FirstName) || empty($LastName) || empty($Gender)) {
            echo "FirstName, LastName and Gender are required.\n";
            return false;
        }

        $query = "INSERT INTO Authors (FirstName, LastName, NationalityId, DateOfBirth, Gender) 
                  VALUES (:firstname, :lastname, :nationalityid, :dateofbirth, :gender)";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            echo "Database connection error.\n";
            return false;
        }

        try {
            $stmt = $PDO->prepare($query);
            $result = $stmt->execute([
                ':firstname' => $FirstName,
                ':lastname' => $LastName,
                ':nationalityid' => $NationalityId,
                ':dateofbirth' => $DateOfBirth,
                ':gender' => $Gender,
            ]);
            return $result && $stmt->rowCount() > 0;
        } catch (Exception $ex) {
           
            return false;
        }
    }

    public static function GetAuthor(int $AuthorId): ?Author
    {
        $query = "SELECT * FROM Authors WHERE AuthorId = :authorid LIMIT 1";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            echo "Database connection error.\n";
            return null;
        }

        try {
            $stmt = $PDO->prepare($query);
            $stmt->execute([':authorid' => $AuthorId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $author = new Author();
                $author->AuthorId = (int)$row['AuthorId'];
                $author->FirstName = $row['FirstName'];
                $author->LastName = $row['LastName'];
                $author->NationalityId = $row['NationalityId'] !== null ? (int)$row['NationalityId'] : null;
                $author->DateOfBirth = $row['DateOfBirth'];
                $author->Gender = $row['Gender'];
                return $author;
            }
            return null;
        } catch (Exception $ex) {
            return null;
        }
    }

    public static function UpdateAuthor(Author $author): bool
    {
        if ($author->AuthorId === -1 || empty($author->FirstName) || empty($author->LastName) || empty($author->Gender)) {
            echo "Invalid author data.\n";
            return false;
        }

        $query = "UPDATE Authors SET FirstName = :firstname, LastName = :lastname, NationalityId = :nationalityid, DateOfBirth = :dateofbirth, Gender = :gender
                  WHERE AuthorId = :authorid";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            echo "Database connection error.\n";
            return false;
        }

        try {
            $stmt = $PDO->prepare($query);
            $result = $stmt->execute([
                ':firstname' => $author->FirstName,
                ':lastname' => $author->LastName,
                ':nationalityid' => $author->NationalityId,
                ':dateofbirth' => $author->DateOfBirth,
                ':gender' => $author->Gender,
                ':authorid' => $author->AuthorId,
            ]);
            return $result && $stmt->rowCount() > 0;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function DeleteAuthor(int $AuthorId): bool
    {
        $query = "DELETE FROM Authors WHERE AuthorId = :authorid";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            echo "Database connection error.\n";
            return false;
        }

        try {
            $stmt = $PDO->prepare($query);
            $result = $stmt->execute([':authorid' => $AuthorId]);
            return $result && $stmt->rowCount() > 0;
        } catch (Exception $ex) {
           
            return false;
        }
    }


public static function GetAllAuthors(): ?array
{
    $query = "SELECT * FROM Authors";
    $PDO = ClsDataBase::GetConnection();
    if ($PDO == null || $PDO instanceof PDOException) {
        echo "Database connection error.\n";
        return null;
    }

    try {
        $stmt = $PDO->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$rows) return null;

        return $rows;
       }
        
    
    catch (Exception $ex) {
        echo "Error: " . $ex->getMessage() . "\n";
        return null;
          }
        }
    
}

?>