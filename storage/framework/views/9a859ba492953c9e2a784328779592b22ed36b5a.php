

<?php $__env->startSection('title', 'Usuários'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>
        Meus usuários
        <a href="<?php echo e(route('user.create')); ?>" class="btn btn-sm btn-success">+ Novo</a>
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
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </thead>
            </tr>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->id); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <a href="<?php echo e(route('user.edit', ['user'=>$user->id])); ?>" class="btn btn-info btn-sm">Editar</a>
                            <?php if($loggedId !== intval($user->id)): ?>
                                <form method="POST" action="<?php echo e(route('user.destroy', ['user'=>$user->id])); ?>" class="d-inline" onsubmit="return confirm('Tem certeza, mano?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            <?php endif; ?>
                            <?php if($loggedId !== intval($user->id)): ?>
                                <?php if($user->admin === 0): ?>
                                    <a class="btn btn-warning btn-sm" href="<?php echo e(route('user.define.admin', ['user'=>$user->id])); ?>">Definir Admin</a>
                                <?php endif; ?>    
                            <?php endif; ?>
                            <?php if($loggedId !== intval($user->id)): ?>
                                <?php if($user->admin === 1): ?>
                                    <a class="btn btn-danger btn-sm" href="<?php echo e(route('user.remove.admin', ['user'=>$user->id])); ?>">Remover Admin</a>
                                <?php endif; ?>    
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

</div>
<?php echo e($users->links('pagination::bootstrap-4')); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\joaov\OneDrive\Área de Trabalho\laravel\LaravelPainel\resources\views/admin/users/index.blade.php ENDPATH**/ ?>