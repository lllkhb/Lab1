
<?php $__env->startSection('title', 'Додати рейс'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Додати рейс</h1>
    <form method="POST" action="<?php echo e(route('flight.store')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('flight._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <button type="submit">Зберегти</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/flight/create.blade.php ENDPATH**/ ?>