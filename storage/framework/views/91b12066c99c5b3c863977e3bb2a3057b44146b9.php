

<?php $__env->startSection('plugins.Chartjs', true); ?>

<?php $__env->startSection('title', 'Painel'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="row">
        <div class="col-md-6">
            <h1>Dashboard</h1>
        </div>
        <div class="col-md-6">
            <form method="GET" class="float-md-right">
                <div class="form-group">
                    <label>Selecionar dia</label>
                    <select name="days" onchange="this.form.submit()" class="form-control">
                        <option <?php echo e($dateInterval===30?'selected="selected"':''); ?> value="30">Últimos 30 dias</option>
                        <option <?php echo e($dateInterval===60?'selected="selected"':''); ?> value="60">Últimos 2 meses</option>
                        <option <?php echo e($dateInterval===90?'selected="selected"':''); ?> value="90">Últimos 3 meses</option>
                        <option <?php echo e($dateInterval===120?'selected="selected"':''); ?> value="120">Últimos 6 meses</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e($visitsCount); ?></h3>
                    <p>Visitas</p>   
                </div>

                <div class="icon">
                    <i class="far fa-fw fa-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo e($onlineCount); ?></h3>
                    <p>Usuários Online</p>   
                </div>

                <div class="icon">
                    <i class="far fa-fw fa-heart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo e($pageCount); ?></h3>
                    <p>Páginas</p>   
                </div>

                <div class="icon">
                    <i class="far fa-fw fa-sticky-note"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo e($userCount); ?></h3>
                    <p>Usuários</p>   
                </div>

                <div class="icon">
                    <i class="far fa-fw fa-user"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Páginas mais visitadas</h3>
                </div>
                <div class="card-body">
                    <canvas id="pagePie"></canvas>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Sobre o sistema</h3>
                </div>
                <div class="card-body">
                    Informações sobre esta bosta

                </div>
            </div>
        </div>
    </div>

<script>
window.onload = function(){
    let ctx = document.getElementById('pagePie').getContext('2d');
    window.pagePie = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets:[{
                data:<?php echo e($pageValues); ?>,
                backgroundColor:'#00FF00'
            }],
            labels:<?php echo $pageLabels; ?>

        }, 
        options:{
            responsive:true,
            legend:{
                display:false
            }
        }
    });

}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\joaov\OneDrive\Área de Trabalho\laravel\LaravelPainel\resources\views/admin/home.blade.php ENDPATH**/ ?>