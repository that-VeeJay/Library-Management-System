<?php
include(__DIR__ . '/templates/union/header.php');

require_once "vendor/autoload.php";

$login = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = new \classes\authentication\Login($email, $password);
}


?>

<body>
    <div class="container full-height">
        <div class="card p-4" style="width: 23rem;">
            <div class="container text-center fw-medium fs-2">
                Login
            </div>
            <hr>

            <?php ($login instanceof classes\authentication\Login) ? $login->loginUser() : '' ?>

            <form class="form-inline" action="#" method="post">
                <div class="vstack gap-2">
                    <!-- Email -->
                    <div class="input-group mb-2">
                        <span class="input-group-text fa fa-envelope pt-2"></span>
                        <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" required>
                    </div>
                    <!-- Password -->
                    <div class="input-group mb-2">
                        <span class="input-group-text fa fa-key pt-2"></span>
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" required>
                    </div>
                    <!-- Forgot Password -->
                    <div class="container">
                        <div class="d-flex justify-content-end">
                            <p><a href="forgotPassword.php" class="link-success text-decoration-none fw-semibold">Forgot Password?</a></p>
                        </div>
                    </div>
                    <!-- Register Button -->
                    <div class="d-grid gap-2 mt-0 mb-2">
                        <button type="submit" class="btn btn-success" type="button">LOGIN</button>
                    </div>
                    <div class="container text-center ">
                        <p>Not a member yet? <a href="register.php" class="link-success text-decoration-none fw-semibold">Register.</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>