<?php
// app/Http/Controllers/WelcomeController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(): View|RedirectResponse
    {
        // If user is logged in, redirect to dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // Otherwise, show the welcome page
        return view('welcome');
    }
}
// This controller handles the welcome page and redirects authenticated users to the dashboard.
