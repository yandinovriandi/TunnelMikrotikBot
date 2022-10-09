<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController
{
    public function assign(Request $request, User $user)
    {
        $role = Role::find($request->role_id);
        abort_if(is_null($role), 403, 'The role could not be found.');
        $role = $user->roles()->toggle([$role->id]);
        session()->flash(
            'status',
            count($role['attached']) ?
                'Role has been assigned.' :
                'Role has been detached'
        );
        return back();
    }
}
