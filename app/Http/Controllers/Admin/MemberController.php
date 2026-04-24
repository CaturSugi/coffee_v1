<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Member::with('user');

        if (auth()->user()->isAdmin() && $request->has('show_trashed')) {
            $query->withTrashed();
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('tier')) {
            $tier = $request->tier;
            $query->where(function($q) use ($tier) {
                if ($tier == 'Platinum') $q->where('total_spent', '>=', 5000000);
                elseif ($tier == 'Gold') $q->where('total_spent', '>=', 2000000)->where('total_spent', '<', 5000000);
                elseif ($tier == 'Silver') $q->where('total_spent', '>=', 1000000)->where('total_spent', '<', 2000000);
                else $q->where('total_spent', '<', 1000000);
            });
        }

        $members = $query->latest()->paginate(15)->withQueryString();

        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:members,member_phone',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean',
        ]);

        return \DB::transaction(function() use ($validated) {
            // Create user first
            $user = \App\Models\User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => \Hash::make($validated['phone']), // Default password is phone
                'role' => 'member',
            ]);

            // Create member
            $member = Member::create([
                'user_id' => $user->id,
                'member_code' => 'MBR-' . strtoupper(\Str::random(8)),
                'member_phone' => $validated['phone'],
                'member_email' => $validated['email'],
                'discount_percentage' => $validated['discount_percentage'] ?? 0,
                'is_active' => $validated['is_active'] ?? true,
            ]);

            return redirect()->route('admin.members.index')
                ->with('success', 'Member berhasil ditambahkan. Password default adalah nomor HP.');
        });
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $member->user_id,
            'phone' => 'required|string|max:20|unique:members,member_phone,' . $member->id,
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean',
        ]);

        \DB::transaction(function() use ($validated, $member) {
            $member->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            $member->update([
                'member_phone' => $validated['phone'],
                'member_email' => $validated['email'],
                'discount_percentage' => $validated['discount_percentage'] ?? 0,
                'is_active' => $validated['is_active'] ?? true,
            ]);
        });

        return redirect()->route('admin.members.index')->with('success', 'Data member berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        return \DB::transaction(function() use ($member) {
            if (auth()->user()->isAdmin()) {
                // Permanent Delete only for Admin
                if ($member->user) {
                    $member->user->forceDelete();
                }
                $member->forceDelete();
                return redirect()->route('admin.members.index')->with('success', 'Member dan akun pengguna telah dihapus secara permanen oleh Admin.');
            } else {
                // Soft Delete for Manager / others
                if ($member->user) {
                    $member->user->delete();
                }
                $member->delete();
                return redirect()->route('admin.members.index')->with('success', 'Member telah disembunyikan (Soft Delete).');
            }
        });
    }

    /**
     * Restore a soft-deleted member (Admin only)
     */
    public function restore($id)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $member = Member::withTrashed()->findOrFail($id);
        
        \DB::transaction(function() use ($member) {
            if ($member->user()->withTrashed()->exists()) {
                $member->user()->withTrashed()->restore();
            }
            $member->restore();
        });

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil dipulihkan.');
    }
}
