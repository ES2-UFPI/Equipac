<?php $__env->startSection('content'); ?>
 <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" role="form" action="<?php echo e(route('chamado.store')); ?>">
                <?php echo csrf_field(); ?>

                  <div class="card-body">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Informe o problema</label>
                        <textarea name="descricao" id="descricacao" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DESENVOLVIMENTO\COMPUTACAO\Equipac\resources\views/usuarios/chamados.blade.php ENDPATH**/ ?>