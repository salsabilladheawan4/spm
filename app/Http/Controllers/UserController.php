<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = User::all();
        return view('pages.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name'  => 'required|max:100',
        'role' => 'required|in:admin,staff,warga',
        'email' => ['required','email','unique:users,email'],
        'password' => 'required|min:8',
        // TAMBAHKAN VALIDASI FOTO
        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data['name']     = $request->name;
    $data['email']    = $request->email;
    $data['role']     = $request->role;
    $data['password'] = Hash::make($request->password);

    // LOGIKA UPLOAD FOTO (Tambahkan bagian ini)
    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/profile_pictures'), $filename);

        // Masukkan nama file ke array $data agar tersimpan di DB
        $data['profile_photo'] = $filename;
    }

    User::create($data); // Sekarang 'profile_photo' ada di dalam $data

    return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $dataUser = User::findOrFail($id);

    $dataUser->name = $request->name;
    $dataUser->role = $request->role;
    $dataUser->email = $request->email;

    if($request->password) {
        $dataUser->password = Hash::make($request->password);
    }

    // LOGIKA UPDATE FOTO (Tambahkan bagian ini)
    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = public_path('uploads/profile_pictures');

        // Hapus foto lama jika ada fisiknya
        if ($dataUser->profile_photo && file_exists($path . '/' . $dataUser->profile_photo)) {
            unlink($path . '/' . $dataUser->profile_photo);
        }

        $file->move($path, $filename);
        $dataUser->profile_photo = $filename; // Update kolom di DB
    }

    $dataUser->save();
    return redirect()->route('user.index')->with('success','Data Berhasil Diupdate!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        return redirect()->route('user.index')->with('success','Data Berhasil Dihapus!');
    }
}
