<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::orderBy('name', 'ASC')->get();
        return view('pages.user.index', [
            'title' => 'Data User',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create', [
            'title' => 'Tambah User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:users,username', 'alpha_num'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
            'role' => ['required', 'in:operator,skpd,tim tepra'],
            'avatar' => ['image', 'mimes:jpg,jpeg,png']
        ]);

        DB::beginTransaction();

        try {
            $data = request()->all();
            if (request()->file('avatar')) {
                $data['avatar'] = request()->file('avatar')->store('users', 'public');
            } else {
                $data['avatar'] = NULL;
            }
            $data['password'] = bcrypt(request('password'));
            User::create($data);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::findOrFail($id);
        return view('pages.user.edit', [
            'title' => 'Edit User',
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->all();

        $item = User::findOrFail($id);
        request()->validate([
            'name' => ['required'],
            'username' => ['required', Rule::unique('users')->ignore($item->id), 'alpha_num'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($item->id)],
            'role' => ['required', 'in:operator,skpd,tim tepra'],
            'avatar' => ['image', 'mimes:jpg,jpeg,png']
        ]);

        DB::beginTransaction();

        try {
            if (request('password')) {
                request()->validate([
                    'password' => ['required', 'min:6', 'confirmed'],
                    'password_confirmation' => ['required'],
                ]);
                $data['password'] = bcrypt(request('password'));
            } else {
                $data['password'] = $item->password;
            }

            if (request()->file('avatar')) {
                if ($item->avatar) {
                    Storage::disk('public')->delete($item->avatar);
                }
                $data['avatar'] = request()->file('avatar')->store('users', 'public');
            } else {
                $data['avatar'] = $item->avatar;
            }
            $item->update($data);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User berhasil disimpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);

        DB::beginTransaction();

        try {
            if ($item->avatar) {
                Storage::disk('public')->delete($item->avatar);
            }
            $item->delete();
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
