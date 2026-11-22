
<?php $__env->startSection('title', 'Адміністрування блогу'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Адміністрування блогу</h1>
    <p>
        <a href="<?php echo e(route('blog.create')); ?>">
            Додати запис
        </a>
    </p>
    <form method="GET" action="<?php echo e(route('blog.admin')); ?>">
        <label for="title">Заголовок</label>
        <input
            type="text"
            id="title"
            name="title"
            value="<?php echo e(request('title')); ?>"
            placeholder="Пошук за заголовком"
        >
        <label for="categoryName">Назва категорії</label>
        <input
            type="text"
            id="categoryName"
            name="categoryName"
            value="<?php echo e(request('categoryName')); ?>"
            placeholder="Назва категорії">
        <label for="category_id">Категорія</label>
        <select id="category_id" name="category_id">
            <option value="">Усі категорії</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                    value="<?php echo e($id); ?>"
                    <?php if(request('category_id') == $id): echo 'selected'; endif; ?>
                >
                    <?php echo e($name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <label for="filter_id">Мітка</label>
        <select id="filter_id" name="filter_id">
            <option value="">Усі мітки</option>
            <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                    value="<?php echo e($id); ?>"
                    <?php if(request('filter_id') == $id): echo 'selected'; endif; ?>
                >
                    <?php echo e($name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <input type="hidden" name="sort" value="<?php echo e(request('sort')); ?>">
        <button type="submit">
            Застосувати
        </button>
        <a href="<?php echo e(route('blog.admin')); ?>">
            Скинути фільтри
        </a>
    </form>
        <table>
        <thead>
        <tr>
            <th>№</th>
            <?php
                $currentSort = request('sort');
                $titleSort = $currentSort === 'title'
                ? '-title'
                : 'title';
                $nextSort = $currentSort === 'categoryName'
                ? '-categoryName'
                : 'categoryName';
                $dateSort = $currentSort === 'created'
                ? '-created'
                : 'created';
            ?>
            <th>
                <a href="<?php echo e(route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $titleSort]))); ?>" style="color: inherit; text-decoration: none;">
                    Заголовок
                    <?php if($currentSort === 'title'): ?>
                        ↑
                    <?php elseif($currentSort === '-title'): ?>
                        ↓
                    <?php endif; ?>
                </a>
            </th>
            <th>
                <a href="<?php echo e(route('blog.admin', array_merge(
                request()->except('sort', 'page'),
                ['sort' => $nextSort]
                ))); ?>">
                    Категорія
                    <?php if($currentSort === 'categoryName'): ?>
                        ↑
                    <?php elseif($currentSort === '-categoryName'): ?>
                        ↓
                    <?php endif; ?>
                </a>
            </th>
            <th>Мітки</th>
            <th>
                <a href="<?php echo e(route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $dateSort]))); ?>" style="color: inherit; text-decoration: none;">
                    Дата
                    <?php if($currentSort === 'created'): ?> ↑ <?php elseif($currentSort === '-created'): ?> ↓ <?php endif; ?>
                </a>
            </th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($blogs->firstItem() + $i); ?></td>
                <td>
                    <a href="<?php echo e(route('blog.show', $blog)); ?>">
                        <?php echo e($blog->title); ?>

                    </a>
                </td>
                <td>
                    <?php echo e($blog->category?->category_name ?? '—'); ?>

                </td>
                <td>
                    <?php $__empty_2 = true; $__currentLoopData = $blog->filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                        <span class="tag">
                        <?php echo e($filter->filter_name); ?>

                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                        —
                    <?php endif; ?>
                </td>
                <td><?php echo e($blog->dt_created->format('d.m.Y')); ?>

                </td>
                <td>
                    <a href="<?php echo e(route('blog.edit', $blog)); ?>">
                        Редагувати
                    </a>
                    <form method="POST"
                          action="<?php echo e(route('blog.destroy', $blog)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit">Видалити</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5">Записів немає.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($blogs->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ПК\referenceapp\resources\views/blog/admin.blade.php ENDPATH**/ ?>