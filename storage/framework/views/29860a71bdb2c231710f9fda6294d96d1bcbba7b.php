

<?php $__env->startSection('title', $page['title']); ?>

<?php $__env->startSection('content'); ?>
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3><?php echo e($page['title']); ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <?php echo $page['body']; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\joaov\OneDrive\Área de Trabalho\laravel\LaravelPainel\resources\views/site/page.blade.php ENDPATH**/ ?>