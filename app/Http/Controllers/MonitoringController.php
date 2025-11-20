<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use function view; 

class MonitoringController extends Controller
{
    public function index() {
        return view ('Login');
    }
    
}
