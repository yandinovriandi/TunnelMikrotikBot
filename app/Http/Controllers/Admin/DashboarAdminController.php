<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashboarAdminController
{
    public function __invoke(Request $request)
    {

        return view('admin.dashboard');
    }
}
