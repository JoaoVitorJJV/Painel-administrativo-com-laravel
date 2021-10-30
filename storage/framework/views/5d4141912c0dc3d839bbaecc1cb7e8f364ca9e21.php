

<?php $__env->startSection('title', 'Configurações'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Configurações</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <h5>
                    <i class="icon fas fa-ban"></i>
                    Oooops! Algo de errado não está certo.
                </h5>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
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
            <form action="<?php echo e(route('settings.save')); ?>" method="POST" class="form-horizontal">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Titulo do site </label>
                    <div class="col-sm-10">
                        <input type="text" name="title" value="<?php echo e($settings['title']); ?>" class="form-control"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sub-titulo do site </label>
                    <div class="col-sm-10">
                        <input type="text" name="subtitle" value="<?php echo e($settings['subtitle']); ?>" class="form-control"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">E-mail para contato</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="<?php echo e($settings['email']); ?>" class="form-control"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor de fundo</label>
                    <div class="col-sm-10">
                        <input type="color" name="bgcolor" value="<?php echo e($settings['bgcolor']); ?>" class="form-control" style="width:70px"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor do texto</label>
                    <div class="col-sm-10">
                        <input type="color" name="textcolor" value="<?php echo e($settings['textcolor']); ?>" class="form-control" style="width:70px"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit"  value="Salvar" class="btn btn-success"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\joaov\OneDrive\Área de Trabalho\laravel\LaravelPainel\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>