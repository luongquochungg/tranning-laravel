<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
/**
 * CRUD User controller
 */
class CrudUserController extends Controller
{

    /**
     * Login page
     */
    public function login()
    {
        return view('crud_user.login');
    }

    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

       $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('list')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    /**
     * Registration page
     */
    public function createUser()
    {
        return view('crud_user.create');
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        //kiem tra du lieu  dau vao
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'like' => 'require',
            'github' => 'require',

        ]);
        //Lay tat ca co so du lieu gan vao mang data
        $data = $request->all();

        $check = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'like' => $data['like'],
            'github' => $data['github'],

        ]);

        return redirect("login");
    }

    /**
     * View user detail page
     */
    public function readUser(Request $request) {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.read', ['user' => $user]);
    }

    /**
     * Delete user by id
     */
    public function deleteUser(Request $request) {
        $user_id = $request->get('id');

        $isDelete = false;
        //Check existing post
        $post = Posts::where('user_id', '=', $user_id)->first();

        //Check existing favorite
        $favorities = User::find($user_id)->favorities;

        if (empty ($post) && $favorities->isEmpty()) {
            $isDelete = true;
        }

        if ($isDelete) {
            $user = User::destroy($user_id);
            return redirect("list")->withSuccess('Delete successful');
        } else {
            return redirect("list")->withSuccess('Delete not ok');
        }

    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        //tim user theo id
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.update', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,id,'.$input['id'],
            'password' => 'required|min:6',
            'like' => 'require',
            'github' => 'require',
        ]);



       $user = User::find($input['id']);
       $user->name = $input['name'];
       $user->email = $input['email'];
       $user->password = $input['password'];
       $user->like = $input['like'];
       $user->github = $input['github'];
        $user->update();

        return redirect("list")->withSuccess('You have signed-in');
    }

    /**
     * List of users
     */
    public function listUser()
    {
        if(Auth::check()){
            // $users = User::all();//Lay tat ca du lieu trong ban user
            $users = User::paginate(10);
            return view('crud_user.list', ['users' => $users]);//->with('i',(request()->input('page',1)-1)*2);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Sign out
     */
    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
