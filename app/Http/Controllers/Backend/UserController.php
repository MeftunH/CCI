<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function updateProfileImage(Request $request)
    {

        $user = Auth::user();
        if ($request->ajax()) {
            $data = $request->file('file');
            $image_uni = uniqid('avatar', true) . '.' . $data->getClientOriginalExtension();
            if (File::exists($user->photo)) {
                unlink($user->photo);
            }
        }
        Image::make($data)->save('storage/public/images/avatar/' . $image_uni);
        $user->photo = '/storage/public/images/avatar/' . $image_uni;
        $user->save();

        return response()->json([
            'success' => 'done',

        ]);
    }
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->get();
        return view('admin.users.index',compact('data'));
    }
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.users.edit',compact('user','roles','userRole'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }
    public function destroy($id)
    {
        $user = User::find($id);

            if (File::exists($user->photo)) {
                unlink($user->photo);
            }

        $user->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
