<?php 
$conn = new mysqli("localhost", "root", "", "wt");  

if ($conn->connect_error) {     
    die("Connection failed: " . $conn->connect_error); 
}  

// Handle delete request 
if (isset($_GET['delete'])) {     
    $id = $_GET['delete'];     
    $conn->query("DELETE FROM employees WHERE empid = $id");     
    header("Location: update.php");     
    exit(); 
}  

// Fetch all records 
$result = $conn->query("SELECT * FROM employees"); 
?>  

<!DOCTYPE html> 
<html lang="en"> 
<head>     
    <meta charset="UTF-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <title>Employee Records</title>     
    <style>         
        body {             
            font-family: Arial, sans-serif;             
            margin: 0;             
            padding: 20px;             
            background-color: #f4f4f4;             
            text-align: center;         
        }         
        .container {             
            max-width: 900px;             
            margin: auto;             
            background:rgb(212, 107, 103);             
            padding: 20px;             
            box-shadow: 0px 0px 10px gray;             
            border-radius: 8px;         
        }         
        table {             
            width: 100%;             
            border-collapse: collapse;             
            margin-top: 20px;             
            background: white;         
        }         
        th, td {             
            padding: 10px;             
            border: 1px solid #ccc;             
            text-align: center;         
        }         
        .action-buttons a {             
            padding: 5px 10px;             
            margin: 5px;             
            text-decoration: none;             
            color: white;             
            border-radius: 4px;             
            display: inline-block;         
        }         
        .update-btn {             
            background-color: #6A7BA2;         
        }         
        .delete-btn {             
            background-color: red;         
        }         
        button {             
            background-color: #6A7BA2;             
            color: white;             
            padding: 10px;             
            border: none;             
            cursor: pointer;             
            border-radius: 4px;             
            margin-top: 15px;         
        }     
    </style> 
</head> 
<body>     
    <div class="container">         
        <h1>Employee Records</h1>         
        <table>             
            <tr>                 
                <th>Employee ID</th>                 
                <th>Name</th>                 
                <th>Email</th>                 
                <th>Mobile</th>                 
                <th>Department</th>                 
                <th>Salary</th>                 
                <th>Action</th>             
            </tr>             
            <?php while ($row = $result->fetch_assoc()): ?>             
            <tr>                 
                <td><?= $row['empid'] ?></td>                 
                <td><?= $row['empname'] ?></td>                 
                <td><?= $row['empemail'] ?></td>                 
                <td><?= $row['empmobile'] ?></td>                 
                <td><?= $row['empdepartment'] ?></td>                 
                <td><?= $row['salary'] ?></td>                 
                <td class="action-buttons">                     
                    <a href="update.php?id=<?= $row['empid'] ?>" class="update-btn">Update</a>                     
                    <a href="update.php?delete=<?= $row['empid'] ?>" class="delete-btn" onclick="return confirm('Are you sure?');">Delete</a>                 
                </td>             
            </tr>             
            <?php endwhile; ?>         
        </table>         
        <a href="update.php"><button>Back</button></a>     
    </div> 
</body> 
</html>  

<?php 
$conn->close(); 
?>
