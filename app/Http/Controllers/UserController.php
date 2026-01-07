<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\StaffRequestNotification;


class UserController extends Controller
{
    /* ==========================
     *  MANAJEMEN USER (ADMIN)
     * ========================== */

    public function index()
    {
        return view('pages.user.index', [
            'dataUser' => User::all()
        ]);
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|max:100',
            'role'           => 'required|in:admin,staff,warga',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:8',
            'profile_photo'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('profile_photo')) {
            $filename = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
            $request->file('profile_photo')->move(public_path('uploads/profile_pictures'), $filename);
            $data['profile_photo'] = $filename;
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    public function edit($id)
    {
        return view('pages.user.edit', [
            'dataUser' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        if ($request->hasFile('profile_photo')) {
            $path = public_path('uploads/profile_pictures');

            if ($user->profile_photo && file_exists($path . '/' . $user->profile_photo)) {
                unlink($path . '/' . $user->profile_photo);
            }

            $filename = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
            $request->file('profile_photo')->move($path, $filename);

            $user->update([
                'profile_photo' => $filename
            ]);
        }

        return redirect()->route('user.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user.index')->with('success', 'Data Berhasil Dihapus!');
    }

    /* ==========================
     *  PERMOHONAN STAFF
     * ========================== */


    public function requestStaff()
    {
        $user = Auth::user();

        if ($user->staff_status === 'pending') {
            return back()->with('success', 'Permohonan sudah diajukan');
        }

        $user->update(['staff_status' => 'pending']);

        User::where('role', 'admin')->each(function ($admin) use ($user) {
            $admin->notify(new StaffRequestNotification(
                $user->name . ' mengajukan permohonan staff',
                route('staff.request.list')
            ));
        });


        return back()->with('success', 'Permohonan staff berhasil dikirim');
    }


    public function staffRequest()
    {
        return view('pages.user.staff-request', [
            'users' => User::where('staff_status', 'pending')->get()
        ]);
    }

    public function approveStaff($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'role' => 'staff',
            'staff_status' => 'approved'
        ]);

        $user->notify(new StaffRequestNotification(
            'Permohonan Anda disetujui admin',
            route('dashboard')
        ));


        return back();
    }


    public function rejectStaff($id)
    {
        $user = User::findOrFail($id);

        $user->update(['staff_status' => 'rejected']);

        $user->notify(new StaffRequestNotification(
            'Permohonan Anda ditolak admin',
            route('dashboard')
        ));


        return back();
    }
}
