<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    /**

     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role_id == 2) {
                return $next($request);
            }
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder a esta sección.');
        });
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.index', compact('users'));
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6|confirmed',
            'role_id'    => 'required|integer', 
            'phone'      => 'nullable|string',
            'professional_url' => 'nullable|url',
        ]);
    
        User::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Usuario creado exitosamente.');

    }

    /**
     *
     * @param  \App\Models\User 
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     *
     * @param  \Illuminate\Http\Request  
     * @param  \App\Models\User  
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id'    => 'required|integer',
            'phone'      => 'nullable|string',
            'professional_url' => 'nullable|url',
        ]);
        
        $user->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     *
     * @param  \App\Models\User
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if (Auth::user()->id === $user->id) {
            return back()->with('error', 'No puedes eliminarte a ti mismo.');
        }
        
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'Usuario eliminado exitosamente.');
    }
}