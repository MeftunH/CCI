<?php

namespace App\Http\Controllers\Bakcend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
      $users = User::all();
        return view('admin.users',compact('users'));
    }
}
