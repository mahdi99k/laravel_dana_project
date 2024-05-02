<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InoventController extends Controller
{
    public function landing()
    {
        return "welcome to landing";
    }
    public function index()
    {
        return "welcome to index";
    }
    public function show($slug)
    {
        return "welcome to show {$slug}";
    }
}
