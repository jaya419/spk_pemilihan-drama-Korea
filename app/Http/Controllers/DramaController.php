<?php

namespace App\Http\Controllers;

use App\Models\Drama;
use Illuminate\Http\Request;

class DramaController extends Controller
{
    public function index(Request $request)
    {
        $query = Drama::query();

        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where('nama_drama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('tahun', 'like', "%{$search}%");
        }

        $dramas = $query->get();
        return view('drama.index', compact('dramas'));
    }

    public function create()
    {
        return view('drama.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_drama' => 'required|string|max:255|unique:dramas,nama_drama',
            'deskripsi' => 'nullable|string',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'poster' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama_drama', 'deskripsi', 'tahun']);

        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $posterName = time() . '_' . $poster->getClientOriginalName();
            $poster->move(public_path('foto'), $posterName);
            $data['poster'] = 'foto/' . $posterName;
        }

        Drama::create($data);

        return redirect()->route('drama.index')->with('success', 'Drama berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $drama = Drama::findOrFail($id);
        return view('drama.edit', compact('drama'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_drama' => 'required|string|max:255|unique:dramas,nama_drama,' . $id,
            'deskripsi' => 'nullable|string',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'poster' => 'nullable|image|max:2048',
        ]);

        $drama = Drama::findOrFail($id);

        $data = $request->only(['nama_drama', 'deskripsi', 'tahun']);

        if ($request->hasFile('poster')) {
            // Hapus poster lama jika ada
            if ($drama->poster && file_exists(public_path($drama->poster))) {
                unlink(public_path($drama->poster));
            }

            $poster = $request->file('poster');
            $posterName = time() . '_' . $poster->getClientOriginalName();
            $poster->move(public_path('foto'), $posterName);
            $data['poster'] = 'foto/' . $posterName;
        }

        $drama->update($data);

        return redirect()->route('drama.index')->with('success', 'Drama berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $drama = Drama::findOrFail($id);

        // Hapus file poster jika ada
        if ($drama->poster && file_exists(public_path($drama->poster))) {
            unlink(public_path($drama->poster));
        }

        $drama->delete();

        return redirect()->route('drama.index')->with('success', 'Drama berhasil dihapus.');
    }
}
