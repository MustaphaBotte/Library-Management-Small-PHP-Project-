<?php require_once "../Controller/Admin_Controller.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #eef2ff;
            --dark: #1e1e24;
            --light: #f8f9fa;
            --gray: #6c757d;
            --danger: #f72585;
            --border-radius: 8px;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            padding: 20px;
            line-height: 1.5;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        h1 {
            margin-bottom: 10px;
            color: var(--dark);
        }

        .btn {
            padding: 8px 16px;
            border-radius: var(--border-radius);
            border: none;
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: var(--shadow);
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
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

        .action-btn {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        .admin-form {
            background: white;
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-top: 20px;
            display: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-family: inherit;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .active {
            background: #d1fae5;
            color: #065f46;
        }

        .inactive {
            background: #fee2e2;
            color: #b91c1c;
        }

        .suspended {
            background: #fef3c7;
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Management</h1>
        <button class="btn btn-primary" id="addAdminBtn">
            <i class="fas fa-plus"></i> Add Admin
        </button>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $admins = ManageAdmins::GetAllAdmins();
                if ($admins && count($admins) > 0):
                    foreach ($admins as $admin):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($admin['AdminId']); ?></td>
                    <td><?php echo htmlspecialchars($admin['FirstName'] . ' ' . $admin['LastName']); ?></td>
                    <td><?php echo htmlspecialchars($admin['UserName']); ?></td>
                    <td>
                        <span class="status <?php echo strtolower($admin['AdminStatus']); ?>">
                            <?php echo ucfirst($admin['AdminStatus']); ?>
                        </span>
                    </td>
                    <td>      
                     <a href="../index.php?action=delete&id=<?php echo $admin['AdminId']; ?>">             
                        <button class="btn action-btn btn-danger delete-btn" data-id="<?php echo $admin['AdminId']; ?>">
                            <i class="fas fa-trash"></i> Delete
                            
                        </button>
                        </a>
                    </td>
                </tr>
                <?php
                    endforeach;
                else:
                ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No administrators found</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="admin-form" id="adminForm">
            <h2 id="formTitle">Add New Admin</h2>
            <form id="adminDataForm" method="post" action="..\index.php?action=addadmin">
                <input type="hidden" id="adminId" name="adminId" value="">
                
                <div class="form-group">
                    <label for="firstName">First Name *</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                
                <div class="form-group">
                    <label for="lastName">Last Name *</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                
                <div class="form-group">
                    <label for="userName">Username *</label>
                    <input type="text" id="userName" name="userName" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone *</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                
                <div class="form-group">
                    <label for="mail">Email</label>
                    <input type="email" id="mail" name="mail">
                </div>
                
                <div class="form-group">
                    <label for="dateOfBirth">Date of Birth</label>
                    <input type="date" id="dateOfBirth" name="dateOfBirth">
                </div>
                
                <div class="form-group">
                    <label for="gender">Gender *</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="adminStatus">Status *</label>
                    <select id="adminStatus" name="adminStatus" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="3"></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Show form when Add Admin button clicked
        document.getElementById('addAdminBtn').addEventListener('click', function() {
            document.getElementById('adminForm').style.display = 'block';
            document.getElementById('formTitle').textContent = 'Add New Admin';
            document.getElementById('adminDataForm').reset();
            document.getElementById('adminId').value = '';
            document.getElementById('password').required = true;
        });

        // Hide form when Cancel button clicked
        document.getElementById('cancelBtn').addEventListener('click', function() {
            document.getElementById('adminForm').style.display = 'none';
        });
 
    </script>
</body>
</html>