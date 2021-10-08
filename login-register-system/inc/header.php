<?php 

  $file_path = realpath(dirname(__FILE__));
  include_once $file_path.'./../lib/session.php';

  Session::init();
  $pid   = Session::get('id');
  $login  = Session::get('login');
  $username = Session::get('username');



  if (isset($_GET['action']) && $_GET['action'] == 'logout' ) {
    Session::destroy();
  }
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login And Register System</title>
	<link rel="stylesheet" href="src/bootstrap.min.css">
	<link rel="stylesheet" href="src/style.css">
</head>
<body class="d-flex flex-column justify-content-between">
	<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-end mb-2 mb-lg-0 text-white text-decoration-none">
          <h1>Login And Register System</h1><span class="mx-3 mb-2">with PHP, OOP, PDO</span>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-white"></a></li>
        </ul>


        <div class="text-end">
          <?php if ($login == true ): ?>
            <a class="btn btn-sm btn-outline-warning me-2 text-decoration-none text-white" href="index.php">User List</a>
            <a class="btn btn-sm btn-outline-warning me-2 text-decoration-none text-white" href="profile.php?id=<?php echo $pid ?>">Profile</a>
            <a class="btn btn-sm btn-outline-warning me-2 text-decoration-none text-white" href="?action=logout">Logout</a>
          <?php else : ?>
            <a class="btn btn-sm btn-outline-warning me-2 text-decoration-none text-white" href="login.php">Login</a>
            <a class="btn btn-sm btn-warning me-2 text-decoration-none text-black" href="register.php">Sign-up</a>
          <?php endif ?>
        </div>
        <?php if ($login == true ): ?>
        <a href="#" class="btn btn-sm btn-warning text-center d-flex align-items-center">
          <svg class="mx-1" 
          xmlns="http://www.w3.org/2000/svg" 
          width="16" height="16" 
          fill="currentColor" class="bi bi-person-circle" 
          viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>
        <p class="m-0">
          <?php echo isset($username) ? $username : ""; ?>
        </p>
      </a>
      <?php endif ?>

      </div>
    </div>
  </header>