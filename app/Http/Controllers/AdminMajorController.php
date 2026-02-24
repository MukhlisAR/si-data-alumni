<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class AdminMajorController extends Controller
{
    public function index()
    {
        $majors = Major::latest()->get();
        return view('admin.majors.index', compact('majors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:majors,name'
        ], [
            'name.unique' => 'Jurusan ini sudah ada di dalam database.'
        ]);

        Major::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Jurusan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Major::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Jurusan berhasil dihapus!');
    }
}