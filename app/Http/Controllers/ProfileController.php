<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Profile;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Profile::orderBy('id', 'desc')->get();
        //dd($data);
        return Inertia::render('Profile/Index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return Inertia::render('Profile/Create');
    }

    public function show($id)
    {
        $data = Profile::find($id);
        return Inertia::render('Profile/Edit', [
            'data' => $data
        ]);
    }

    public function store()
    {
        Profile::create($this->send());

        return Redirect::route('home.index')->with('message', 'berhasil input');
    }

    public function update($id)
    {
        Profile::where('id', $id)->update($this->send());

        return Redirect::route('home.index')->with('message', 'berhasil update');
    }

    public function destroy($id)
    {
        Profile::destroy($id);
        return Redirect::route('home.index');
    }

    public function send()
    {
        $data = request()->validate(
            [
                'nama' => 'required',
                'gender' => 'required|numeric',
                'no_tlp' => 'required|numeric|digits_between:10,13',
                'kk' => 'required',
                'alamat' => 'required',
                'tanggal_lahir' => 'required|date'
            ],
            [
                'nama.required' => 'wajib diisi',
                'gender.required' => 'wajib diisi',
                'gender.required' => 'error',
                'no_tlp.digits_between' => 'nomor hp minimal 10 dan maksimal 13',
                'kk.required' => 'wajib diisi',
                'alamat.required' => 'wajib diisi',
                'tanggal_lahir.required' => 'wajib diisi'
            ]
        );

        return $data;
    }
}
