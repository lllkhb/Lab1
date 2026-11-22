

<?php $__env->startSection('title', 'Довідник міток'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Довідник міток</h1>
    <p>
        <a href="<?php echo e(route('filters.create')); ?>">+ Додати мітку</a>
    </p>

    <hr>

    <?php $__empty_1 = true; $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
            <h2><?php echo e($filter->filter_name); ?></h2>

            <?php if($filter->filter_description): ?>
                <p><?php echo e($filter->filter_description); ?></p>
            <?php endif; ?>

            <div style="display: flex; gap: 15px; align-items: center;">
                <a href="<?php echo e(route('filters.edit', $filter)); ?>" style="background-color: #1c3c5a; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px;">
                    Редагувати
                </a>

                <form action="<?php echo e(route('filters.destroy', $filter)); ?>" method="POST" onsubmit="return confirm('Ви дійсно бажаєте видалити цю мітку?');" style="margin: 0;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer;">
                        Видалити
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>Міток поки не додано</p>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/filters/index.blade.php ENDPATH**/ ?>