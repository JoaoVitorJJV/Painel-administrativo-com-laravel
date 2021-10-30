

<?php $__env->startSection('title', 'Nova página'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Adicionar página</h1>
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
        <div class="card-header">
            <h3>Inserir usuários no banco</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('page.store')); ?>" method="POST" class="form-horizontal">
                <?php echo csrf_field(); ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Corpo</label>
                    <div class="col-sm-10">
                        <textarea name="body" class="form-control bodyfield"><?php echo e(old('body')); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Criar" class="btn btn-success"/>
                    </div>
                </div>
            </form>
        </div>

    </div>
<script src="https://cdn.tiny.cloud/1/2o1iidyvw1zh6bvxaj409hjg35i6d84mgzto3awxgu42uz45/tinymce/5/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector:'textarea.bodyfield',
        height:300,
        menubar:false,
        plugins:['link', 'table', 'image', 'autoresize', 'list'],
        toolbar:'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | table | link image | bullist numlist',
        content:['<?php echo e(asset('assets/css/content.css')); ?>'],
        images_upload_url:'<?php echo e(route('imageupload')); ?>',
        images_upload_credentials:true,
        convert_urls:false
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\joaov\OneDrive\Área de Trabalho\laravel\LaravelPainel\resources\views/admin/pages/create.blade.php ENDPATH**/ ?>