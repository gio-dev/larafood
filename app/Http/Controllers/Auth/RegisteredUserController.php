<?php

namespace App\Http\Controllers\Auth;

use App\Events\TenantCreated;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\TenantService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'cnpj' => 'required|numeric|digits:14|  unique:tenants',
            'empresa' => 'required|string|min:3|max:255|unique:tenants,name',
        ]);

        $plan = session('plan');
        if(!$plan)
            return redirect()->route('site.home');

        $data = $request->all();

        $tenantService = app(TenantService::class);
        $user = $tenantService->make($plan, $data);

        Auth::login($user);

        event(new Registered($user));
        event(new TenantCreated($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
