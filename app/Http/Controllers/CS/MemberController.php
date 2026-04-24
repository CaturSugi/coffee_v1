<?php

namespace App\Http\Controllers\CS;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('member_name', 'like', "%{$request->search}%")
                  ->orWhere('member_code', 'like', "%{$request->search}%")
                  ->orWhere('member_phone', 'like', "%{$request->search}%");
            });
        }

        $members = $query->latest()->paginate(15);
        return view('cs.members.index', compact('members'));
    }

    public function create()
    {
        return view('cs.members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_name' => 'required|string|max:255',
            'member_phone' => 'required|string|max:20|unique:users,phone',
            'member_address' => 'nullable|string|max:500',
        ]);

        return \DB::transaction(function() use ($validated) {
            // 1. Create User
            $user = \App\Models\User::create([
                'name' => $validated['member_name'],
                'phone' => $validated['member_phone'],
                'address' => $validated['member_address'],
                'role' => 'user',
                'password' => \Hash::make($validated['member_phone']), // Default password is phone number
                'email' => $validated['member_phone'] . '@brancoffee.member', // Dummy email
                'is_active' => true,
            ]);

            // 2. Generate member code
            $memberCount = Member::count() + 1;
            $memberCode = 'MBR-' . str_pad($memberCount, 5, '0', STR_PAD_LEFT);

            // 3. Create Member
            Member::create([
                'user_id' => $user->id,
                'member_code' => $memberCode,
                'member_phone' => $validated['member_phone'],
                'discount_percentage' => 5,
                'is_active' => true,
            ]);

            return redirect()->route('cs.members.index')->with('success', 'Member berhasil didaftarkan.');
        });
    }

    public function edit(Member $member)
    {
        return view('cs.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'member_name' => 'required|string|max:255',
            'member_phone' => 'required|string|max:20|unique:users,phone,' . $member->user_id,
            'member_address' => 'nullable|string|max:500',
        ]);

        \DB::transaction(function() use ($validated, $member) {
            // Update User
            $member->user->update([
                'name' => $validated['member_name'],
                'phone' => $validated['member_phone'],
                'address' => $validated['member_address'],
            ]);

            // Update Member
            $member->update([
                'member_phone' => $validated['member_phone'],
            ]);
        });

        return redirect()->route('cs.members.index')->with('success', 'Data member berhasil diperbarui.');
    }
}
