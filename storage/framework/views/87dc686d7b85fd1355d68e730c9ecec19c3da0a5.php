<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <h3 align="center">Live search in laravel using AJAX</h3><br />
                <div class="panel panel-default">
                    <div class="panel-heading">Search Movies</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search Movie Title" />
                        </div>
                        <div class="table-responsive">
                            <h3 align="center">Total Data: <span id="total_records"></span></h3>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Movie Title</th>
                                        <th>Popularity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>    
                </div>
	    </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"<?php echo e(route('live_search.action')); ?>",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>