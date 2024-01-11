<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $name = $user->name ?? 'User';
        $email = $user->email ?? '';

        return Inertia::render('Home', [
            'name' => $name,
            'email' => $email,
        ]);
    }
}
