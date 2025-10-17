<?php
namespace App\Http\Controllers;

use App\Models\Recurso;

class RecursoController extends Controller
{
    public function index(){
        $recursos = Recurso::orderBy('created_at','desc')->get();
        return view('recursos', compact('recursos'));
    }
}
