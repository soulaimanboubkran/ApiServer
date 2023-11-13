<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index(){
        $cars = Cars::all();
        return response($cars) ;
    }
    public function store(Request $request){
        $validated = $request->validate( [
          "name"=>"required",
            "founded"=>"required",
            "desc"=>"required"
        ]
            
        );
        $cars =  Cars::create($validated);
        return response($cars);

    }

}
