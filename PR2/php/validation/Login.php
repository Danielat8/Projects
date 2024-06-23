 <?php
    require_once __DIR__ . "/../Autoload.php";
    require_once __DIR__ . "/../classes/User.php";


    $errors = ['password' =>  false, 'email' => false];
    $validated = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validate input
        if (empty($_POST['email'])) {
            $errors['email'] = "<p style='color:red;'>Email is required.</p>";
            $validated = false;
        } elseif (strpos($_POST['email'], ' ') !== false) {
            $errors['email'] = "<p style='color:red;'>Email cannot contain empty spaces.</p>";
            $validated = false;
        } elseif (strpos($email, '@') === false) {
            $errors['email'] = "<p style='color:red;'>Error: Invalid email address. '@' symbol is missing.</p>";
            $validated = false;
        } else {
            $email = $_POST['email'];
        }

        if (empty($_POST['password'])) {
            $errors['password'] =  "<p style='color:red;'>Password is required.</p>";
            $validated = false;
        } elseif (strpos($_POST['password'], ' ') !== false) {
            $errors['password'] = "<p style='color:red;'>Password cannot contain empty spaces.</p>";
            $validated = false;
        } elseif (empty($_POST['password'])) {
            $errors['password'] =  "<p style='color:red;'>Please write your password.</p>";
            $validated = false;
        } elseif (strpos($_POST['password'], ' ') !== false) {
            $errors['password'] = "<p style='color:red;'>Password cannot contain empty spaces.</p>";
            $validated = false;
        } elseif (strlen($_POST['password'] < 8)) {
            $errors['password'] =  "<p style='color:red;'> Password should be min 8 characters.</p>";
            $validated = false;
        } elseif (!preg_match("/\d/", ($_POST['password']))) {
            $errors['password'] =  "<p style='color:red;'> Password should contain at least one digit.</p>";
            $validated = false;
        } elseif (!preg_match("/[A-Z]/", ($_POST['password']))) {
            $errors['password'] =  "<p style='color:red;'> Password should contain at least one Capital Letter.</p>";
            $validated = false;
        } elseif (!preg_match("/[a-z]/", ($_POST['password']))) {
            $errors['password'] =  "<p style='color:red;'> Password should contain at least one small Letter.</p>";
            $validated = false;
        } elseif (!preg_match("/\W/", ($_POST['password']))) {
            $errors['password'] =  "<p style='color:red;'> Password should contain at least one special character.</p>";
            $validated = false;
        }


        if ($validated) {
            $userObject = new User($conObj, '', $email, '', $password);
            $authentication = $userObject->authenticate();

            if (isset($authentication['success'])) {
                $_SESSION["id"] = $authentication['success'];
                $_SESSION["role"] = $authentication['role'];
                header("Location: /PR2");
                die();
            } else {
                if ($authentication['error'] == 'email') {
                    $errors['email'] = "<p style='color:red;'>Email does not exist.</p>";
                } elseif ($authentication['error'] == 'password') {
                    $errors['password'] = "<p style='color:red;'>Password does not match.</p>";
                }
            }
        }
    }
