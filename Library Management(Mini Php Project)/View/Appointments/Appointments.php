
<style>
    /* Base Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.header {
    background-color: #2c3e50;
    color: white;
    padding: 15px 0;
    margin-bottom: 30px;
}

.header h1 {
    margin: 0;
    padding: 0;
}

/* Navigation */
.navbar {
    background-color: #34495e;
    padding: 10px 0;
}

.navbar ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}

.navbar li {
    margin-right: 15px;
}

.navbar a {
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 3px;
    transition: background-color 0.3s;
}

.navbar a:hover {
    background-color: #2c3e50;
}

/* Tables */
.appointment-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.appointment-table th,
.appointment-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.appointment-table th {
    background-color: #3498db;
    color: white;
}

.appointment-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.appointment-table tr:hover {
    background-color: #e3f2fd;
}

/* Buttons */
.btn {
    display: inline-block;
    padding: 8px 15px;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #2980b9;
}

.btn-danger {
    background-color: #e74c3c;
}

.btn-danger:hover {
    background-color: #c0392b;
}

.btn-success {
    background-color: #2ecc71;
}

.btn-success:hover {
    background-color: #27ae60;
}

/* Forms */
.form-container {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 20px auto;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

/* Messages */
.alert {
    padding: 10px 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Responsive */
@media (max-width: 768px) {
    .appointment-table {
        display: block;
        overflow-x: auto;
    }
    
    .navbar ul {
        flex-direction: column;
    }
    
    .navbar li {
        margin-bottom: 5px;
    }
}
</style>





<div class="container">
    <h2>Appointment Management</h2>
    
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">
            <?php 
                switch ($_GET['msg']) {
                    case 'added': echo "Appointment added successfully!"; break;
                    case 'updated': echo "Appointment updated successfully!"; break;
                    case 'deleted': echo "Appointment deleted successfully!"; break;
                }
            ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?php 
                switch ($_GET['error']) {
                    case 'add_failed': echo "Failed to add appointment!"; break;
                    case 'update_failed': echo "Failed to update appointment!"; break;
                    case 'delete_failed': echo "Failed to delete appointment!"; break;
                    case 'notfound': echo "Appointment not found!"; break;
                    case 'no_id': echo "No appointment ID provided!"; break;
                }
            ?>
        </div>
    <?php endif; ?>
    
    <a href="View/Appointments/Add.html" class="btn btn-success">Add New Appointment</a>
    
    <table class="appointment-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!isset($appointments)){exit();}?>
            <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?= htmlspecialchars($appointment['AppointmentId']) ?></td>
                <td><?= htmlspecialchars($appointment['UserId']) ?></td>
                <td><?= htmlspecialchars($appointment['AppointmentDate']) ?></td>
                <td><?= htmlspecialchars($appointment['AppointmentTime']) ?></td>
                <td><?= htmlspecialchars($appointment['Description'] ?? 'N/A') ?></td>
                <td>
                    <a href="View/Appointments/Edit.php?action=editappointment&id=<?= $appointment['AppointmentId'] ?>
                    &desc=<?= urlencode($appointment['Description']) ?>
                    &date=<?= $appointment['AppointmentDate'] ?>
                    &time=<?= $appointment['AppointmentTime'] ?>  
                    &userid=<?=$appointment['UserId'] ?>" 
                    class="btn">
                    Edit</a>

                    <a href="index.php?action=deleteappointment&id=<?= $appointment['AppointmentId'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

