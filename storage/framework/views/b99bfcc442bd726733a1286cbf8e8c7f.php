
<?php $__env->startSection('title', 'Дані пасажира'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Оформлення авіаквитка</h1>
    <p>Будь ласка, заповніть дані пасажира латиницею</p>
    <form method="POST" action="<?php echo e(route('entry.store')); ?>">
        <?php echo csrf_field(); ?>
        <fieldset style="margin-bottom: 20px; padding: 15px;">
            <legend><strong>Особисті дані пасажира</strong></legend>

            <div style="margin-bottom: 12px;">
                <label for="last_name">Прізвище</label><br>
                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    placeholder="Наприклад: SYDORUK"
                    value="<?php echo e(old('last_name')); ?>"
                >
                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="error" style="color: red; margin: 4px 0;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 12px;">
                <label for="first_name">Ім'я</label><br>
                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    placeholder="Наприклад: OLHA"
                    value="<?php echo e(old('first_name')); ?>"
                >
                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="error" style="color: red; margin: 4px 0;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 12px;">
                <label for="birth_date">Дата народження</label><br>
                <input
                    type="date"
                    id="birth_date"
                    name="birth_date"
                    value="<?php echo e(old('birth_date')); ?>"
                >
                <?php $__errorArgs = ['birth_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="error" style="color: red; margin: 4px 0;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </fieldset>

        <fieldset style="margin-bottom: 20px; padding: 15px;">
            <legend><strong>Паспортні дані</strong></legend>

            <div style="margin-bottom: 12px;">
                <label for="citizenship">Громадянство</label><br>
                <select id="citizenship" name="citizenship">
                    <option value="">-- Оберіть країну --</option>
                    <option value="Україна" <?php echo e(old('citizenship') == 'Україна' ? 'selected' : ''); ?>>Україна</option>
                    <option value="Польща" <?php echo e(old('citizenship') == 'Польща' ? 'selected' : ''); ?>>Польща</option>
                    <option value="Німеччина" <?php echo e(old('citizenship') == 'Німеччина' ? 'selected' : ''); ?>>Німеччина</option>
                    <option value="США" <?php echo e(old('citizenship') == 'США' ? 'selected' : ''); ?>>США</option>
                    <option value="Інше" <?php echo e(old('citizenship') == 'Інше' ? 'selected' : ''); ?>>Інша країна</option>
                </select>
                <?php $__errorArgs = ['citizenship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="error" style="color: red; margin: 4px 0;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 12px;">
                <label for="passport_number">Серія та номер паспорта</label><br>
                <input
                    type="text"
                    id="passport_number"
                    name="passport_number"
                    placeholder="Наприклад: FE123456"
                    value="<?php echo e(old('passport_number')); ?>"
                >
                <?php $__errorArgs = ['passport_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="error" style="color: red; margin: 4px 0;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 12px;">
                <label for="passport_expiry">Термін дії паспорта</label><br>
                <input
                    type="date"
                    id="passport_expiry"
                    name="passport_expiry"
                    value="<?php echo e(old('passport_expiry')); ?>"
                >
                <?php $__errorArgs = ['passport_expiry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="error" style="color: red; margin: 4px 0;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </fieldset>

        <fieldset style="margin-bottom: 20px; padding: 15px;">
            <legend><strong>Контактні дані та багаж</strong></legend>

            <div style="margin-bottom: 12px;">
                <label for="email">Email</label><br>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="passenger@example.com"
                    value="<?php echo e(old('email')); ?>"
                >
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="error" style="color: red; margin: 4px 0;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 12px;">
                <label for="phone">Номер телефону</label><br>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="+380 99 123 45 67"
                    value="<?php echo e(old('phone')); ?>"
                >
                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="error" style="color: red; margin: 4px 0;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 12px;">
                <label for="baggage">Оберіть норму багажу</label><br>
                <select id="baggage" name="baggage">
                    <option value="hand_only" <?php echo e(old('baggage') == 'hand_only' ? 'selected' : ''); ?>>
                        Тільки ручна поклажа (до 7 кг) — Безкоштовно
                    </option>
                    <option value="baggage_20kg" <?php echo e(old('baggage') == 'baggage_20kg' ? 'selected' : ''); ?>>
                        Зареєстрований багаж до 20 кг (+1200 грн)
                    </option>
                    <option value="baggage_32kg" <?php echo e(old('baggage') == 'baggage_32kg' ? 'selected' : ''); ?>>
                        Зареєстрований багаж до 32 кг (+2000 грн)
                    </option>
                </select>
                <?php $__errorArgs = ['baggage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="error" style="color: red; margin: 4px 0;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div style="margin-bottom: 12px;">
                <label for="comment">Коментар або додаткові побажання</label><br>
                <textarea
                    id="comment"
                    name="comment"
                    rows="4"
                    cols="50"
                    placeholder="Наприклад: місце біля вікна, переліт із домашньою твариною..."
                ><?php echo e(old('comment')); ?></textarea>
                <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="error" style="color: red; margin: 4px 0;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </fieldset>
        <button type="submit">Надіслати</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/site/entry.blade.php ENDPATH**/ ?>