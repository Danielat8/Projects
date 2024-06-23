<?php
require_once __DIR__ . "/php/validation/Login.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, 
    initial-scale=1.0" />
  <title>Log in</title>
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&amp;display=swap" />
  <link rel="stylesheet" href="./css/login.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="wrapper row row-cols-1 row-cols-lg-6 row-cols-md-3 g-2 g-lg-4">
        <div class="col d-flex justify-content-center">
          <div class="p-3">
            <div class="login-box">
              <div class="login-header">
                <span>Login</span>
              </div>
              <div class="input-box">
                <input type="text" id="email" class="input-field" for="email" name="email" />
                <?= $errors['email'] ? $errors['email'] : ''; ?>
                <label for="email" class="label">Email</label>
                <i class="bx bx-user icon"></i>
              </div>
              <div class="input-box">
                <input type="password" id="password" class="input-field" for="password" name="password" />
                <?= $errors['password'] ? $errors['password'] : ''; ?>
                <label for="password" class="label">Password</label>
              </div>
              <div class="input-box">
                <input type="submit" class="input-submit" value="Login" />
              </div>
              <div class="register">
                <span>Don't have an account? <a href="./RegistrationIndex.php">Register</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>