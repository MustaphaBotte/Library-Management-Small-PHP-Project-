<?php
require_once __DIR__."/../ConfigurationDb/database.php";

class BookCopy
{
    public int $CopyID = -1;
    public int $BookID=-1;
    public string $Status = 'available'; 
}

class ManageBookCopies
{
    private static function GetAttribute(int $CopyID = -1): array
    {
        if ($CopyID !== -1) {
            return ["Field" => "CopyID", "Value" => $CopyID];
        }
        return [];
    }

    public static function AddCopy(int $BookID, string $Status): bool
    {
        if (empty($BookID) || !in_array(strtolower($Status), ['available', 'rented'])) {
            return false;
        }

        $Query = "INSERT INTO Bookscopies (BookID, Status) VALUES (:bookId, :status)";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return false;
        }

        try {
            $stmt = $PDO->prepare($Query);
            $Result = $stmt->execute([
                ':bookId' => $BookID,
                ':status' => strtolower($Status)
            ]);
            return $Result && $stmt->rowCount() > 0;
        } catch (Exception $Ex) {
            return false;
        }
    }

    public static function GetCopy(int $CopyID = -1): ?BookCopy
    {
        $Attr = self::GetAttribute($CopyID);
        if ($Attr === []) {
            return null;
        }

        $Query = "SELECT * FROM Bookscopies WHERE " . $Attr['Field'] . " = :value LIMIT 1";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return null;
        }

        try {
            $stmt = $PDO->prepare($Query);
            $stmt->execute([":value" => $Attr['Value']]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $copy = new BookCopy();
                $copy->CopyID = $row['CopyID'];
                $copy->BookID = $row['BookID'];
                $copy->Status = $row['Status'];
                return $copy;
            }
        } catch (Exception $Ex) {
            return null;
        }

        return null;
    }

    public static function GetAllCopies(): ?array
    {
        $Query = "SELECT * FROM Bookscopies";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return null;
        }

        try {
            $stmt = $PDO->query($Query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return count($rows) > 0 ? $rows : null;
        } catch (Exception $Ex) {
            return null;
        }
    }

    public static function DeleteCopy(int $CopyID): bool
    {
        $Attr = self::GetAttribute($CopyID);
        if ($Attr === []) {
            return false;
        }

        $Query = "DELETE FROM Bookscopies WHERE " . $Attr['Field'] . " = :value";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return false;
        }

        try {
            $stmt = $PDO->prepare($Query);
            $stmt->execute([":value" => $Attr['Value']]);
            return $stmt->rowCount() > 0;
        } catch (Exception $Ex) {
            
            return false;
        }
    }

    public static function UpdateCopy(BookCopy $copy): bool
    {
        if (empty($copy->BookID) || !in_array(strtolower($copy->Status), ['available', 'rented'])) {
            return false;
        }

        $Query = "UPDATE Bookscopies SET BookID = :bookId, Status = :status WHERE CopyID = :copyId";
        $PDO = ClsDataBase::GetConnection();
        if ($PDO == null || $PDO instanceof PDOException) {
            return false;
        }

        try {
            $stmt = $PDO->prepare($Query);
            $Result = $stmt->execute([
                ':bookId' => $copy->BookID,
                ':status' => strtolower($copy->Status),
                ':copyId' => $copy->CopyID
            ]);
            if($Result)
            {
              return $stmt->rowCount() > 0;
            }
        } catch (Exception $Ex) {
            return false;
        }
        return false;
    }
}

?>