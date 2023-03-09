<?php
session_start();

if (!isset($_SESSION['username'])) 
{
  header('Location: login.php');
  exit();
}

// Database connection
$host = 'localhost';
$dbuser = 'Project';
$dbpass = '';
$dbname = 'ThreeModPro';

// Encryption algorithm and key
$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// Retrieve the user's data from the database
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Retrieve the user's IV from the database
$iv = hex2bin($row['iv']);

// Convert hex to binary
$encrypted_firstname = hex2bin($row['firstname']);
$encrypted_surname = hex2bin($row['surname']);
$encrypted_dob = hex2bin($row['dob']);
$encrypted_email = hex2bin($row['email']);
$encrypted_phone = hex2bin($row['phone']);
$encrypted_medical_conditions = hex2bin($row['medical_conditions']);
$encrypted_doctor_info = hex2bin($row['doctor_info']);
$encrypted_next_of_kin = hex2bin($row['next_of_kin']);
$encrypted_photo = hex2bin($row['photo']);

// Decrypt users data
$firstname = openssl_decrypt($encrypted_firstname, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$surname = openssl_decrypt($encrypted_surname, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$dob = openssl_decrypt($encrypted_dob, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$email = openssl_decrypt($encrypted_email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$phone = openssl_decrypt($encrypted_phone, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$medical_conditions = openssl_decrypt($encrypted_medical_conditions, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$doctor_info = openssl_decrypt($encrypted_doctor_info, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$next_of_kin = openssl_decrypt($encrypted_next_of_kin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$photo = openssl_decrypt($encrypted_photo, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$profile_img = base64_encode($photo);
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/accountstyle.css">
  <title>Account</title>
</head>
<body>
  <div class="container">
    <ul>
      <form action="account.php" method="post" enctype="multipart/form-data">
        <li><img src="data:image/jpg;charset=utf8;base64,<?php echo $profile_img?>"></li>
        <br>
        <li><b>First Name: </b><?php echo $firstname; ?></li>
        <li><b>Surname: </b><?php echo $surname; ?></li>
        <li><b>Date of Birth: </b><?php echo $dob; ?></li>
        <li><b>Username: </b><?php echo $row['username']; ?></li>
        <li><b>Email: </b><?php echo $email; ?></li>
        <li><b>Phone: </b><?php echo $phone; ?></li>
        <li><b>Medical Conditions: </b><?php echo $medical_conditions; ?></li>
        <li><b>Doctor Info: </b><?php echo $doctor_info; ?></li>
        <li><b>Next of Kin: </b><?php echo $next_of_kin; ?></li>
        <br>
      </form>
    </ul>
    <ul>
      <br>
      <form action="logout.php" method="post">
        <li><input id='logout' type="submit" name="logout" value="Logout"></li>
      </form>
    </ul>
  </div>
</body>
</html>

<?php
$conn->close();
?>
