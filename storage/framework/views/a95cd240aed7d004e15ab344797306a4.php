
<?php $__env->startSection('title', 'Редагування рейсу'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Редагування рейсу <?php echo e($flight->id); ?></h1>
    <form method="POST" action="<?php echo e(route('flight.update', $flight)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('flight._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <button type="submit">Зберегти зміни</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/flight/edit.blade.php ENDPATH**/ ?>