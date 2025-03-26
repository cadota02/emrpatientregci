<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Patient</title>

    <!-- ✅ Include Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5 col-md-6 offset-md-3 border rounded shadow p-5">
        <h2 class="mb-4">Add Patient</h2>

        <!-- Show validation errors -->
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <!-- Add Patient Form -->
        <?php echo form_open_multipart('patient/add', ['class' => 'needs-validation', 'novalidate' => '']); ?>
        <div class="form-group row">
        <div class="col-sm-4">
            <label class="form-label">Firstname:</label>
            <input type="text" name="firstname" placeholder="Enter Firstname"  class="form-control" value="<?php echo set_value('firstname'); ?>" required>
        </div>
        <div class="col-sm-4">
            <label class="form-label">Middlename:</label>
            <input type="text" name="middlename"  placeholder="Enter Middlename"  class="form-control" value="<?php echo set_value('middlename'); ?>" required>
        </div>
        <div class="col-sm-4">
            <label class="form-label">Lastname:</label>
            <input type="text" name="lastname"  placeholder="Enter Lastname"  class="form-control" value="<?php echo set_value('lastname'); ?>" required>
        </div>
        </div>
        <div class="form-group row">
        <div class="col-sm-6">
            <label class="form-label">Date of Birth:</label>
            <input type="date" name="birthday" class="form-control" value="<?php echo set_value('birthday');  ?>" required>
        </div>
        <div class="col-sm-6">
            <label class="form-label">Sex:</label>
            <select name="sex" class="form-control"  required>
                <option value="">Select Sex</option>
                <option value="M" <?php echo set_select('sex', 'M'); ?>>Male</option>
                <option value="F" <?php echo set_select('sex', 'F'); ?>>Female</option>
            </select>
        </div>
        </div>
        <div class="form-group row">
        <div class="col-sm-6">
      
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo set_value('email'); ?>" required>
        </div>

        <div class="col-sm-6">
            <label class="form-label">Phone:</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter Phone number" value="<?php echo set_value('phone'); ?>" required>
        </div>
        </div>
        <div class="form-group row">
        <div class="col-sm-12">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    <input type="file" class="form-control" name="profile_image" accept="image/*">
                </div>
        </div>
        <div class="form-group row pt-5">
       
        <button type="submit" class="btn btn-primary mb-3">Submit</button>
        
        
        <a href="<?php echo site_url('patient'); ?>" class="btn btn-secondary">Cancel</a>
     
        </div>
        <?php echo form_close(); ?>
    </div>

    <!-- ✅ Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
