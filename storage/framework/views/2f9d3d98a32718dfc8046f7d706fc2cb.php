
<?php $__env->startSection('title', 'Статистика відвідувань'); ?>
<?php $__env->startSection('content'); ?><h1>Статистика відвідувань</h1>
<p>
    <a href="<?php echo e(route('stats.pages', ['type' => 'page'])); ?>">
        За сторінками
    </a>
    <a href="<?php echo e(route('stats.pages', ['type' => 'ip'])); ?>">
        За IP-адресами
    </a>
</p>
<table>
    <thead>
    <tr>
        <th><?php echo e($type === 'page' ? 'Сторінка' : 'IP-адреса'); ?></th>
        <th>Звернень</th>
        <th>Останній візит</th>
    </tr>
    </thead>
    <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td>
                <a href="<?php echo e(route('stats.detail', [
'type' => $type,
'item' => $row->{$type},
])); ?>">
                    <?php echo e($row->{$type}); ?>

                </a>
            </td>
            <td><?php echo e($row->hits); ?></td>
            <td><?php echo e($row->last_visit); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="3">
                Даних ще немає.
            </td>
        </tr><?php endif; ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/stats/pages.blade.php ENDPATH**/ ?>