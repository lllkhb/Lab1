<?php $__env->startSection('title', $country->name); ?>
<?php $__env->startSection('content'); ?>
    <h1><?php echo e($country->name); ?></h1>
    <p>
        <strong>Код:</strong>
        <?php echo e($country->code); ?>

    </p>
    <p>
        <strong>Населення:</strong>
        <?php echo e(number_format($country->population,0, ',', ' ')); ?>

    </p>
    <p>
        <a href="<?php echo e(route('country.edit', $country)); ?>">
            Редагувати
        </a>
    </p>
    <p>
        <a href="<?php echo e(route('country.index')); ?>">
            Повернутися до списку
        </a>
    </p>

    <form
        method="POST"
        action="<?php echo e(route('country.destroy', $country)); ?>"
    >
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit">
            Видалити
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/country/show.blade.php ENDPATH**/ ?>