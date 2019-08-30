<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use function Symfony\Component\VarDumper\Tests\Fixtures\bar;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['show', 'create', 'store', 'index']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    // 用户列表
    public function index()
    {
        $users = User::query()->paginate(10);
        return view('users.index', compact('users'));
    }
    // 用户注册
    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {

        return view('users.show', compact('user'));
    }
    // 用户注册
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::query()->create([
           'name' => $request->name,
           'email' => $request->email,
            'password' => bcrypt("$request->password"),
        ]);

        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }

    // 个人中心
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    // 用户更新
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);//为当前用户授权给定的操作。
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $date = [];
        $date['name'] = $request->name;
        if($request->password){
            $date['password'] = bcrypt($request->password);
        }
        $user->update($date);
        session()->flash('success', '个人资料更新成功！');
        return redirect()->route('users.show', $user);
    }

    // 删除用户
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }
}
