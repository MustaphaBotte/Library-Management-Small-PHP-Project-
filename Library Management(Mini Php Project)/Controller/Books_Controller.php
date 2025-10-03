<?php
require_once __DIR__ . '/../Model/Books_Model.php';


class Book_Controller
{
    public static function Handler(): void
    {
        $Action = $_GET['action'] ?? 'books';

        switch ($Action) {
            case 'books':
                self::GetAllBooks();
                break;

            case 'addbook':
                self::AddBook();
                break;

            case 'deletebook':
                self::DeleteBook();
                break;

            case 'edit':
                self::GetBook();
                break;

            case 'editbook':
                self::UpdateBook();
                break;

            default:
                echo "Unknown action.";
        }
    }

    public static function GetAllBooks(): void
    {
        if (!isset($_SESSION['admin'])) {
            header("location: ../View/Login.php");
            exit();
        }

        $books = ManageBook::GetAllBooks();
        include "View/Books.php"; 
    }

    public static function GetBook(): void
    {
        if (!isset($_SESSION['admin'])) {
            header("location: ../View/Login.php");
            exit();
        }

        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $book = ManageBook::GetBook($id);
     
                include "../View/BookList.php"; 
            
        } else {
            header("location: index.php?action=books&error=no_id");
        }
    }

    public static function AddBook(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $result = ManageBook::AddBook(
                trim($_POST['BookName']),
                trim($_POST['Isbn']),
                $_POST['BookDescription'] ?? '',
                $_POST['NumberOfPages'] ?? null,
                $_POST['PublishedAt'] ?? null,
                $_POST['BookLanguage'] ?? null,
                $_POST['AuthorID'] ?? null,
                $_POST['CategoryID'] ?? null
            );

            if ($result) {
                header("location: index.php?action=books");
            } else {
                header("location: ../View/AddBook.php?error=add_failed");
            }
        }
    }

    public static function DeleteBook(): void
    {
        if (!isset($_SESSION['admin'])) {
            header("location: ../View/Login.php");
            exit();
        }

        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $deleted = ManageBook::DeleteBook($id);
            
            if ($deleted) {
                header("location: index.php?action=books");
            } else {
                header("location: index.php?action=books");
            }
        } else {
            header("location: index.php?action=books");
        }
    }

    public static function UpdateBook(): void
    {
        
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['BookId'])) {
           
            $book = new Book();
            $book->BookId = (int)$_POST['BookId'];
            $book->BookName = trim($_POST['BookName']);
            $book->Isbn = trim($_POST['Isbn']);
            $book->BookDescription = $_POST['BookDescription'] ?? null;
            $book->NumberOfPages = $_POST['NumberOfPages'] ?? null;
            $book->PublishedAt = $_POST['PublishedAt'] ?? null;
            $book->BookLanguage = $_POST['BookLanguage'] ?? null;
            $book->AuthorID = $_POST['AuthorID'] ?? null;
            $book->CategoryId = $_POST['CategoryID'] ?? null;

            $updated = ManageBook::UpdateBook($book);

            if ($updated) {
                
                header("location: View/Books.php?action=books&msg=updated");
            } else {
               header("location: View/Books.php?id={$book->BookId}&error=update_failed");
            }
        }
    }
}
