<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class SuperAdminDashboardController extends Controller
{
    public function dashboard()
    {
        $Post = Post::orderBy('id', 'asc')->get();
        return view('superadmin.dashboard.index',compact('Post'));
    }
}
