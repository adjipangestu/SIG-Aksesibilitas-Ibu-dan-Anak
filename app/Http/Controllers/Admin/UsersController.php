<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use App\User;
use App\Role;
use App\RoleUser;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    
    public function index()
    {
        return view('admin.user.index');
    }

    public function listUser()
    {
        $data = User::orderBy('id', 'DESC')
                ->get();

        return Datatables::of($data)
                ->addColumn('role', function ($data) {
                    return $data->role->description;
                })
                ->addColumn('action', function ($data) {
                    return  '<a href="'.route('admin.user.edit', ['id' => $data->id]).'" class="btn btn-xs btn-success mr-10">Edit</a>'. 
                            '<a href="'.route('admin.user.reset_pw', ['id' => $data->id]).'" class="btn btn-xs btn-info mr-10 reset-pw">Reset PW</a>'.
                            '<a href="'.route('admin.user.delete', ['id' => $data->id]).'" class="btn btn-xs btn-danger deleted">Hapus</a>';
                })
                ->addIndexColumn()
                ->make(true);
    }

    public function add()
    {
        $role = Role::all();
        return view('admin.user.add', ['role' => $role]);
    }

    public function addDo(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:4'],
            'role_id' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $request->role_id
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $role = Role::all();
        $user = User::findOrFail($id);
        return view('admin.user.edit', ['role' => $role, 'user' => $user]);
    }

    public function editDo(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'role_id' => 'required'
        ]);

        $user =  User::find($id);
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->save();

        $role = RoleUser::where('user_id', $id)->first();
        $role->role_id = $request->role_id;
        $role->save();

        return redirect()->route('admin.user.index')->with('success', 'Password berhasil diedit!');
    }

    public function resetPw($id)
    {
        $user =  User::find($id);
        $user->password = Hash::make('123456');
        $user->save();
        return redirect()->route('admin.user.index')->with('success', 'Password berhasil direset!');
    }

    public function delete($id)
    {
        User::destroy($id);
        RoleUser::where('user_id', $id)->delete();
        return redirect()->route('admin.user.index')->with('success', 'Data berhasil dihapus!');
    }
}
