
<?php $__env->startSection('title', $blog->title); ?>

<?php $__env->startSection('content'); ?>
    <article>
        <h1><?php echo e($blog->title); ?></h1>

        <div style="color: #555; margin-bottom: 20px;">
            <strong>Категорія:</strong> <?php echo e($blog->category?->category_name ?? 'Без категорії'); ?> |
            <strong>Автор:</strong> <?php echo e($blog->author?->name ?? 'Редакція'); ?> |
            <strong>Дата публікації:</strong> <?php echo e($blog->dt_created->format('d.m.Y')); ?>

        </div>

        <div style="line-height: 1.6;">
            <?php echo e($blog->text); ?>

        </div>
    </article>

    <div style="margin-top: 20px;">
        <a href="<?php echo e(route('blog.index')); ?>">Повернутися назад</a>
        <a href="<?php echo e(route('blog.edit', $blog)); ?>" style="margin-left: 15px;">Редагувати</a>
    </div>

    <div class="tags">
        <?php $__empty_1 = true; $__currentLoopData = $blog->filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <span class="tag">
            <?php echo e($filter->filter_name); ?>

            </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <span>Міток немає.</span>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/blog/show.blade.php ENDPATH**/ ?>