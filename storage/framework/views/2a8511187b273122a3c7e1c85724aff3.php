
<?php $__env->startSection('title', 'Керування мітками'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Мітки: <?php echo e($blog->title); ?></h1>
    <form method="POST"
          action="<?php echo e(route('blog.tags.store', $blog)); ?>">
        <?php echo csrf_field(); ?>
        <label for="duallist">
            Оберіть мітки запису
        </label>
        <select
            id="duallist"
            name="filters[]"
            multiple
        >
            <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                    value="<?php echo e($id); ?>"
                    <?php if(
                    in_array(
                    $id,
                    old('filters', $selected)
                    )
                    ): echo 'selected'; endif; ?>
                >
                    <?php echo e($name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit">Зберегти мітки
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/blog/tags.blade.php ENDPATH**/ ?>