<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit();
}

$server = "localhost";
$username = "root";
$password = "";
$dbname = "project1";
$con = mysqli_connect($server, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['user_email'];

$query = "SELECT name, email, phone FROM test1 WHERE email = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$userData = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<title>User Profile - Impressive Design</title>
<style>
  body {
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(120deg, #2980b9, #8e44ad);
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }

   .profile-card {
    background: rgba(255, 255, 255, 0.08);
    border-radius: 30px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
    border: 3px solid black; /* Added border to the card */
    padding: 40px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
    max-width: 400px;
  }

  .profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('bgi.jpeg') no-repeat center/cover;
    opacity: 0.4;
    z-index: -1;
  }

   .profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 20px;
    border: 5px dotted #fff;
    border-color: black; /* Added border color */
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    animation: pulseBorder 3s infinite alternate;
  }
 
   @keyframes pulseBorder {
            from {
                border-color: dotted black; /* Initial border color */
            }
            to {
                border-color:  yellow; /* New border color */
            }
        }
  .profile-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .profile-name {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 2px;
  }

  .contact-info {
    font-size: 20px;
    margin-top: 20px;
  }
  
  .action-button {
    background-color: #3498db;
    color: white;
    border: 1.5px solid black; /* Added border */
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    margin-top: 20px;
    text-decoration: none;
    display: inline-block;
  }

  .action-button:hover {
    background-color: #2980b9;
  }

.logout-button {
  position: absolute;
  top: 10px;
  right: 10px;
  display: inline-block;
  color: white;
  text-decoration: none;
  font-size: 18px;
  transition: color 0.3s;
}

.logout-button i {
  margin-right: 8px;
}

.logout-button:hover {
  color: #e74c3c;
}

</style>
</head>
<body>
  <div class="profile-card">
    <div class="profile-image">
      <img src="user.jpg" alt="Profile Picture">
    </div>
    <div class="profile-name"><?php echo $userData['name']; ?></div>
    <div class="contact-info">
      <p>Email: <?php echo $userData['email']; ?></p>
      <p>Phone: <?php echo $userData['phone']; ?></p>
    </div>
    <a class="action-button" href="Home.html">Home</a>
    <a class="logout-button" href="logout.php">
  <i class="fas fa-sign-out-alt"></i> 
</a>
  </div>
</body>
</html>
