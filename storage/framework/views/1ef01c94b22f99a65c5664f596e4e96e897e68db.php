<?php $__env->startSection('content'); ?>


<?php if(session('success')): ?>
<div class="alert alert-success">
  <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="alert alert-danger">
  <?php echo e(session('error')); ?>

</div>
<?php endif; ?>
<!-- /.card-header -->
<!-- form start -->
<div class="row" class="container-fluid">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Equipamento cadastrados</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <tr>
            <th>Id</th>
            <th>Id</th>
            <th>nome</th>
          </tr>
          <?php $__currentLoopData = $manutencao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php $e = $ma::find($manutencao[$index]->id)->equipamento; ?>
          <?php $__currentLoopData = $e; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php $a = $equip::find($equipamento->id)->usuario;?>
          <tr>
            <th><?php echo e($ma['id']); ?></th>
            <th><?php echo e($a->id); ?></th>
            <td><?php echo e($a->nome); ?></td>
         </tr>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </table>
     </div>
     <!-- /.card-body -->
   </div>
   <!-- /.card -->
 </div>
 <!-- /.row -->

 <?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DESENVOLVIMENTO\COMPUTACAO\Equipac\resources\views/bolsista/manutencao.blade.php ENDPATH**/ ?>