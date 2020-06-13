@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-heading">Search Movies</div>
                    <div class="panel-body">
                        <div class="form-group row">
                          <div class="col-md-8">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search Movie Title" />
                          </div>
                          <div class="col-md-4">
                            <input type="button" name="searchbutton" id="searchbutton" class="form-control" placeholder="Search">Search</input>
                          </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Movie Title</th>
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
   url:"{{ route('live_search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    // $('#total_records').text(data.total_data);
   }
  })
 }

 // $(document).on('keyup', '#search', function(){
 //  var query = $(this).val();
 //  fetch_customer_data(query);
 // });

 $("#searchbutton").click( function(){
             var query = $("#search").val();
             fetch_customer_data(query);
 });

 $("#search").keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    var query = $("#search").val();
    fetch_customer_data(query);
  }
});   
});
</script>
@endsection
