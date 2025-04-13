<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasSortableOrder;
use App\Http\Controllers\Traits\HasToggleActivity;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    use HasToggleActivity, HasSortableOrder;

    public function index()
    {
        return view('user.index', ['users' => User::orderBy('order')->get()]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(StoreRequest $request)
    {
        User::create($request->prepareDataForCreation());

        return redirect()->route('users.index')->with('success', 'Пользователь добавлен');
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->prepareDataForUpdate());

        return redirect()->route('users.edit', $user->id)->with('success', 'Пользователь обновлен');
    }

    /**
     * @return class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected function getModelClass(): string
    {
        return User::class;
    }

    /**
     * @return string
     */
    protected function getRouteKey(): string
    {
        return 'user';
    }
}
