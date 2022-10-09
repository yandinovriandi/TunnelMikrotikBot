<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    public function index(Request $request)
    {
        $users = User::query()
            ->whereNotNull('email_verified_at')
            ->whereNot('id', $request->user()->id)
            ->with('roles')
            ->latest()
            ->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(User $user)
    {
    }

    public function edit(User $user)
    {
    }

    public function update(Request $request, User $user)
    {
    }

    public function destroy(User $user)
    {
    }
}
