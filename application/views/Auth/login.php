<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                 <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger text-center"><?php echo $this->session->flashdata('error'); ?></div>
                <?php endif; ?>

                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <form method="post" action="<?php echo site_url('auth/process_login'); ?>">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <div class="mt-3 text-center">
                    <p>Don't have an account? <a href="<?php echo site_url('auth/register'); ?>">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
