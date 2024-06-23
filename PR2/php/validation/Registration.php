
<?php
require_once __DIR__ . "/../Autoload.php";
require_once __DIR__ . "/../classes/User.php";

$errors = ['password' =>  false, 'email' => false, 'name' => false, 'surname' => false];
$validated = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];


    if (empty($_POST['email'])) {
        $errors['email'] = "<p style='color:red;'>Please write your email.</p>";
        $validated = false;
    } elseif (strpos($_POST['email'], ' ') !== false) {
        $errors['email'] = "<p style='color:red;'>Username cannot contain empty spaces.</p>";
        $validated = false;
    } elseif (strpos($email, '@') === false) {
        $errors['email'] = "<p style='color:red;'>Error: Invalid email address. '@' symbol is missing.</p>";
        $validated = false;
    }

    if (empty($_POST['password'])) {
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
    } elseif (!preg_match("/\W/", ($_POST['password']))) {
        $errors['password'] =  "<p style='color:red;'> Password should contain at least one special character.</p>";
        $validated = false;
    }

    if (empty($_POST['name'])) {
        $errors['name'] = "<p style='color:red;'>Please write your name.</p>";
        $validated = false;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $errors['name'] = "<p style='color:red;'> Only letters and white space allowed.</p>";
        $validated = false;
    }
    if (empty($_POST['surname'])) {
        $errors['surname'] = "<p style='color:red;'>Please write your surname.</p>";
        $validated = false;
    } elseif (strpos($_POST['surname'], ' ') !== false) {
        $errors['surname'] = "<p style='color:red;'> Surname cannot contain empty spaces.</p>";
        $validated = false;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $surname)) {
        $errors['surname'] = "<p style='color:red;'> Only letters and white space allowed.</p>";
        $validated = false;
    }

    if ($validated) {
        $userObject = new User($conObj, $name, $email, $surname, $password);
        $conflicts = $userObject->checkConflicts();

        if ($conflicts['email']) {
            $errors['email'] = "<p style='color:red;'>Email already exists.</p>";
        }
        if ($conflicts['name']) {
            $errors['name'] = "<p style='color:red;'>Name already exists.</p>";
        }
        if ($conflicts['surname']) {
            $errors['surname'] = "<p style='color:red;'>Surname already exists.</p>";
        }
        if ($conflicts['password']) {
            $errors['password'] = "<p style='color:red;'>Password already exists.</p>";
        }

        if (!array_filter($conflicts)) {
            $userObject->addUser();
            header("Location: LoginIndex.php");
            die();
        }
    }
}
