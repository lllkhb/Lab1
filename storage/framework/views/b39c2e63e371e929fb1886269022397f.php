

<?php $__env->startSection('title', (($locale ?? 'uk') === 'en') ? 'Flight Details' : 'Деталі рейсу'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $translation = $flight->translations->first();
        $depAirport  = $translation->departure_airport ?? $flight->departure_airport;
        $arrAirport  = $translation->arrival_airport ?? $flight->arrival_airport;
        $aircraft    = $translation->aircraft_model ?? $flight->aircraft_model;
    ?>

    <h1><?php echo e((($locale ?? 'uk') === 'en') ? 'Flight Details:' : 'Деталі рейсу:'); ?> <?php echo e($flight->id); ?></h1>

    <div class="lang-switcher">
        <span>Мова / Language:</span>
        <a href="<?php echo e(request()->fullUrlWithQuery(['lang' => 'uk'])); ?>" style="<?php echo e(($locale ?? 'uk') === 'uk' ? 'font-weight: bold; text-decoration: underline;' : ''); ?>">UA</a> |
        <a href="<?php echo e(request()->fullUrlWithQuery(['lang' => 'en'])); ?>" style="<?php echo e(($locale ?? 'uk') === 'en' ? 'font-weight: bold; text-decoration: underline;' : ''); ?>">EN</a> |
        <a href="<?php echo e(request()->fullUrlWithQuery(['lang' => 'de'])); ?>" style="<?php echo e(($locale ?? 'uk') === 'de' ? 'font-weight: bold; text-decoration: underline;' : ''); ?>">DE</a>
    </div>

    <div style="background: #fff; padding: 24px 28px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); max-width: 760px;">
        <p><strong>Аеропорт вильоту:</strong> <?php echo e($depAirport); ?></p>
        <p><strong>Аеропорт прибуття:</strong> <?php echo e($arrAirport); ?></p>
        <p><strong>Літак:</strong> <?php echo e($aircraft); ?></p>
        <p><strong>Виліт:</strong> <?php echo e(\Carbon\Carbon::parse($flight->departure_date)->format('d.m.Y')); ?> о <?php echo e(\Carbon\Carbon::parse($flight->departure_time)->format('H:i')); ?></p>
        <p><strong>Прибуття:</strong> <?php echo e(\Carbon\Carbon::parse($flight->arrival_date)->format('d.m.Y')); ?> о <?php echo e(\Carbon\Carbon::parse($flight->arrival_time)->format('H:i')); ?></p>

        <h3>Тарифи</h3>
        <?php if($flight->tariffs && $flight->tariffs->count()): ?>
            <table>
                <thead>
                <tr>
                    <th>Назва тарифу</th>
                    <th>Клас</th>
                    <th>Багаж</th>
                    <th>Ціна</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $flight->tariffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tariff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($tariff->name); ?></td>
                        <td><?php echo e($tariff->class_name); ?></td>
                        <td><?php echo e($tariff->baggage ? 'Так' : 'Ні'); ?></td>
                        <td><strong><?php echo e(number_format($tariff->pivot->price, 2, '.', ' ')); ?> грн</strong></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="color: #64748b; font-style: italic;">Тарифи не призначені.</p>
        <?php endif; ?>

        <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #e1e8f0; display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <a href="<?php echo e(route('flight.edit', $flight)); ?>" style="margin: 0;">Редагувати</a>
            <a href="<?php echo e(route('flight.index')); ?>" style="margin: 0;">Повернутися до списку</a>

            <form action="<?php echo e(route('flight.destroy', $flight)); ?>" method="POST" style="margin: 0; margin-left: auto;" onsubmit="return confirm('Ви впевнені, що хочете видалити цей рейс?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit">Видалити</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/flight/show.blade.php ENDPATH**/ ?>