<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupStoreRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $groups = Group::all();

        return view('group.index')->with(compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('group.create', ['users' => User::users()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupStoreRequest $request)
    {
        $newGroup = Group::create($request->except('users'));
        if($request->input('users')) {
            $newGroup->users()->sync($request->only('users')['users']);
        }

        return redirect(route('groups.index'))->with('message', 'Sucesso! O grupo foi criado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('group.edit', ['group' => Group::findOrFail($id), 'users' => User::users()->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupStoreRequest $request, string $id)
    {
        $group = Group::findOrFail($id);
        $group->update($request->except('users'));
        if($request->input('users')) {
            $group->users()->sync($request->only('users')['users']);
        }

        return redirect(route('groups.index'))->with('message', 'Sucesso! O grupo foi editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::findOrFail($id);
        if($group->documents->count() > 0 || $group->users->count() > 0) {
            return redirect(route('groups.index'))->with('error', 'Não é possível remover um grupo que esteja vinculado a algum documento ou usuário');
        }
        Group::destroy($id);
        return redirect(route('groups.index'))->with('message', 'Grupo deletado com sucesso!');
    }
}
