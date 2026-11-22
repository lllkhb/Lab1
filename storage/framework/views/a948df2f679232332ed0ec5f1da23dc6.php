
<?php $__env->startSection('title', ($locale === 'en') ? 'Flights admin' : 'Адміністрування рейсів'); ?>
<?php $__env->startSection('content'); ?>
    <style>
        main h1 {
            font-size: 28px;
            font-weight: 700;
            color: #133b6e;
            margin-bottom: 12px;
        }

        .lang-switcher {
            margin-bottom: 20px;
            font-size: 15px;
            color: #333;
        }

        .lang-switcher a {
            color: #133b6e;
            text-decoration: none;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .lang-switcher a:hover {
            background-color: #e6eef8;
        }

        a[href*="/flight/create"], .btn-add, .btn-primary {
            display: inline-block;
            background-color: #133b6e;
            color: #ffffff !important;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            margin: 10px 0 20px 0;
            transition: background-color 0.2s;
        }

        a[href*="/flight/create"]:hover, .btn-add:hover, .btn-primary:hover {
            background-color: #0d2a50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 24px;
        }

        table thead {
            background-color: #133b6e;
            color: #ffffff;
        }

        table th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        table th a {
            color: #fff;
            text-decoration: none;
        }

        table th a:hover {
            text-decoration: underline;
        }

        table td {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            color: #1f2937;
            vertical-align: middle;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        table tbody tr:hover {
            background-color: #f0f5ff;
        }

        table td a {
            color: #133b6e;
            font-weight: 500;
            text-decoration: none;
        }

        table td a:hover {
            text-decoration: underline;
        }

        table td a[href*="/edit"], .btn-edit {
            display: inline-block;
            background-color: #eef2ff;
            color: #133b6e !important;
            border: 1px solid #c7d2fe;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        table td a[href*="/edit"]:hover, .btn-edit:hover {
            background-color: #133b6e;
            color: #ffffff !important;
            border-color: #133b6e;
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-end;
            max-width: none;
            padding: 16px 20px;
        }

        .filter-form > div {
            margin: 0;
            flex: 1 1 150px;
        }

        .filter-form input,
        .filter-form select {
            margin-bottom: 0;
        }

        .filter-form .btn-reset {
            color: #133b6e;
            font-size: 14px;
            margin-left: 6px;
        }
    </style>

    <?php
        $en = $locale === 'en';

        $sortRaw   = request('sort', 'departure');
        $sortDesc  = str_starts_with($sortRaw, '-');
        $sortField = ltrim($sortRaw, '-');

        $sortUrl = fn (string $col) => request()->fullUrlWithQuery([
            'sort' => ($sortField === $col && !$sortDesc) ? '-' . $col : $col,
            'page' => null,
        ]);

        $arrow = fn (string $col) => $sortField === $col ? ($sortDesc ? ' ▼' : ' ▲') : '';
    ?>

    <h1><?php echo e($en ? 'Flights admin' : 'Адміністування рейсів'); ?></h1>

    <div class="lang-switcher" style="margin-bottom: 15px;">
        <span>Мова / Language:</span>
        <a href="<?php echo e(request()->fullUrlWithQuery(['lang' => 'uk', 'page' => null])); ?>" style="<?php echo e($locale === 'uk' ? 'font-weight: bold; text-decoration: underline;' : ''); ?>">UA</a> |
        <a href="<?php echo e(request()->fullUrlWithQuery(['lang' => 'en', 'page' => null])); ?>" style="<?php echo e($locale === 'en' ? 'font-weight: bold; text-decoration: underline;' : ''); ?>">EN</a> |
        <a href="<?php echo e(request()->fullUrlWithQuery(['lang' => 'de', 'page' => null])); ?>" style="<?php echo e($locale === 'de' ? 'font-weight: bold; text-decoration: underline;' : ''); ?>">DE</a>
    </div>

    <p>
        <a href="<?php echo e(route('flight.create', ['lang' => $locale])); ?>" class="btn btn-primary">
            <?php echo e($en ? 'Add new flight' : 'Додати рейс'); ?>

        </a>
    </p>

    <?php if($errors->any()): ?>
        <p class="text-danger"><?php echo e($errors->first()); ?></p>
    <?php endif; ?>

    <form method="GET" action="<?php echo e(route('flight.admin')); ?>" class="filter-form">
        <input type="hidden" name="lang" value="<?php echo e($locale); ?>">
        <input type="hidden" name="sort" value="<?php echo e(request('sort')); ?>">

        <div>
            <label for="search"><?php echo e($en ? 'Search' : 'Пошук'); ?></label>
            <input type="text" id="search" name="search" value="<?php echo e(request('search')); ?>"
                   placeholder="<?php echo e($en ? 'Airport, aircraft, tariff…' : 'Аеропорт, літак, тариф…'); ?>">
        </div>

        <div style="flex: 0 1 110px;">
            <label for="number"><?php echo e($en ? 'Flight #' : 'Номер'); ?></label>
            <input type="number" id="number" name="number" min="1" value="<?php echo e(request('number')); ?>">
        </div>

        <div>
            <label for="from"><?php echo e($en ? 'From' : 'Звідки'); ?></label>
            <select id="from" name="from">
                <option value=""><?php echo e($en ? 'Any' : 'Будь-який'); ?></option>
                <?php $__currentLoopData = $departureAirports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($airport); ?>" <?php if(request('from') === $airport): echo 'selected'; endif; ?>><?php echo e($airport); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label for="to"><?php echo e($en ? 'To' : 'Куди'); ?></label>
            <select id="to" name="to">
                <option value=""><?php echo e($en ? 'Any' : 'Будь-який'); ?></option>
                <?php $__currentLoopData = $arrivalAirports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($airport); ?>" <?php if(request('to') === $airport): echo 'selected'; endif; ?>><?php echo e($airport); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label for="tariff_id"><?php echo e($en ? 'Tariff' : 'Тариф'); ?></label>
            <select id="tariff_id" name="tariff_id">
                <option value=""><?php echo e($en ? 'All tariffs' : 'Усі тарифи'); ?></option>
                <?php $__currentLoopData = $tariffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php if((int) request('tariff_id') === $id): echo 'selected'; endif; ?>><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label for="dep_from"><?php echo e($en ? 'Departure from' : 'Виліт від'); ?></label>
            <input type="date" id="dep_from" name="dep_from" value="<?php echo e(request('dep_from')); ?>">
        </div>

        <div>
            <label for="dep_to"><?php echo e($en ? 'Departure to' : 'Виліт до'); ?></label>
            <input type="date" id="dep_to" name="dep_to" value="<?php echo e(request('dep_to')); ?>">
        </div>

        <div>
            <label for="arr_from"><?php echo e($en ? 'Arrival from' : 'Прибуття від'); ?></label>
            <input type="date" id="arr_from" name="arr_from" value="<?php echo e(request('arr_from')); ?>">
        </div>

        <div>
            <label for="arr_to"><?php echo e($en ? 'Arrival to' : 'Прибуття до'); ?></label>
            <input type="date" id="arr_to" name="arr_to" value="<?php echo e(request('arr_to')); ?>">
        </div>

        <div style="flex: 0 0 auto;">
            <button type="submit"><?php echo e($en ? 'Apply' : 'Застосувати'); ?></button>
            <a class="btn-reset" href="<?php echo e(route('flight.admin', ['lang' => $locale])); ?>"><?php echo e($en ? 'Reset' : 'Скинути'); ?></a>
        </div>
    </form>

    <table class="hotel-table">
        <thead>
        <tr>
            <th><a href="<?php echo e($sortUrl('id')); ?>">#<?php echo e($arrow('id')); ?></a></th>
            <th><a href="<?php echo e($sortUrl('route')); ?>"><?php echo e($en ? 'Route' : 'Маршрут'); ?><?php echo e($arrow('route')); ?></a></th>
            <th><?php echo e($en ? 'Aircraft' : 'Літак'); ?></th>
            <th><a href="<?php echo e($sortUrl('departure')); ?>"><?php echo e($en ? 'Departure' : 'Виліт'); ?><?php echo e($arrow('departure')); ?></a></th>
            <th><a href="<?php echo e($sortUrl('arrival')); ?>"><?php echo e($en ? 'Arrival' : 'Прибуття'); ?><?php echo e($arrow('arrival')); ?></a></th>
            <th><a href="<?php echo e($sortUrl('tariffs_count')); ?>"><?php echo e($en ? 'Tariffs' : 'Тарифи'); ?><?php echo e($arrow('tariffs_count')); ?></a></th>
            <th><a href="<?php echo e($sortUrl('min_price')); ?>"><?php echo e($en ? 'From' : 'Від'); ?><?php echo e($arrow('min_price')); ?></a></th>
            <th><?php echo e($en ? 'Actions' : 'Дії'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $translation = $flight->translations->where('locale', $locale)->first()
                    ?? $flight->translations->where('locale', 'uk')->first();
            ?>
            <tr>
                <td>
                    <a href="<?php echo e(route('flight.show', ['flight' => $flight, 'lang' => $locale])); ?>">
                        <?php echo e($flight->id); ?>

                    </a>
                </td>
                <td>
                    <?php echo e($translation?->departure_airport ?? $flight->departure_airport); ?>

                    →
                    <?php echo e($translation?->arrival_airport ?? $flight->arrival_airport); ?>

                </td>
                <td><?php echo e($translation?->aircraft_model ?? $flight->aircraft_model); ?></td>
                <td><?php echo e($flight->departure_date->format('d.m.Y')); ?> <?php echo e(substr($flight->departure_time, 0, 5)); ?></td>
                <td><?php echo e($flight->arrival_date->format('d.m.Y')); ?> <?php echo e(substr($flight->arrival_time, 0, 5)); ?></td>
                <td>
                    <?php echo e($flight->tariffs_count); ?>

                    <?php if($flight->tariffs_count): ?>
                        <small>(<?php echo e($flight->tariffs->pluck('name')->join(', ')); ?>)</small>
                    <?php endif; ?>
                </td>
                <td><?php echo e($flight->min_price !== null ? number_format($flight->min_price, 2, '.', ' ') : '—'); ?></td>
                <td>
                    <a href="<?php echo e(route('flight.edit', $flight)); ?>"><?php echo e($en ? 'Edit' : 'Редагувати'); ?></a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8"><?php echo e($en ? 'No flights found.' : 'Рейсів за вказаними умовами не знайдено.'); ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <?php echo e($flights->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/flight/admin.blade.php ENDPATH**/ ?>