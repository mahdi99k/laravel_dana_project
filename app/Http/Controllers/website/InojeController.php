<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InojeController extends Controller
{
    public function landing()
    {
        return view('inoje.landing');
    }
    public function index()
    {
        $inoje = all();
        $data = [
            "projects" => $inoje
        ];
        return view("inoje.index",$data);
    }
    public function show($slug)
    {   
        dd(User::all());
        return "welcome to show {$slug}";
    }
}
