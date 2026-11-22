<?php
    $enTranslation = isset($flight) ? $flight->translations->firstWhere('locale', 'en') : null;
?>

<fieldset style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc;">
    <legend><strong>Основна мова (Українська — обов'язково)</strong></legend>
    <div>
        <label for="departure_airport">Аеропорт вильоту (UK)</label>
        <input id="departure_airport" name="departure_airport" type="text" maxlength="150"
               placeholder="Наприклад: Бориспіль"
               value="<?php echo e(old('departure_airport', $flight->departure_airport ?? '')); ?>">
        <?php $__errorArgs = ['departure_airport'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="error" style="color: red;"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
        <label for="arrival_airport">Аеропорт прибуття (UK)</label>
        <input id="arrival_airport" name="arrival_airport" type="text" maxlength="150"
               placeholder="Наприклад: Шопен"
               value="<?php echo e(old('arrival_airport', $flight->arrival_airport ?? '')); ?>">
        <?php $__errorArgs = ['arrival_airport'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="error" style="color: red;"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
        <label for="aircraft_model">Модель літака (UK)</label>
        <input id="aircraft_model" name="aircraft_model" type="text" maxlength="100"
               placeholder="Наприклад: Боїнг 737-800"
               value="<?php echo e(old('aircraft_model', $flight->aircraft_model ?? '')); ?>">
        <?php $__errorArgs = ['aircraft_model'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="error" style="color: red;"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</fieldset>

<fieldset style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc;">
    <legend><strong>Англійський переклад (EN — необов'язково)</strong></legend>
    <div>
        <label for="departure_airport_en">Departure Airport (EN)</label>
        <input id="departure_airport_en" name="departure_airport_en" type="text" maxlength="150"
               placeholder="Наприклад: Boryspil"
               value="<?php echo e(old('departure_airport_en', $enTranslation->departure_airport ?? '')); ?>">
        <?php $__errorArgs = ['departure_airport_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="error" style="color: red;"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
        <label for="arrival_airport_en">Arrival Airport (EN)</label>
        <input id="arrival_airport_en" name="arrival_airport_en" type="text" maxlength="150"
               placeholder="Наприклад: Chopin"
               value="<?php echo e(old('arrival_airport_en', $enTranslation->arrival_airport ?? '')); ?>">
        <?php $__errorArgs = ['arrival_airport_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="error" style="color: red;"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
        <label for="aircraft_model_en">Aircraft Model (EN)</label>
        <input id="aircraft_model_en" name="aircraft_model_en" type="text" maxlength="100"
               placeholder="Наприклад: Boeing 737-800"
               value="<?php echo e(old('aircraft_model_en', $enTranslation->aircraft_model ?? '')); ?>">
        <?php $__errorArgs = ['aircraft_model_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="error" style="color: red;"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</fieldset>

<div>
    <label for="departure_date">Дата вильоту</label>
    <input id="departure_date" name="departure_date" type="date"
           value="<?php echo e(old('departure_date', isset($flight) ? $flight->departure_date->format('Y-m-d') : '')); ?>">
    <?php $__errorArgs = ['departure_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="error" style="color: red;"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div>
    <label for="departure_time">Час вильоту</label>
    <input id="departure_time" name="departure_time" type="time"
           value="<?php echo e(old('departure_time', isset($flight) ? substr($flight->departure_time, 0, 5) : '')); ?>">
    <?php $__errorArgs = ['departure_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="error" style="color: red;"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div>
    <label for="arrival_date">Дата прибуття</label>
    <input id="arrival_date" name="arrival_date" type="date"
           value="<?php echo e(old('arrival_date', isset($flight) ? $flight->arrival_date->format('Y-m-d') : '')); ?>">
    <?php $__errorArgs = ['arrival_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="error" style="color: red;"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div>
    <label for="arrival_time">Час прибуття</label>
    <input id="arrival_time" name="arrival_time" type="time"
           value="<?php echo e(old('arrival_time', isset($flight) ? substr($flight->arrival_time, 0, 5) : '')); ?>">
    <?php $__errorArgs = ['arrival_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="error" style="color: red;"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php
    $selectedTariffs = old('tariffs', isset($flight) ? $flight->tariffs->pluck('id')->all() : []);
    $priceValues = old('prices', isset($flight)
        ? $flight->tariffs->mapWithKeys(fn ($t) => [$t->id => $t->pivot->price])->all()
        : []);
?>

<div style="margin: 15px 0;">
    <label for="tariffs"><strong>Тарифи рейсу</strong></label><br>
    <select id="tariffs" name="tariffs[]" multiple style="width:100%; max-width:500px;">
        <?php $__currentLoopData = $tariffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tariff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($tariff->id); ?>" <?php if(in_array($tariff->id, $selectedTariffs)): echo 'selected'; endif; ?>>
                <?php echo e($tariff->name); ?> (<?php echo e($tariff->class_name); ?>, <?php echo e($tariff->baggage); ?>)
            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <?php $__currentLoopData = $errors->get('tariffs.*'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p class="error" style="color: red;"><?php echo e($message); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $errors->get('prices.*'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p class="error" style="color: red;"><?php echo e($message); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div id="price-fields" style="margin-top: 10px;"></div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const prices = <?php echo json_encode((object) $priceValues, 15, 512) ?>;
            const $select = $('#tariffs').select2({ placeholder: 'Оберіть тарифи', closeOnSelect: false });

            function renderPrices() {
                const $box = $('#price-fields').empty();
                $select.find('option:selected').each(function () {
                    const id = this.value;
                    const name = $(this).text().trim().split(' (')[0];
                    const $label = $('<label style="display:block; margin-bottom:6px;"></label>')
                        .text('Ціна для «' + name + '», грн: ');
                    const $input = $('<input type="number" step="0.01" min="0" required>')
                        .attr('name', 'prices[' + id + ']')
                        .val(prices[id] ?? '');
                    $box.append($label.append($input));
                });
            }

            $select.on('change', function () {
                $('#price-fields input').each(function () {
                    const m = this.name.match(/\[(\d+)\]/);
                    if (m) prices[m[1]] = this.value;
                });
                renderPrices();
            });

            renderPrices();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\ПК\referenceapp\resources\views/flight/_form.blade.php ENDPATH**/ ?>