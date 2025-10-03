<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Library Admin Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
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
            --border-radius: 12px;
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
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f5f7fb;
            color: var(--dark);
            line-height: 1.5;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            margin-right: auto;
            margin-left: auto;  
        }

        .page-title h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
        }

        .page-title p {
            color: var(--gray);
            font-size: 0.875rem;
        }

        .logout-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Quick Actions */
        .quick-actions {
            margin-bottom: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;        
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .action-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .action-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
            background: var(--primary-light);
            color: var(--primary);
        }

        .action-card i {
            font-size: 1.75rem;
            margin-bottom: 1.25rem;
            background: var(--primary-light);
            color: var(--primary);
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .action-card:hover i {
            background: var(--primary);
            color: white;
        }

        .action-card h3 {
            font-size: 1rem;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .action-grid {
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .action-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .action-card {
                padding: 1.5rem 1rem;
            }
            
            .action-card i {
                width: 48px;
                height: 48px;
                font-size: 1.5rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>
    <div class="header">
        <div class="page-title">
            <h1>Library Admin Portal</h1>
            <p>Quick access to management tools</p>
        </div>
        <a href="../Controller/LogOut.php">
        <button class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </button>
        </a>
    </div>
    
    <div class="quick-actions">
        <div class="section-header">
            <h2 class="section-title">Quick Actions</h2>
            <a href="#" class="view-all">View All</a>
        </div>
        
        <div class="action-grid">
            <a href="../index.php?action=books" class="action-card">
                <i class="fas fa-book"></i>
                <h3>Manage Books</h3>
            </a>

            <a href="../index.php?action=admins" class="action-card">
                <i class="fas fa-book"></i>
                <h3>Manage Admins</h3>
            </a>

            <a href="Users.html" class="action-card">
                <i class="fas fa-user-plus"></i>
                <h3>Manage Users</h3>
            </a>
            
            <a href="../index.php?action=appointments" class="action-card">
                <i class="fas fa-calendar-plus"></i>
                <h3>Manage Appointments</h3>
            </a>
            
            <a href="BooksCopies.html" class="action-card">
                <i class="fas fa-copy"></i>
                <h3>Manage Copies</h3>
            </a>
            
            <a href="Authors.html" class="action-card">
                <i class="fas fa-pen-fancy"></i>
                <h3>Manage Authors</h3>
            </a>
            
            <a href="Categories.html" class="action-card">
                <i class="fas fa-tag"></i>
                <h3>Manage Categories</h3>
            </a>
            
           
        </div>
    </div>

    <script>
        
    </script>
</body>
</html>