@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-body">
                <div class="panel panel-default">
		    <div class="panel-heading">
			<h3 style="text-align:center;width:100%;">Randomizer Aktor/Aktris Indonesia</h3>
		    </div>
		    <div class="panel-body">
		      <div class="row">
			<div class="col-md-12">
			  <div style="width:100%; text-align:center;margin-bottom:20px;">
			    <img id="aktor" style="text-align:center;height:240px;" src="/img/sinefil/random.png" />
			  </div>
			</div> 
		      </div>
		
		      <div class="row">
                        <div class="col-md-12">
                          <div style="width:100%; text-align:center;margin-bottom:20px;">
                            <span id="namaaktor"></span>
                            <br/>
                          </div>
                        </div>
                      </div>

		      <div class="form-group row">
			<div class="col-md-2 col-md-offset-5">
			  <input type="button" class="form-control" style="background-color:green;color:white;" id="randomizer" value="Random!" />
			</div>
		      </div>
		    </div>
                    <!--<div class="panel-heading">Search Movies</div>
                    <div class="panel-body">
                        <div class="form-group row">
                          <div class="col-md-8">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search Movie Title" />
                          </div>
                          <div class="col-md-4">
                            <input type="button" name="searchbutton" id="searchbutton" class="form-control" value="Search" />
                          </div>
                        </div>
                        <div class="table-responsive">
                            <table id="movielist" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-md-8">Movie Title</th>
                                        <th class="col-md-4">Language</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>    -->
                </div>
	    </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
 
 $('#namaaktor').text("Siapa yaa~");

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

 var query = $("#search").val();

 var table = $('#movielist').DataTable({
        ajax: {
	    url: '{!! route('live_search.action') !!}',
	    type: 'GET',
	    data:{query:query},
	    dataType:'json'
	},
        'processing': true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>'
        }                
    });

 // $(document).on('keyup', '#search', function(){
 //  var query = $(this).val();
 //  fetch_customer_data(query);
 // });

 $("#searchbutton").click( function(){
             //var query = $("#search").val();
             fetch_customer_data(query);
 });

 $("#randomizer").click( function(){

	if($("#randomizer").val() == "Random!") {
		$('#namaaktor').text("Acak-acak...");
		$("#aktor").prop('src','/img/sinefil/sinefil.gif');
		$("#randomizer").prop('value','Stop!');
		$("#randomizer").prop('style','background-color:red;color:white;');
	}
	else {
		$.ajax({
		   url:"{{ route('aktor.random') }}",
		   method:'GET',
   		   dataType:'json',
		   success:function(data)
		   {
		    $("#aktor").prop('src','/img/sinefil/'+data.id+'.jpg');
		    $('#namaaktor').text(data.name);
  		   }
		});
		$("#randomizer").prop('value','Random!');
		$("#randomizer").prop('style','background-color:green;color:white;');
	}
 });

 $("#search").keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    //var query = $("#search").val();
    fetch_customer_data(query);
  }
});   
});
</script>
@endsection
