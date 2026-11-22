
<?php $__env->startSection('title', 'Детальна статистика'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Детальна статистика</h1>
    <p>
        Фільтр:
        <strong><?php echo e($type); ?></strong>
        =
        <strong><?php echo e($item); ?></strong>
    </p>
    <table>
        <thead>
        <tr>
            <th>Сторінка</th>
            <th>IP</th>
            <th>Статус</th>
            <th>Метод</th>
            <th>Маршрут</th>
            <th>Пристрій</th>
            <th>Дата і час</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($row->page); ?></td>
                <td><?php echo e($row->ip); ?></td>
                <td><?php echo e($row->status); ?></td>
                <td><?php echo e($row->method); ?></td>
                <td><?php echo e($row->route_name); ?></td>
                <td><?php echo e($row->device); ?></td>
                <td>
                    <?php echo e($row->visited_at->format('d.m.Y H:i:s')); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($rows->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/stats/detail.blade.php ENDPATH**/ ?>