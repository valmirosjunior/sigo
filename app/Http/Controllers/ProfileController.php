<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = new User();
        $user = $user->read(Auth::user()->id);
        return view('profile', ['user' => $user]);
    }
}
