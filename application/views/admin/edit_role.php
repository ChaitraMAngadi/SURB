<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
   
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Role</h5>
                    </div>
                    
                    <div class="ibox-content">
                        <form id="editRoleForm" class="form-horizontal">
                            <div class="form-group row">
                                <label for="role_name" class="col-sm-2 col-form-label">Role Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="role_name" id="role_name" class="form-control" value="<?= $role->role_name ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="max_users" class="col-sm-2 col-form-label">Max Users</label>
                                <div class="col-sm-10">
                                    <input type="number" name="max_users" id="max_users" class="form-control" value="<?= $role->max_users ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Permissions</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="select_all" name="select_all">
                                        <label class="form-check-label" for="select_all">Select All</label>
                                    </div>
                                    <div class="row">
                                        <?php foreach ($features as $feature): ?>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="feature_<?= $feature->id; ?>" name="features[]" value="<?= $feature->id; ?>" <?= in_array($feature->id, $role_features) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="feature_<?= $feature->id; ?>"><?= $feature->name; ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="text-center">
                                    <button class="btn btn-primary" id="submitBtn" type="submit">Save Role</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $(document).ready(function() {
            function validateForm() {
                var isValid = true;

                // Check role_name and max_users fields
                if ($('#role_name').val().trim() === '' || $('#max_users').val().trim() === '') {
                    isValid = false;
                }

                // Check if at least one feature checkbox is checked
                var atLeastOneChecked = false;
                $('input[name="features[]"]').each(function() {
                    if ($(this).prop('checked')) {
                        atLeastOneChecked = true;
                        return false; // Exit each loop early if found checked
                    }
                });

                return isValid && atLeastOneChecked;
            }

            // Select All checkbox functionality
            $('#select_all').change(function() {
                var isChecked = $(this).prop('checked');
                $('input[name="features[]"]').prop('checked', isChecked);
            });

            // Enable or disable submit button based on form validation
            $('#editRoleForm input, #editRoleForm select').on('keyup change', function() {
                if (validateForm()) {
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#submitBtn').prop('disabled', true);
                }
            });

            // Handle form submission via AJAX
            $('#submitBtn').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?= site_url('admin/add_role/edit_role/' . $role->id); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: $('#editRoleForm').serialize(),
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '<?= site_url('admin/admin_role'); ?>';
                            // Optionally reload the page after toast is shown
                            // setTimeout(function() {
                            //     window.location.reload();
                            // }, 3000);
                        } else {
                            Toastify({
                                text: response.message,
                                duration: 5000,
                                close: true,
                                gravity: 'top',
                                position: 'center',
                                backgroundColor: '#dc3545',
                                stopOnFocus: true
                            }).showToast();
                        }
                    },
                    error: function() {
                        Toastify({
                            text: 'Error: Unable to communicate with the server.',
                            duration: 5000,
                            close: true,
                            gravity: 'top',
                            position: 'center',
                            backgroundColor: '#dc3545',
                            stopOnFocus: true
                        }).showToast();
                    }
                });
            });
        });
    </script>
</body>
</html>






