<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController
{
    public function edit(User $user)
    {
        return view('profile/edit', ['user' =>  $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required'],
            'phone' => ['required']
        ]);
        $user = User::where('id', auth()->user()->id)->first();
        $user->username = $request->username;
        $user->save();
        session()->flash('status', 'Data Profile anda berhasil di perbaharui ');
        return to_route('profile.edit', $user);
    }
}
