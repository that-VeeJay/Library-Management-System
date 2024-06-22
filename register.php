<?php
include(__DIR__ . '/templates/union/header.php');

require_once "vendor/autoload.php";

$register = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $register = new classes\authentication\Register($username, $email, $password, $confirmPassword);
}
?>

<body>
    <div class="container full-height">
        <div class="card p-4" style="width: 23rem;">
            <div class="container text-center fw-medium fs-2">
                Registration
            </div>
            <hr>

            <?php ($register instanceof classes\authentication\Register) ? $register->displayMessages() : '' ?>

            <form class="form-inline" action="#" method="post">
                <div class="vstack gap-2">
                    <!-- Username -->
                    <div class="input-group mb-2">
                        <span class="input-group-text fa fa-user pt-2"></span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="username" required>
                    </div>
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
                    <!-- Confirm Password -->
                    <div class="input-group mb-2">
                        <span class="input-group-text fa fa-key pt-2"></span>
                        <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password" name="confirmPassword" required>
                    </div>
                    <!-- Register Button -->
                    <div class="d-grid gap-2 mt-0 mb-2">
                        <button type="submit" class="btn btn-success" type="button">REGISTER</button>
                    </div>
                    <div class="container text-center ">
                        <p>Already a member? <a href="login.php" class="link-success text-decoration-none fw-semibold">Login here.</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>