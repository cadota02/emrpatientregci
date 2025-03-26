<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patients List</title>

    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ✅ SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Patients List</h2>

        <!-- ✅ SweetAlert for Success Message -->
        <?php if ($this->session->flashdata('success')): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo $this->session->flashdata('success'); ?>',
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                  <!-- ✅ Add New Patient -->
        <a href="<?php echo site_url('patient/add'); ?>" class="btn btn-primary mb-3">Add New Patient</a>
            </div>
            <div class="col-md-6">
            <form method="GET" action="<?php echo site_url('patient/index'); ?>" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name, email, or phone" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="<?php echo site_url('patient'); ?>" class="btn btn-secondary">Reset</a>
            </div>
        </form>
            </div>
        </div>
     


        <!-- ✅ Patient List Table -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fullname</th>
                        <th>Birthdate</th>
                        <th>Sex</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?php echo $patient['id']; ?></td>
                        <td><?php echo $patient['lastname'] . ', ' . $patient['firstname'] . ' ' . substr($patient['middlename'], 0, 1) . '.'; ?></td>
                        <td><?php echo date("m/d/Y", strtotime($patient['birthday'])); ?></td>
                        <td><?php  echo ($patient['sex'] == 'M') ? 'Male' : 'Female'; ?></td>
                        <td><?php echo $patient['email']; ?></td>
                        <td><?php echo $patient['phone']; ?></td>
                        <td>
                            <a href="<?php echo site_url('patient/edit/'.$patient['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $patient['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ✅ Delete Confirmation -->
    <script>
        function confirmDelete(patientId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?php echo site_url('patient/delete/'); ?>" + patientId;
                }
            });
        }
    </script>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
