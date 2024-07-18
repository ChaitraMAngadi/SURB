<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit User</h5>
                    </div>
                    
                    <div class="ibox-content">
                        <form id="editUserForm" class="form-horizontal">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control" value="<?= $user->name ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" id="email" class="form-control" value="<?= $user->email ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="role_id" id="role_id" class="form-control" required>
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= $role->id; ?>" <?= ($role->id == $user->role_id) ? 'selected' : ''; ?>>
                                                <?= $role->role_name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" id="password" class="form-control">
                                    <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="retype_password" class="col-sm-2 col-form-label">Retype Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="retype_password" id="retype_password" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="text-center">
                                    <button class="btn btn-primary" id="submitBtn" type="submit">Save User</button>
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
            function isValidEmail(email) {
                var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return pattern.test(email);
            }
            function passwordsMatch(password, confirmPassword) {
                return password === confirmPassword;
            }

            function isValidPassword(password) {
                var pattern = /^[a-zA-Z0-9]{5,}$/;
                return pattern.test(password);
            }
            function validateForm() {
                var isValid = true;

                // Check name and email fields
                if ($('#name').val() === '' || $('#email').val() === '') {
                    isValid = false;
                }

                // Check password length and match
                var password = $('#password').val();
                var retypePassword = $('#retype_password').val();
                if (password.length > 0 && (password.length < 5 || !/^[a-zA-Z0-9]+$/.test(password) )) {
                    isValid = false;
                }

                return isValid;
            }

            // Enable or disable submit button based on form validation
            $('#editUserForm input, #editUserForm select').on('keyup change', function() {
                if (validateForm()) {
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#submitBtn').prop('disabled', true);
                }
            });

            // Handle form submission via AJAX
            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();
                if (!isValidEmail($('#email').val())) {
                    // isValid = false;
                    // console.log("run")
                    Toastify({
                        text: 'Invalid email format',
                        duration: 5000,
                        close: true,
                        gravity: 'top',
                        position: 'center',
                        backgroundColor: '#dc3545',
                        stopOnFocus: true
                    }).showToast();
                    return;
                }

                // Check if password is alphanumeric and at least 5 characters long
                if ($('#password').val() !== '' && !isValidPassword($('#password').val())) {
                    // isValid = false;
                    Toastify({
                        text: 'Password must be at least 5 characters long',
                        duration: 5000,
                        close: true,
                        gravity: 'top',
                        position: 'center',
                        backgroundColor: '#dc3545',
                        stopOnFocus: true
                    }).showToast();
                    return;
                }
                if ($('#password').val().length>0 && $('#password').val() !== $('#password_confirm').val()) {
                    Toastify({
                        text: 'Passwords do not match',
                        duration: 5000,
                        close: true,
                        gravity: 'top',
                        position: 'center',
                        backgroundColor: '#dc3545',
                        stopOnFocus: true
                    }).showToast();
                    return;
                }
                if (validateForm()) {
                    $.ajax({
                        url: '<?= site_url('admin/add_user/edit_user/' . $user->id); ?>',
                        type: 'post',
                        dataType: 'json',
                        data: $('#editUserForm').serialize(),
                        success: function(response) {
                            if (response.success) {
                                window.location.href = '<?= site_url('admin/admin_users'); ?>';
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
                } else {
                    Toastify({
                        text: 'Please fill all the required fields correctly.',
                        duration: 5000,
                        close: true,
                        gravity: 'top',
                        position: 'center',
                        backgroundColor: '#dc3545',
                        stopOnFocus: true
                    }).showToast();
                }
            });
            $('#submitBtn').prop('disabled', true);
        });
    </script>
</body>
</html>
