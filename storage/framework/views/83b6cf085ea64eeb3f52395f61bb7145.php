
<?php $__env->startSection('title', 'Редагування запису'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Редагування запису</h1>

    <form action="<?php echo e(route('blog.update', $blog)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php echo $__env->make('blog._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <button type="submit">Зберегти зміни</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/blog/edit.blade.php ENDPATH**/ ?>