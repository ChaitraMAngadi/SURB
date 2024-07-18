<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Create New User</h5>
                    </div>
                    
                    <div class="ibox-content">
                        <form id="createUserForm" class="form-horizontal">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirm" class="col-sm-2 col-form-label">Re-enter Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="role_id" id="role_id" class="form-control" required>
                                        <option value="">Select Role</option>
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= $role->id; ?>"><?= $role->role_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="text-center">
                                    <button class="btn btn-primary" id="submitBtn" type="submit" disabled>Create User</button>
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

            // Function to validate alphanumeric password with minimum length of 5
            function isValidPassword(password) {
                var pattern = /^[a-zA-Z0-9]{5,}$/;
                return pattern.test(password);
            }
            function validateForm() {
                var isValid = true;

                // Check required fields
                if ($('#name').val() === '' || $('#email').val() === '' || $('#password').val() === '' || $('#password_confirm').val() === '' || $('#role_id').val() === '') {
                    isValid = false;
                }

                // Check if password and confirm_password match
                // if ($('#password').val() !== $('#password_confirm').val()) {
                //     isValid = false;
                // }

                return isValid;
            }

            // Enable or disable submit button based on form validation
            $('#createUserForm input, #createUserForm select').on('keyup change', function() {
                if (validateForm()) {
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#submitBtn').prop('disabled', true);
                }
            });

            // Handle form submission via AJAX
            $('#submitBtn').click(function(e) {
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
                if ($('#password').val() !== $('#password_confirm').val()) {
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

                // Check if password is alphanumeric and at least 5 characters long
               
                if (!validateForm()) {
                    Toastify({
                        text: 'Please fill out all fields correctly.',
                        duration: 5000,
                        close: true,
                        gravity: 'top',
                        position: 'center',
                        backgroundColor: '#dc3545',
                        stopOnFocus: true
                    }).showToast();
                    return;
                }

                $.ajax({
                    url: '<?= site_url('admin/add_user/store_user'); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: $('#createUserForm').serialize(),
                    success: function(response) {
                        if (response.success) {
                            Toastify({
                                text: response.message,
                                duration: 5000,
                                close: true,
                                gravity: 'top',
                                position: 'center',
                                backgroundColor: '#28a745',
                                stopOnFocus: true
                            }).showToast();

                            $('#createUserForm')[0].reset();
                            $('#submitBtn').prop('disabled', true);
                            // Optionally redirect to users listing page
                            // setTimeout(function() {
                            //     window.location.href = '<?= site_url('admin/users'); ?>';
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
