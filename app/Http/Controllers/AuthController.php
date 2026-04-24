<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* ------------------------------------------------------------------ */
    /* Login                                                                */
    /* ------------------------------------------------------------------ */

    public function showLogin()
    {
        $stats = [
            'transactions' => Transaction::where('payment_status', 'completed')->count(),
            'products'     => Product::where('is_active', true)->count(),
            'members'      => Member::count(),
        ];
        return view('auth.login', compact('stats'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            return match (true) {
                $user->isAdmin()   => redirect()->intended(route('admin.dashboard')),
                $user->isManager() => redirect()->intended(route('manager.dashboard')),
                $user->isCS()      => redirect()->intended(route('cs.dashboard')),
                default            => redirect()->intended(route('home')),
            };
        }

        return back()->withErrors(['email' => 'These credentials do not match our records.'])->onlyInput('email');
    }

    /* ------------------------------------------------------------------ */
    /* Register                                                             */
    /* ------------------------------------------------------------------ */

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    /* ------------------------------------------------------------------ */
    /* Logout                                                               */
    /* ------------------------------------------------------------------ */

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /* ------------------------------------------------------------------ */
    /* Profile                                                              */
    /* ------------------------------------------------------------------ */

    public function showProfile()
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password changed successfully.');
    }

    /* ------------------------------------------------------------------ */
    /* Member Area                                                          */
    /* ------------------------------------------------------------------ */

    public function myTransactions()
    {
        $transactions = Auth::user()->transactions()->latest()->paginate(15);
        return view('auth.transactions', compact('transactions'));
    }

    public function myPoints()
    {
        $member = Auth::user()->member;
        return view('auth.points', compact('member'));
    }

    public function memberDashboard()
    {
        $member = Auth::user()->member;
        return view('member.dashboard', compact('member'));
    }

    public function registerMember(Request $request)
    {
        // TODO: full member registration logic
        return redirect()->route('member.dashboard');
    }

    public function memberProfile()
    {
        $member = Auth::user()->member;
        return view('member.profile', compact('member'));
    }
}

