<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genre.index', compact('genres'));
    }

    public function create()
    {
        return view('genre.create');
    }

    public function store(Request $request)
    {
        if (Genre::count() >= 5) {
            return redirect()->route('genre.index')->with('error', 'Maksimal hanya 5 genre yang diperbolehkan.');
        }

        $request->validate([
            'nama_genre' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0.01|max:1',
            'tipe' => 'required|in:cost,benefit',
        ]);

        $exists = Genre::where('nama_genre', $request->nama_genre)->exists();
        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'duplicate' => 'Genre dengan nama yang sama sudah ada.'
            ]);
        }

        $totalBobot = Genre::sum('bobot') + $request->bobot;
        if ($totalBobot > 1) {
            return redirect()->route('genre.index')->with('error', 'Total bobot tidak boleh melebihi 1.');
        }

        Genre::create($request->only(['nama_genre', 'bobot', 'tipe']));
        return redirect()->route('genre.index')->with('success', 'Genre berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genre.edit', compact('genre'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_genre' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0.01|max:1',
            'tipe' => 'required|in:cost,benefit',
        ]);

        $genre = Genre::findOrFail($id);

        $exists = Genre::where('id', '!=', $id)
            ->where('nama_genre', $request->nama_genre)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'duplicate' => 'Genre dengan nama tersebut sudah ada.'
            ]);
        }

        $totalBobot = (Genre::sum('bobot') - $genre->bobot) + $request->bobot;
        if ($totalBobot > 1) {
            return redirect()->route('genre.index')->with('error', 'Total bobot tidak boleh melebihi 1.');
        }

        $genre->update($request->only(['nama_genre', 'bobot', 'tipe']));
        return redirect()->route('genre.index')->with('success', 'Genre berhasil diupdate.');
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return redirect()->route('genre.index')->with('success', 'Genre berhasil dihapus.');
    }
}
