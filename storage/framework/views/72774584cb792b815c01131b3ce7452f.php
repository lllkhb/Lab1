
<?php $__env->startSection('title', 'Дані прийнято'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Перевірка даних пасажира</h1>
    <p>Будь ласка, перевірте введені дані перед оплатою авіаквитка:</p>
    <ul>
        <li>
            <strong>Пасажир:</strong>
            <?php echo e(strtoupper($last_name)); ?> <?php echo e(strtoupper($first_name)); ?>

        </li>
        <li>
            <strong>Дата народження:</strong>
            <?php echo e($birth_date); ?>

        </li>
        <li>
            <strong>Громадянство:</strong>
            <?php echo e($citizenship); ?>

        </li>
        <li>
            <strong>Паспорт:</strong>
            <?php echo e(strtoupper($passport_number)); ?> (дійсний до <?php echo e($passport_expiry); ?>)
        </li>
        <li>
            <strong>Email для отримання квитка:</strong>
            <?php echo e($email); ?>

        </li>
        <li>
            <strong>Контактний телефон:</strong>
            <?php echo e($phone); ?>

        </li>
        <li>
            <strong>Обраний багаж:</strong>
            <?php if($baggage === 'hand_only'): ?>
                Тільки ручна поклажа (до 7 кг)
            <?php elseif($baggage === 'baggage_20kg'): ?>
                Зареєстрований багаж до 20 кг
            <?php elseif($baggage === 'baggage_32kg'): ?>
                Зареєстрований багаж до 32 кг
            <?php endif; ?>
        </li>
        <li>
            <strong>Коментар до замовлення:</strong>
            <?php echo e(!empty($comment) ? $comment : 'Немає додаткових побажань'); ?>

        </li>
    </ul>
    <div style="margin-top: 25px; display: flex; gap: 15px; align-items: center;">
        <form method="GET" action="<?php echo e(route('site.say', ['message' => 'Оплата пройшла успішно! Ваш авіаквиток надіслано на ' . $email])); ?>">
            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
                Перейти до оплати
            </button>
        </form>
    <p>
        <a href="<?php echo e(route('entry.form')); ?>">
            Повернутися до форми
        </a>
    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/site/entry-confirm.blade.php ENDPATH**/ ?>