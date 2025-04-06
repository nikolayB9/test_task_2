<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', ['users' => User::all()]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => $data['password'],
            'order' => User::max('order') + 1,
        ]);
        return redirect()->route('users.index')->with('success', 'Пользователь добавлен');
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $data['is_active'] = !empty($data['is_active']);
        $user->update($data);
        return redirect()->route('users.edit', $user->id)->with('success', 'Пользователь обновлен');
    }
}
