<?php
session_start();

$host = 'localhost';
$dbuser = 'Project';
$dbpass = '';
$dbname = 'threemodpro';

$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

if ($conn->connect_error)
{
  die('Connection failed: ' . $conn->connect_error);
}

if (isset($_POST['login']))
{
  $username = $_POST['username'];
  $password = $conn -> real_escape_string($_POST['password']);

  $sql = "SELECT * FROM users WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1)
  {
    $row = $result->fetch_assoc();
    $iv = hex2bin($row['iv']);
    $encrypted_password = hex2bin($row['pwd']);
    $decrypted_password = openssl_decrypt($encrypted_password, $cipher, $key, OPENSSL_RAW_DATA, $iv);

    if (password_verify($password, $encrypted_password))
    {
      $_SESSION['username'] = $username;
      header('Location: account.php');
      exit();
    }
    else
    {
      echo '<p>Invalid password.</p>';
    }
  }
  else 
  {
    echo '<p>Invalid username.</p>';
  }
}

$conn->close();
?>
