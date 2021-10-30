

<?php $__env->startSection('title', 'Páginas'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>
       Páginas
        <a href="<?php echo e(route('page.create')); ?>" class="btn btn-sm btn-success">+ Nova</a>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('warning')): ?>
        <div class="alert alert-success alert-dismissible">
            <h6>
                <i class="icon fas fa-check"></i>
                <?php echo e(session('warning')); ?>

            </h6>
        </div>
    <?php endif; ?>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <tr>
                <thead>
                    <th width="50">ID</th>
                    <th>Nome</th>
                    <th width="200">Ações</th>
                </thead>
            </tr>
            <tbody>
                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($page->id); ?></td>
                        <td><?php echo e($page->title); ?></td>
                        <td>
                            <a href="" target="_blank" class="btn btn-success btn-sm">Ver</a>
                            <a href="<?php echo e(route('page.edit', ['page'=>$page->id])); ?>" class="btn btn-info btn-sm">Editar</a>
                            <form method="POST" action="<?php echo e(route('page.destroy', ['page'=>$page->id])); ?>" class="d-inline" onsubmit="return confirm('Tem certeza, mano?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

</div>
<?php echo e($pages->links('pagination::bootstrap-4')); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\joaov\OneDrive\Área de Trabalho\laravel\LaravelPainel\resources\views/admin/pages/index.blade.php ENDPATH**/ ?>