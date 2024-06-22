<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/login-signup.css">
    <!-- Custom Javascript -->
    <script src="js/script.js" defer></script>
    <title>Register</title>
</head>

<body>
    <div class="container full-height">
        <div class="card p-4" style="width: 23rem;">
            <div class="container text-center fw-medium fs-2">
                Registration
            </div>
            <hr>
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
                        <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password" name="confirm_password" required>
                    </div>
                    <!-- Register Button -->
                    <div class="d-grid gap-2 mt-0">
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