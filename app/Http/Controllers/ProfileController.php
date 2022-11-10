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
        $count = Profile::select('gender', Profile::raw('COUNT(profile.gender) AS total'))->groupBy('gender')->get()->toArray();
        $count = array_column($count, 'total');
        $data = Profile::orderBy('id', 'desc')->get();

        return Inertia::render('Profile/Index', [
            'data' => $data,
            'count' => $count
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

    public function store(Request $request)
    {
        // if ($request->hasFile('gambar')) {
        //     $filename = random_int(1, 10000000) . '-' . $data['nama'] . '.' . $request->gambar->extension();
        //     dd($request->gambar->storeAs('public/images', $filename));
        // }
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
        //$count = Profile::select('gender', Profile::raw('COUNT(profile.gender) AS total'))->groupBy('gender')->get()->toArray();
        return Redirect::route('home.index');
    }

    public function filename()
    {
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
                'gambar' => 'required|mimes:jpeg,png,jpg|max:2048',
                'tanggal_lahir' => 'required|date'
            ],
            [
                'nama.required' => 'wajib diisi',
                'gender.required' => 'wajib diisi',
                'gender.required' => 'error',
                'no_tlp.digits_between' => 'nomor hp minimal 10 dan maksimal 13',
                'kk.required' => 'wajib diisi',
                'alamat.required' => 'wajib diisi',
                'gambar.required' => 'wajib diisi',
                'gambar.mimes' => 'file wajib extensi .jpg .png .jpeg',
                'gambar.max' => 'maksimum ukuran file 2mb',
                'tanggal_lahir.required' => 'wajib diisi'
            ]
        );

        $data['gambar'] = random_int(1, 10000000) . '-' . $data['nama'] . '.' . request()->gambar->extension();
        request()->gambar->storeAs('public/images', $data['gambar']);

        return $data;
    }
}
