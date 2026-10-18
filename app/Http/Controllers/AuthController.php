<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectDashboard(Auth::user()->role);
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectDashboard(Auth::user()->role);
        }

        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt login via username
        $user = User::where('username', $credentials['username'])->first();

        // Support standard hashed passwords and fallback verification
        if ($user && (Hash::check($credentials['password'], $user->password) || $user->password === $credentials['password'])) {
            if ($user->password === $credentials['password']) {
                $user->password = Hash::make($credentials['password']);
                $user->save();
            }

            Auth::login($user);
            $request->session()->regenerate();
            session()->flash('login', 'You have successfully logged in!');

            if (session()->has('redirect_url')) {
                $redirectUrl = session()->pull('redirect_url');
                return redirect($redirectUrl);
            }

            return $this->redirectDashboard($user->role);
        }

        return back()->with('error', 'Incorrect username or password.')->withInput();
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectDashboard(Auth::user()->role);
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectDashboard(Auth::user()->role);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:4',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        session()->flash('login', 'Registration successful! Please login.');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flash('logout_success', true);

        return redirect()->route('login');
    }

    private function redirectDashboard(string $role)
    {
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'supplier') {
            return redirect()->route('supplier.dashboard');
        }

        return redirect()->route('user.dashboard');
    }
}
