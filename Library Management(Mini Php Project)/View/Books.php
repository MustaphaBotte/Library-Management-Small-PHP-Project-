<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #eef2ff;
            --secondary: #3f37c9;
            --dark: #1e1e24;
            --light: #f8f9fa;
            --gray: #6c757d;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #f72585;
            --border-radius: 8px;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: var(--dark);
            line-height: 1.5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title h1 {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #d11a6f;
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Table Styles */
        .book-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: var(--shadow);
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #f9fafb;
            font-weight: 600;
            color: var(--gray);
        }

        tr:hover {
            background: #f5f7fb;
        }

        .action-btns {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            color: white;
        }

        .edit-btn {
            background: var(--primary);
        }

        .edit-btn:hover {
            background: var(--secondary);
        }

        .delete-btn {
            background: var(--danger);
        }

        .delete-btn:hover {
            background: #d11a6f;
        }

        /* Form Styles */
        .book-form {
            background: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
            display: none;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: var(--border-radius);
            font-family: inherit;
        }

        .full-width {
            grid-column: span 2;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .full-width {
                grid-column: span 1;
            }
            
            .action-btns {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require_once __DIR__ . '/../Model/Books_Model.php';
       

        $books = [];
        $formData = [
            'BookId' => '',
            'BookName' => '',
            'Isbn' => '',
            'BookDescription' => '',
            'NumberOfPages' => '',
            'PublishedAt' => '',
            'BookLanguage' => '',
            'AuthorID' => '',
            'CategoryID' => ''
        ];
        $isEditing = false;
        $alertMessage = '';
        $alertType = '';

        // Handle actions
        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            switch ($action) {
                case 'addbook':
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
                            $alertMessage = 'Book added successfully!';
                            $alertType = 'success';
                        } else {
                            $alertMessage = 'Failed to add book';
                            $alertType = 'error';
                        }
                    } else {
                        $isEditing = false;
                        echo "<script>document.addEventListener('DOMContentLoaded', function() { showForm(); });</script>";
                    }
                    break;

                case 'edit':
                    if (isset($_GET['id'])) {
                        $id = (int)$_GET['id'];
                        $book = ManageBook::GetBook($id);
                        if ($book) {
                            $formData = [
                                'BookId' => $book->BookId,
                                'BookName' => $book->BookName,
                                'Isbn' => $book->Isbn,
                                'BookDescription' => $book->BookDescription ?? '',
                                'NumberOfPages' => $book->NumberOfPages ?? '',
                                'PublishedAt' => $book->PublishedAt ?? '' ,
                                'BookLanguage' => $book->BookLanguage ?? '',
                                'AuthorID' => $book->AuthorID ?? '',
                                'CategoryID' => $book->CategoryId ?? ''
                            ];
                            $isEditing = true;
                            echo "<script>document.addEventListener('DOMContentLoaded', function() { showForm(); });</script>";
                        }
                    }
                    break;

                case 'update':
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
                            $alertMessage = 'Book updated successfully!';
                            $alertType = 'success';
                        } else {
                            $alertMessage = 'Failed to update book';
                            $alertType = 'error';
                        }
                    }
                    break;

                case 'delete':
                    if (isset($_GET['id'])) {
                        $id = (int)$_GET['id'];
                        $deleted = ManageBook::DeleteBook($id);
                        if ($deleted) {
                            $alertMessage = 'Book deleted successfully!';
                            $alertType = 'success';
                        } else {
                            $alertMessage = 'Failed to delete book';
                            $alertType = 'error';
                        }
                    }
                    break;
            }
        }

       
        $books = ManageBook::GetAllBooks();
        ?>

        <!-- Alert Messages -->
        <?php if ($alertMessage): ?>
            <div class="alert alert-<?= $alertType ?>"><?= $alertMessage ?></div>
        <?php endif; ?>

        <div class="header">
            <div class="page-title">
                <h1>Book Management System</h1>
            </div>
            <button class="btn btn-primary" id="addBookBtn">
                <i class="fas fa-plus"></i> Add Book
            </button>
        </div>

        <!-- Book List Table -->
        <table class="book-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Pages</th>
                    <th>Language</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['BookId']) ?></td>
                    <td><?= htmlspecialchars($book['BookName']) ?></td>
                    <td><?= htmlspecialchars($book['Isbn']) ?></td>
                    <td><?= htmlspecialchars($book['NumberOfPages'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($book['BookLanguage'] ?? 'N/A') ?></td>
                    <td>
                        <div class="action-btns">
                            <a href="?action=editbook&id=<?= $book['BookId'] ?>" class="action-btn edit-btn">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?action=deletebook&id=<?= $book['BookId'] ?>" class="action-btn delete-btn" 
                               >
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Book Form (Hidden by default) -->
        <div class="book-form" id="bookForm">
            <h2><?= $isEditing ? 'Edit Book' : 'Add New Book' ?></h2>
            <form method="post" action="..\index.php?action=addbook"?>">
                <?php if ($isEditing): ?>
                    <input type="hidden" name="BookId" value="<?= $formData['BookId'] ?>">
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="BookName">Book Title *</label>
                        <input type="text" id="BookName" name="BookName" required 
                               value="<?= htmlspecialchars($formData['BookName']) ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="Isbn">ISBN *</label>
                        <input type="text" id="Isbn" name="Isbn" required 
                               value="<?= htmlspecialchars($formData['Isbn']) ?>">
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="BookDescription">Description</label>
                        <textarea id="BookDescription" name="BookDescription" rows="4"><?= htmlspecialchars($formData['BookDescription']) ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="NumberOfPages">Number of Pages</label>
                        <input type="number" id="NumberOfPages" name="NumberOfPages" 
                               value="<?= htmlspecialchars($formData['NumberOfPages']) ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="PublishedAt">Publication Date</label>
                        <input type="date" id="PublishedAt" name="PublishedAt" 
                               value="<?= htmlspecialchars($formData['PublishedAt']) ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="BookLanguage">Language</label>
                        <input type="text" id="BookLanguage" name="BookLanguage" 
                               value="<?= htmlspecialchars($formData['BookLanguage']) ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="AuthorID">Author ID</label>
                        <input type="number" id="AuthorID" name="AuthorID" 
                               value="<?= htmlspecialchars($formData['AuthorID']) ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="CategoryID">Category ID</label>
                        <input type="number" id="CategoryID" name="CategoryID" 
                               value="<?= htmlspecialchars($formData['CategoryID']) ?>">
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <?= $isEditing ? 'Update Book' : 'Add Book' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Form display control
        function showForm() {
            document.getElementById('bookForm').style.display = 'block';
            window.scrollTo({ top: document.getElementById('bookForm').offsetTop, behavior: 'smooth' });
        }

        function hideForm() {
            document.getElementById('bookForm').style.display = 'none';
            window.location.href = '?action=books';
        }

        // Event listeners
        document.getElementById('addBookBtn').addEventListener('click', showForm);
        document.getElementById('cancelBtn').addEventListener('click', hideForm);

        // Show form if there are validation errors
        <?php if (isset($_GET['error'])): ?>
            document.addEventListener('DOMContentLoaded', function() {
                showForm();
            });
        <?php endif; ?>
    </script>
</body>
</html>