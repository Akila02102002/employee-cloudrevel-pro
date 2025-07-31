<?php if(empty($resVal['success'])): ?>
    <div class="text-center py-4">
        <p class="text-danger"><?php echo e($resVal['message']); ?></p>
    </div>
<?php else: ?>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th style="width: 5%;">S.NO</th>
                <th style="width: 20%;">Employee ID</th>
                <th style="width: 20%;">Name</th>
                <th style="width: 25%;">Email</th>
                <th style="width: 20%;">DOB</th>
                <th style="width: 20%;">DOJ</th>
                <th style="width: 25%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $page = $resVal['page'];
                $limit = $resVal['limit'];
                $count = ($page - 1) > 0 ? (($page - 1) * $limit) + 1 : 1;
            ?>
            <?php $__currentLoopData = $resVal['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($count++); ?></td>
                    <td><?php echo e($list->employee_id); ?></td>
                    <td><?php echo e($list->name); ?></td>
                    <td><?php echo e($list->email); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($list->dob)->format('d-m-Y')); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($list->doj)->format('d-m-Y')); ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(url('admin/employees/view/' . $list->id . '?page=' . $resVal['page'])); ?>">
                                        View
                                    </a>
                                </li>
                                <?php if(auth()->guard()->check()): ?>
                                    <?php if(Auth::user()->role === 'admin'): ?>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo e(url('admin/employees/edit/' . $list->id . '?page=' . $resVal['page'])); ?>">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="<?php echo e(url('admin/employees/delete/' . $list->id . '?page=' . $resVal['page'])); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-3" id="pagination">
        <?php echo e($resVal['list']->render()); ?>

    </div>
<?php endif; ?><?php /**PATH C:\xampp1_8_2\htdocs\employeeSystem\resources\views/Employee/pagination_data.blade.php ENDPATH**/ ?>