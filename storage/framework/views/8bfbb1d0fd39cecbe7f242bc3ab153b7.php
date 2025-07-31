<!DOCTYPE html>
<html>
<head>
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Employee System</a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <span class="nav-link">Hi, <?php echo e(Auth::user()->name); ?> (<?php echo e(Auth::user()->role); ?>)</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger mt-1 ms-2">Logout</button>
                            </form>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>

    <script>
        function checkEmpty(id, err_id, msg) {
            var valid_man = 0;
            var id_val = $("#" + id).val();
            if (id_val == '') {
                valid_man = 1;
                $("#" + err_id).html(msg);
            } else {
                $("#" + err_id).html('');
            }
            return valid_man;
        }
    </script>
</body>
</html>
<?php /**PATH C:\xampp1_8_2\htdocs\employeeSystem\resources\views/layouts/app.blade.php ENDPATH**/ ?>