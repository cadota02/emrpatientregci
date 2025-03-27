<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patients List</title>

    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- ✅ SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ✅ DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

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
       
        <div class="d-flex align-items-center">
            <div class="col-md-9">
                  <a href="<?php echo site_url('patient/add'); ?>" class="btn btn-primary mb-3">Add New Patient</a>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <div class="input-group">
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#searchModal">
                    Advanced Search
                </button>
                <a href="<?php echo site_url('patient'); ?>" class="btn btn-secondary">Reset</a>
                </div>
            </div>
           
        </div>
     

        <!-- ✅ Patient List Table -->
        <div class="table-responsive">
            <table id="patientTable" class="table table-striped table-bordered">
                <thead >
                    <tr>
                        <th>ID</th>
                        <th>Fullname</th>
                        <th>Birthdate</th>
                        <th>Sex</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Profile</th>
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
                            <?php if ($patient['profile_image']): ?>
                                <img src="<?php echo base_url($patient['profile_image']); ?>" width="50" height="50">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                        <a href="#" class="btn btn-info btn-sm view-btn" >View</a>
                            <a href="<?php echo site_url('patient/edit/'.$patient['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $patient['id']; ?>)">Delete</button>
                       
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Advanced Search</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="searchForm">
                    <div class="mb-3">
                        <label for="searchName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="searchName" placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                        <label for="searchEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="searchEmail" placeholder="Enter Email">
                    </div>
                    <div class="mb-3">
                        <label for="searchPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="searchPhone" placeholder="Enter Phone">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
               
                <button type="button" class="btn btn-primary" id="applySearch">Search</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="patientModalLabel">Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="patient_name"></span></p>
                <p><strong>Birthday:</strong> <span id="patient_birthday"></span></p>
                <p><strong>Sex:</strong> <span id="patient_sex"></span></p>
                <p><strong>Email:</strong> <span id="patient_email"></span></p>
                <p><strong>Phone:</strong> <span id="patient_phone"></span></p>
              
            </div>
        </div>
    </div>
</div>


    <script>
    $(document).ready(function() {
        var table = $('#patientTable').DataTable({
            dom: 'Bfrtip', // Enable buttons
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print' // Add export options
            ]
        });
          // Search Button Click Event
            $('#applySearch').on('click', function() {
                var name = $('#searchName').val().trim();
                var email = $('#searchEmail').val().trim();
                var phone = $('#searchPhone').val().trim();

                // Use %% for SQL-like partial search
                table.column(1).search(name, false, true);  // Fullname column
        table.column(4).search(email, false, true); // Email column
        table.column(5).search(phone, false, true); // Phone column

                table.draw();
                $('#searchModal').modal('hide');
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
              
            });
            $('#patientTable tbody').on('click', '.view-btn', function() {
                var data = table.row($(this).parents('tr')).data();
                ViewPatient(data[0]); // Assuming the first column contains the patient ID
            });
            function ViewPatient(id)
            {
                $.ajax({
                    url: "<?php echo base_url('patient/get_patient/'); ?>" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $('#patient_name').text(response.name);
                            $('#patient_birthday').text(response.birthday);
                            $('#patient_sex').text(response.sex);
                            $('#patient_email').text(response.email);
                            $('#patient_phone').text(response.phone);
                            
                            $('#patientModal').modal('show');
                        } else {
                            alert('Patient details not found.');
                        }
                    },
                    error: function()
                    {
                        alert('Failed to get patient details');
                    }
                });
            }

            
    });

</script>
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
