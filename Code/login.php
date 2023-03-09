<?php
$host = 'localhost';
$dbuser = 'Project';
$dbpass = '';
$conn = new mysqli($host, $dbuser, $dbpass);

$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';

if ($conn->connect_error) 
{
  die('Connection failed: ' . $conn->connect_error);
}

$sql = 'CREATE DATABASE IF NOT EXISTS threemodpro;';
if (!$conn->query($sql) === TRUE) 
{
  die('Error creating database: ' . $conn->error);
}

$sql = 'USE threemodpro;';
if (!$conn->query($sql) === TRUE) 
{
  die('Error using database: ' . $conn->error);
}

$sql = 'CREATE TABLE IF NOT EXISTS users (
id int NOT NULL AUTO_INCREMENT,
firstname varchar(256) NOT NULL,
surname varchar(256) NOT NULL,
email varchar(256) NOT NULL,
student_id varchar(256) NOT NULL,
phone varchar(256) NOT NULL,
dob varchar(256) NOT NULL,
medical_conditions varchar(256) NOT NULL,
doctor_info varchar(256) NOT NULL,
next_of_kin varchar(256) NOT NULL,
photo LONGTEXT NOT NULL,
username varchar(256) NOT NULL,
pwd varchar(256) NOT NULL,
iv varchar(256) NOT NULL,

PRIMARY KEY (id));';
if (!$conn->query($sql) === TRUE) 
{
  die('Error creating table: ' . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/loginstyle.css">
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <form action="process_login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" id="login" name="login" value="Login">
  </form>
  <p>Don't have an account? <a href="registration.php">Sign up here</a>.</p>
</body>
</html>









