<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/regstyle.css">
  <title>Registration</title>
</head>
<body>
  <h1>Registration</h1>
  <form action="process_registration.php" method="post" enctype="multipart/form-data">
    <label for="firstname">First name<span class="required">*</span></label>
    <input type="text" id="firstname" name="firstname" required><br>
    <label for="surname">Last name<span class="required">*</span></label>
    <input type="text" id="surname" name="surname" required><br>
    <label for="email">Email<span class="required">*</span></label>
    <input type="email" id="email" name="email" required><br>
    <label for="student_id">Student ID<span class="required">*</span></label>
    <input type="text" id="student_id" name="student_id" required><br>
    <label for="phone">Phone<span class="required">*</span></label>
    <input type="text" id="phone" name="phone" pattern="[0-9]{10}" required><br>
    <small class="phone_hint">Phone number must be 10 digits long.</small><br>
    <label for="dob">Date of Birth<span class="required">*</span></label>
    <input type="text" id="dob" name="dob" pattern="\d{2}-\d{2}-\d{4}" required><br>
    <small class="dob_hint">Date of birth must be in the format DD-MM-YYYY.</small><br>
    <label for="medical_conditions">Medical Conditions<span class="required">*</span></label>
    <textarea id="medical_conditions" name="medical_conditions" required></textarea><br>
    <label for="doctor_info">Doctor Information<span class="required">*</span></label>
    <textarea id="doctor_info" name="doctor_info" required></textarea><br>
    <label for="next_of_kin">Next of Kin Contact<span class="required">*</span></label>
    <textarea id="next_of_kin" name="next_of_kin" required></textarea><br>
    <label for="profile_img"></label>
    <input type="file" id="profile_img" name="profile_img" required><br>
    <label for="username">Username<span class="required">*</span></label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password<span class="required">*</span></label>
    <input type="password" id="password" name="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" required><br>
    <small class="password_hint">Password must be at least 8 characters long, contain at least one number, one lowercase and one uppercase letter.</small><br>
    <label for="confirm_password">Confirm password<span class="required">*</span></label>
    <input type="password" id="confirm_password" name="confirm_password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" required><br>
    <br>
    <label class="checkbox_label">
      <span class="required">*</span><input type="checkbox" name="medical" required> I declare that I have declosed all my medical conditions and that I am fit to participate in the activities of the clubs.<br>
      <span class="required">*</span><input type="checkbox" name="terms" required> I have read and accept the <a href="tc.php">Terms and Conditions</a> and acknowledge the <a href="pp.php">Privacy Policy</a>.
    </label>
    <br>
    <input type="submit" name="create-acc" value="Sign up">
  </form>
  <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>