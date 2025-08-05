<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Prapemicuan;
use App\Models\User;
use App\Models\Villages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    //

    public function index()
    {
        $desaPemicuan = count(Prapemicuan::all());
        $data = [
            'title' => 'Admin Aplikasi',
            'desaPemicuan' => $desaPemicuan
        ];
        return view('admin.admin', $data);
    }

    public function pendamping()
    {
        $pendamping =  User::where('role', 'pendamping')->get();
        $data = [
            'title' => 'User Pendamping',
            'users' => $pendamping,
            'formUser' => view('admin.formUser', ['url_insert' => 'pendamping'])
        ];
        return view('admin.users', $data);
    }

    public function fasilitator()
    {
        $fasilitator =  User::where('role', 'fasilitator')->get();
        $data = [
            'title' => 'User Fasilitator',
            'users' => $fasilitator,
            'formUser' => view('admin.formUser', ['url_insert' => 'fasilitator'])
        ];
        return view('admin.users', $data);
    }

    public function userAdmin()
    {
        $admin =  User::where('role', 'Admin')->get();
        $data = [
            'title' => 'User Admin',
            'users' => $admin,
            'formUser' => view('admin.formUser', ['url_insert' => 'Admin']),
        ];
        return view('admin.users', $data);
    }

    public function pra_pemicuan()
    {
        $kegiatan =  Prapemicuan::paginate(5);
        $data = [
            'title' => 'Kegiatan',
            'kegiatan' => $kegiatan,
            'page' => $kegiatan,
            'formprapemicuan' => view('admin.formprapemicuan'),
        ];
        return view('admin.prapemicuan', $data);
    }

    public function addUser(Request $request)
    {


        if (empty($request->idUser)) {
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
            ]);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => '12345',
                'role' => $request->role
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
            ]);
            $user = User::findOrFail(Crypt::decrypt($request->idUser));
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => '12345',
                'role' => $request->role
            ]);
        }

        return [
            'status' => true,
            'redirect' => $request->role == 'Admin' ? 'userAdmin' : $request->role
        ];
    }

    public function getUser(Request $request)
    {
        $userData = User::where('id', Crypt::decrypt($request->id))
            ->first();

        return [
            'user' => $userData
        ];
    }

    public function deleteUser(Request $request)
    {
        $user = User::findOrFail(Crypt::decrypt($request->id));
        $user->delete();

        return [
            'status' => true
        ];
    }
}
