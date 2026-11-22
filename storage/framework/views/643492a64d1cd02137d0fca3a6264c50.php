

<?php $__env->startSection('title', 'Створення мітки'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Нова мітка</h1>
    <a href="<?php echo e(route('filters.index')); ?>">← Назад до списку</a>

    <form action="<?php echo e(route('filters.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div style="margin-bottom: 15px;">
            <label for="filter_name">Назва мітки:</label><br>
            <input type="text" name="filter_name" id="filter_name" value="<?php echo e(old('filter_name')); ?>" required>

            <?php $__errorArgs = ['filter_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div style="color: red; font-size: 0.9em;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="filter_description">Опис мітки (необов'язково):</label><br>
            <textarea name="filter_description" id="filter_description"><?php echo e(old('filter_description')); ?></textarea>

            <?php $__errorArgs = ['filter_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div style="color: red; font-size: 0.9em;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit">Зберегти мітку</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/filters/create.blade.php ENDPATH**/ ?>