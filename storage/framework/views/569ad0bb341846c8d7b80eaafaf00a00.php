
<?php $__env->startSection('title', 'Редагування країни'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Редагування країни</h1><form
        method="POST"
        action="<?php echo e(route('country.update', $country)); ?>"
    >
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('country._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <button type="submit">
            Зберегти зміни
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/country/edit.blade.php ENDPATH**/ ?>