<?php
require_once __DIR__ . "/php/validation/Registration.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, 
    initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&amp;display=swap" />
  <link rel="stylesheet" href="./css/register.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <div>

    <body>
      <div>
        <form method="post" action="">
          <div class="wrapper row row-cols-1 row-cols-lg-4 row-cols-md-3 g-2 g-lg-4">
            <div class="col d-flex justify-content-center">
              <div class="p-3">
                <div class="register-box">
                  <div class="register-header">
                    <span> Register</span>
                  </div>
                  <div class="input-box">
                    <input type="text" id="name" class="input-field" for="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    <?php echo $errors['name']; ?>
                    <label for="name" class="label">Name</label>
                    <i class="bx bx-user icon"></i>
                  </div>
                  <div class="input-box">
                    <input type="email" id="email" class="input-field " for="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    <?php echo $errors['email']; ?>
                    <label for="email" class="label">Email</label>
                    <i class="bx bx-user icon"></i>
                  </div>
                  <div class="input-box">
                    <input type="text" id="surname" class="input-field" autocomplete="off" for="surname" name="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>">
                    <?php echo $errors['surname']; ?>
                    <label for="surname" class="label">Surname</label>
                    <i class="bx bx-user icon" id="surname"></i>
                  </div>
                  <div class="input-box">
                    <input type="password" id="password" class="input-field" for="password" name="password" /><?= $errors['password'] ? $errors['password'] : ''; ?>
                    <label for="password" class="label">Password</label>
                    <i class="bx bx-lock-alt icon" id="show-password"></i>
                  </div>
                  <div class="input-box">
                    <input type="submit" class="input-submit" value="Register" />
                  </div>
                  <div class="register">
                    <span>You have an account? <a href="./LoginIndex.php">Log in</a></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>