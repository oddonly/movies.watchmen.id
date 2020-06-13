<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearch extends Controller
{
    function index()
    {
     return view('home');
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
         $data = DB::table('movies')
         ->where('original_title', 'like', '%'.$query.'%')
	       ->orderBy('original_title', 'desc')
         ->limit(50)
         ->get();
      }
      else
      {
        $data = {};
       // $data = DB::table('movies')
       //   ->orderBy('original_title', 'desc')
       //   ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $response = file_get_contents('https://api.themoviedb.org/3/movie/'.$row->id.'?api_key=5ceae4569433f08a9592db47e9ffd1cf');
        $response = json_decode($response);
        
        $output .= '
        <tr>
         <td class="col-md-8">'.$row->original_title.'</td>
         <td class="col-md-4">'.$response->original_language.'</td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}
