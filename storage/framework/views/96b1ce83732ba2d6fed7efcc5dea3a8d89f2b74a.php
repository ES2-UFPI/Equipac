<?php $__env->startSection('title', 'Equipac Bolsista'); ?>
<?php $__env->startSection('content'); ?>
<h1><?php echo e(auth()->user()->nome); ?></h1>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DESENVOLVIMENTO\COMPUTACAO\Equipac\resources\views/bolsista.blade.php ENDPATH**/ ?>