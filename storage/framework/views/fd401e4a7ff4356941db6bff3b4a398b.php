
<?php $__env->startSection('title', 'Довідник країн'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Довідник країн</h1>
    <p>
        <a href="<?php echo e(route('country.create')); ?>">
            Додати країну
        </a>
    </p>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Код</th>
            <th>Назва</th>
            <th>Населення</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <?php echo e($countries->firstItem() + $i); ?>

                </td>
                <td><?php echo e($country->code); ?>

                </td>
                <td>
                    <a href="<?php echo e(route('country.show', $country)); ?>">
                        <?php echo e($country->name); ?>

                    </a>
                </td>
                <td>
                    <?php echo e(number_format($country->population, 0, ',', ' ')); ?>

                </td>
                <td>
                    <a href="<?php echo e(route('country.edit', $country)); ?>">
                        Редагувати
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($countries->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/country/index.blade.php ENDPATH**/ ?>