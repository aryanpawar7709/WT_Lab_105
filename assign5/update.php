<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background:rgb(212, 107, 103);
            padding: 20px;
            box-shadow: 0px 0px 10px gray;
            border-radius: 8px;
        }
        .form-box {
            border: 2px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            background-color: #rgb(212, 107, 103);
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        td, th {
            padding: 10px;
            border: 1px solid #ccc;
        }
        input[type="text"], input[type="email"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"], button {
            background-color: #6A7BA2;
            color: white;
            border: none;
            padding: 10px 15px;
            margin: 10px 5px;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #rgb(212, 107, 103);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employee Management System</h1>
        <div class="form-box">
            <form method="post">
                <table>
                    <tr><td>Employee ID: <input type="text" name="empid" required></td></tr>
                    <tr><td>Name: <input type="text" name="empname" required></td></tr>
                    <tr><td>Email: <input type="email" name="empemail" required></td></tr>
                    <tr><td>Mobile: <input type="text" name="empmobile" required></td></tr>
                    <tr><td>Department: <input type="text" name="empdepartment" required></td></tr>
                    <tr><td>Salary: <input type="number" name="salary" step="0.01" required></td></tr>
                </table>
                <input type="submit" name="add" value="Add">
                <button onclick="window.location.href='display.php';" type="button">Display</button>
            </form>
        </div>
        
        <?php
        $conn = new mysqli("localhost", "root", "", "wt");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['add'])) {
                $empid = htmlspecialchars($_POST['empid']);
                $empname = htmlspecialchars($_POST['empname']);
                $empemail = htmlspecialchars($_POST['empemail']);
                $empmobile = htmlspecialchars($_POST['empmobile']);
                $empdepartment = htmlspecialchars($_POST['empdepartment']);
                $salary = htmlspecialchars($_POST['salary']);
                
                $stmt = $conn->prepare("INSERT INTO employees (empid, empname, empemail, empmobile, empdepartment, salary) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssd", $empid, $empname, $empemail, $empmobile, $empdepartment, $salary);
                
                if ($stmt->execute()) {
                    echo "<p>Record added successfully!</p>";
                } else {
                    echo "<p>Error: " . $stmt->error . "</p>";
                }
                $stmt->close();
            }
        }
        
        $conn->close();
        ?>
    </div>
</body>
</html>
