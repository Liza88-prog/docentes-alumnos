<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone'            => 'nullable|string',
            'professional_url' => 'nullable|url',
            'photo_path'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        try {
            $validatedData = $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $successMessage = 'Perfil actualizado exitosamente.';
        $photoUpdated = false;

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->professional_url = $validatedData['professional_url'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
            $successMessage = 'Perfil y contraseña actualizados exitosamente.';
        }

        if ($request->hasFile('photo_path')) {
            
            $destinationPath = public_path('uploads/profile_photos');

            $file = $request->file('photo_path');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

            try {
                $file->move($destinationPath, $fileName);
                
                if ($user->photo_path && file_exists(public_path($user->photo_path))) {
                    unlink(public_path($user->photo_path));
                }
                
                $user->photo_path = 'uploads/profile_photos/' . $fileName;
                
                $successMessage = 'Perfil y foto de perfil actualizados exitosamente.';
                $photoUpdated = true;
            } catch (\Exception $e) {
                Log::error('Error al guardar la nueva foto: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Ocurrió un error al subir la foto. Inténtalo de nuevo.');
            }
        }

        $user->save();

        if ($photoUpdated && $request->filled('password')) {
            $successMessage = 'Perfil, contraseña y foto de perfil actualizados exitosamente.';
        }
        
        return redirect()->route('dashboard')->with('success', $successMessage);
    }
}