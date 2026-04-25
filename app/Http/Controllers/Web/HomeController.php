<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return match (true) {
                $user->isAdmin()   => redirect()->route('admin.dashboard'),
                $user->isManager() => redirect()->route('manager.dashboard'),
                $user->isCS()      => redirect()->route('cs.dashboard'),
                default            => redirect()->route('login'),
            };
        }

        return redirect()->route('login');
    }

    public function menu()
    {
        $categories = ProductCategory::active()->with(['products' => fn ($q) => $q->active()])->get();
        return view('web.menu', compact('categories'));
    }

    public function about()
    {
        return view('web.about');
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        // TODO: send email / store to DB
        return back()->with('success', 'Thank you! We will get back to you soon.');
    }
}
