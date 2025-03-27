<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
        <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center"> Register</div>
        <div class="card-body">
            <div id="message"></div>
            <form id="registerForm">
            <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstname" class="form-control" placeholder="Enter first name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastname" class="form-control" placeholder="Enter last name" required>
                    </div>
            <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control mb-2" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                   
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </form>
            <div class="mt-3 text-center">
                    <p>Already have an account? <a href="<?php echo site_url('auth/login'); ?>">Login here</a></p>
                </div>
        </div>
    </div>

    <script>
        $("#registerForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('auth/register_user') ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.status) {
                        // Redirect to login page
                        window.location.href = response.redirect;
                    } else {
                        $("#message").html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function () {
                    $("#message").html('<div class="alert alert-danger">Something went wrong. Please try again.</div>');
                }
            });
        });
    </script>

</body>
</html>
