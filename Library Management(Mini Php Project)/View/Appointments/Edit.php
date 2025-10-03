<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        
        .appointment-form {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input[type="number"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        textarea {
            height: 100px;
        }
        
        .buttons {
            margin-top: 20px;
            text-align: center;
        }
        
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }
        
        .btn-secondary {
            background-color: #f44336;
            color: white;
        }
        
        .error-message {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="appointment-form">
        <h1>Edit Appointment</h1>
        
        <?php if (isset($_GET['error']) && $_GET['error'] == 'add_failed'): ?>
            <div class="error-message">
                Failed to add appointment. Please try again.
            </div>
        <?php endif; ?>
        <?php                 
         
          $appointmentId =trim($_GET['id']) ?? '';
          $description = trim($_GET['desc']) ?? '';
          $date = trim($_GET['date']) ?? '';
          $time = trim($_GET['time']) ?? '';
          $userId = trim($_GET['userid']) ?? '';
         if(empty($userId))
         {
           die("wrong id dont play in the url");
         }
  
        ?>
        
        <form action="..\..\index.php?action=editappointment" method="POST">
            <input style="display:none" type="text" name="userid" value= <?php echo $userId ?>>    
            <input style="display:none" type="text" name="AppointmentId" value= <?php echo $appointmentId ?>>    

            <div class="form-group">
                <label for="AppointmentDate">Date:</label>
                <input type="date" id="AppointmentDate" name="AppointmentDate" required 
                value=<?php echo htmlspecialchars($date) ?> >
            </div>
            
            <div class="form-group">
                <label for="AppointmentTime">Time:</label>
                <input type="time" id="AppointmentTime" name="AppointmentTime" required
                value=<?php echo $time ?>>
            </div>
            
            <div class="form-group">
                <label for="Description">Description (Optional):</label>
                <textarea id="Description" name="Description"
                ><?php echo $description?></textarea>
            </div>
        
            <div class="buttons">
                <button type="submit" class="btn btn-primary">Edit Appointment</button>
                <a href="index.php?action=appointments" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>