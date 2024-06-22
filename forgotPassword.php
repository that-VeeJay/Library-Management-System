<?php
include(__DIR__ . '/templates/union/header.php');
require_once(__DIR__ . '/vendor/autoload.php');

$forgotPass = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $memberId = $_POST['memberId'];
    $email = $_POST['email'];

    $forgotPass = new \classes\authentication\ForgotPassword($memberId, $email);
}
?>

<body>
    <div class="container full-height">
        <div class="card p-4" style="width: 23rem;">
            <div class="container text-center fw-medium fs-2">
                Forgot Password
            </div>
            <hr>

            <?php ($forgotPass instanceof \classes\authentication\ForgotPassword) ? $forgotPass->matchedInput() : '' ?>

            <form class="form-inline" action="#" method="post">
                <div class="vstack gap-2">
                    <!-- Email -->
                    <div class="input-group mb-2">
                        <span class="input-group-text fa fa-id-card pt-2"></span>
                        <input type="password" class="form-control" placeholder="Member ID" aria-label="MemberId" name="memberId" required>
                    </div>
                    <!-- Password -->
                    <div class="input-group mb-2">
                        <span class="input-group-text fa fa-envelope pt-2"></span>
                        <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" required>
                    </div>
                    <!-- Register Button -->
                    <div class="d-grid gap-2 mt-0 mb-2">
                        <button type="submit" class="btn btn-success" type="button">RECOVER</button>
                    </div>
                    <div class="container text-center ">
                        <p>Back to <a href="login.php" class="link-success text-decoration-none fw-semibold">Login.</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>