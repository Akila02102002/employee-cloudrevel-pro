
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Login</h2>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
        <?php endif; ?>
        <form method="POST" id="kt_login_form" action="<?php echo e(url('/loginSubmit')); ?>" accept-charset="UTF-8">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control">
                <p id="email_err" style="color: red;"></p>
            </div>
            <div class="mb-3 position-relative">
                <label>Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control">
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        👁️
                    </span>
                </div>
                <p id="password_err" style="color: red;"></p>
            </div>            
            <div class="modal-footer">
                <button type="button" id="kt_login_signin_submit" class="btn btn-primary">Login</button>
            </div>          
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#kt_login_signin_submit').click(function () {
        var validate_man = 0;
        var valid_man = 0;

        valid_man = checkEmpty('email', 'email_err', '* Required');
        if (valid_man == 1) {
            validate_man += 1;
        }
        valid_man = checkEmpty('password', 'password_err', '* Required');
        if (valid_man == 1) {
            validate_man += 1;
        }

        const theButton = document.querySelector("#kt_login_signin_submit");

        if (validate_man == 0) {
            theButton.classList.add("button--loading");
            $('#kt_login_signin_submit').prop('disabled', true);
            $('#kt_login_form').submit();
        } else {
            theButton.classList.remove("button--loading");
            $('#kt_login_signin_submit').prop('disabled', false);
        }
    });
    $('#togglePassword').on('click', function () {
        const passwordField = $('#password');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);

        $(this).text(type === 'password' ? '👁️' : '🙈');
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1_8_2\htdocs\employeeSystem\resources\views/login/login.blade.php ENDPATH**/ ?>