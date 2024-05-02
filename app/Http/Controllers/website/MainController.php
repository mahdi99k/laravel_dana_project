<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {
        
    }

    public function home(){
        return view('home');
    }
}
