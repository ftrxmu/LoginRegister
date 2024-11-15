<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('buku', compact('buku'));
    }

    public function showBukuList()
    {
        $bukuList = Buku::all();
        return view('home', compact('bukuList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'genre' => 'required|string|max:255',
        ]);

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun' => $request->tahun,
            'genre' => $request->genre,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'genre' => 'required|string|max:255',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun' => $request->tahun,
            'genre' => $request->genre,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
