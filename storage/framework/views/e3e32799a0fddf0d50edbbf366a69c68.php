
<?php $__env->startSection('title', 'Популярні рейси'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Найпопулярніші рейси</h1>
    <table>
        <thead>
        <tr>
            <th>Рейс</th>
            <th>Дата вильоту</th>
            <th>Переглядів</th>
            <th>Останній перегляд</th>
        </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <a href="<?php echo e(route('flight.show', $f->id)); ?>">
                        <?php echo e($f->departure_airport); ?> → <?php echo e($f->arrival_airport); ?>

                    </a>
                </td>
                <td><?php echo e(\Carbon\Carbon::parse($f->departure_date)->format('d.m.Y')); ?></td>
                <td><?php echo e($f->views); ?></td>
                <td><?php echo e($f->last_view); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="4">Даних ще немає.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <h2>Відвідування за типом пристрою</h2>
    <table>
        <thead>
        <tr><th>Пристрій</th><th>Звернень</th></tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr><td><?php echo e($d->device); ?></td><td><?php echo e($d->hits); ?></td></tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/stats/flights.blade.php ENDPATH**/ ?>