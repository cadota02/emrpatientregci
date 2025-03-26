<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Patient</title>

    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ✅ SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5 col-md-6 offset-md-3 border rounded shadow p-5">
        <h2 class="mb-4">Edit Patient</h2>
 <!-- Show validation errors -->
 <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php echo form_open_multipart('patient/edit/'.$patient['id'], ['id' => 'editPatientForm']); ?>


        <div class="form-group row">
            <div class="col-sm-4">
                <label class="form-label">Firstname:</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo set_value('name', $patient['firstname']); ?>" required>
            </div>
            <div class="col-sm-4">
                <label class="form-label">Middlename:</label>
                <input type="text" name="middlename" class="form-control" value="<?php echo set_value('name', $patient['middlename']); ?>" required>
            </div>
            <div class="col-sm-4">
                <label class="form-label">Lastname:</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo set_value('name', $patient['lastname']); ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Date of Birth:</label>
                <input type="date" name="birthday" class="form-control" value="<?php echo set_value('name', $patient['birthday']);  ?>" required>
            </div>
            <div class="col-sm-6">
                <label class="form-label">Sex:</label>
                <select name="sex" class="form-control" required>
                    <option value="">Select Sex</option>
                    <option value="M" <?php echo set_select('sex', 'M', set_value('sex', $patient['sex'] ?? '') == 'M'); ?>>Male</option>
                    <option value="F" <?php echo set_select('sex', 'F', set_value('sex', $patient['sex'] ?? '') == 'F');?>>Female</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo set_value('email', $patient['email']); ?>">
            </div>

            <div class="col-sm-6">
                <label class="form-label">Phone:</label>
                <input type="text" name="phone" class="form-control" value="<?php echo set_value('phone', $patient['phone']); ?>">
            </div>
        </div>

         <!-- ✅ Profile Image Upload -->
         <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Profile Image:</label>
                <input type="file" name="profile_image" class="form-control">
            </div>
            <div class="col-sm-6">
                <?php if (!empty($patient['profile_image'])): ?>
                    <label class="form-label">Current Image:</label><br>
                    <img src="<?php echo base_url($patient['profile_image']); ?>" alt="Profile Image" class="img-thumbnail" width="120">
                <?php else: ?>
                    <p>No Image</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group row pt-5  justify-content-center">
            <button type="submit" class="btn btn-primary mb-3">Update</button>
            <a href="<?php echo site_url('patient'); ?>" class="btn btn-secondary">Cancel</a>
        </div>
     

        <?php echo form_close(); ?>
    </div>

    <!-- ✅ Show SweetAlert on Success -->
    <?php if ($this->session->flashdata('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Patient Updated!',
                text: '<?php echo $this->session->flashdata('success'); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php endif; ?>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
