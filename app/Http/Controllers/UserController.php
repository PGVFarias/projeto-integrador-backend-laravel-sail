<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('user.index')->with(compact('users'));
    }

    public function changeState(User $user)
    {
        $user->update([ 'is_active' => !$user->is_active ]);

        return redirect(route('user.index'));
    }
}
