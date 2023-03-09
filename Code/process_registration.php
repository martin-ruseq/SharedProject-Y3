<?php

//Encryption algorithm and key
$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';

// Connect to database
$host = 'localhost';
$user = 'Project';
$pass = '';
$dbname = 'threemodpro';
$conn = new mysqli($host, $user, $pass, $dbname);

// Retrieve form data
$firstname = $conn -> real_escape_string($_POST['firstname']);
$surname = $conn -> real_escape_string($_POST['surname']);
$email = $conn -> real_escape_string($_POST['email']);
$student_id = $conn -> real_escape_string($_POST['student_id']);
$password = $_POST['password'];
$confirm_password =  $conn -> real_escape_string($_POST['confirm_password']);
$phone =  $conn -> real_escape_string($_POST['phone']);
$dateofbirth =  $conn -> real_escape_string($_POST['dob']);
$medical_conditions =  $conn -> real_escape_string($_POST['medical_conditions']);
$doctor_info =  $conn -> real_escape_string($_POST['doctor_info']);
$next_of_kin =  $conn -> real_escape_string($_POST['next_of_kin']);
$username =  $conn -> real_escape_string($_POST['username']);

if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['create-acc']))
{
  $iv = random_bytes(16);
  
  // Encrypt the data
  $encrypted_firstname = openssl_encrypt($firstname, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_surname = openssl_encrypt($surname, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_email = openssl_encrypt($email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_student_id = openssl_encrypt($student_id, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $encrypted_phone = openssl_encrypt($phone, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_dateofbirth = openssl_encrypt($dateofbirth, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_medical_conditions = openssl_encrypt($medical_conditions, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_doctor_info = openssl_encrypt($doctor_info, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_next_of_kin = openssl_encrypt($next_of_kin, $cipher, $key, OPENSSL_RAW_DATA, $iv);

  // Convert to hex
  $firstname_hex = bin2hex($encrypted_firstname);
  $surname_hex = bin2hex($encrypted_surname);
  $email_hex = bin2hex($encrypted_email);
  $student_id_hex = bin2hex($encrypted_student_id);
  $password_hex = bin2hex($hashed_password);
  $phone_hex = bin2hex($encrypted_phone);
  $dateofbirth_hex = bin2hex($encrypted_dateofbirth);
  $medical_conditions_hex = bin2hex($encrypted_medical_conditions);
  $doctor_info_hex = bin2hex($encrypted_doctor_info);
  $next_of_kin_hex = bin2hex($encrypted_next_of_kin);

  // Get file
  $upload = "uploads/";
  $uploadfile = $upload . basename($_FILES['profile_img']['name']);
  $profile_img_type = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  $picture = file_get_contents($_FILES['profile_img']['tmp_name']);

  $encrypted_img = openssl_encrypt($picture, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $img_hex = bin2hex($encrypted_img);
  $iv_hex = bin2hex($iv);

  // Insert user data into database
  $sql = "INSERT INTO users (firstname, surname, email, student_id, phone, dob, medical_conditions, doctor_info, next_of_kin, username, pwd, iv, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  if (!$stmt) 
  {
    echo "failed to prepare the sql";
    exit;
  }

  $stmt->bind_param("sssssssssssss", $firstname_hex, $surname_hex, $email_hex, $student_id_hex, $phone_hex, $dateofbirth_hex, $medical_conditions_hex, $doctor_info_hex, $next_of_kin_hex, $username, $password_hex, $iv_hex, $img_hex);

  // Bind the parameters and execute the statement
  if ($stmt->execute())

  // Close database connection
  $conn->close();
}

// Redirect user to login page
header("Location: login.php");

exit;
?>
