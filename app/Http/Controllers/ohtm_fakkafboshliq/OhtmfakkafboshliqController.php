<?php

namespace App\Http\Controllers\ohtm_fakkafboshliq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OhtmfakkafboshliqController extends Controller
{
    public function index(){
        return view('mv_admin.home');
    }
}
