<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramRequest;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('admin.dataProgram.program_index', compact('programs'));
    }

    public function create()
    {
        return view('admin.dataProgram.program_form');
    }

    public function store(StoreProgramRequest $request)
    {
        $request->validated();

        Program::create($request->all());

        return redirect()->route('program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(Program $program)
    {
        return view('admin.dataProgram.program_edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi_program' => 'required|string',
        ]);

        $program->update($request->all());

        return redirect()->route('program.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('program.index')->with('success', 'Program berhasil dihapus.');
    }
}
