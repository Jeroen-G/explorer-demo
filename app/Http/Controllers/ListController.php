<?php

namespace App\Http\Controllers;

use App\Models\Cartographer;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __invoke(Request $request)
   {
       $people = Cartographer::search()->paginate();

       return view('list', [
           'people' => $people,
       ]);
   }
}
