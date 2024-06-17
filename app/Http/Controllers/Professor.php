<?php

namespace App\Http\Controllers;

use App\Models\Professor as ModelsProfessor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\College;

class Professor extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // dd( Auth::check());
       $currentCollegeID =session('current_college_id');
       $professors = ModelsProfessor::where('college_id', $currentCollegeID)->latest()->paginate(10);
        return view('professors.index', compact('professors'));
    }
    public function store(Request $request)
    {
        $currentCollegeID =session('current_college_id');
     //   dd($currentCollegeID);
        $collegeID = College::where('id', $currentCollegeID)->first()->id;
    
        $validated = $request->validate([
            'name' => ['required', 'unique:professors,name'],
        ]);
    
        if (ModelsProfessor::create([
            'name' => $validated['name'],
            'college_id' => $collegeID
        ])) {
            return back()->with('success', 'استاد با موفقیت اضافه شد!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('professors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelsProfessor $professor)
    {
        return view('professors.edit', compact('professor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModelsProfessor $professor, Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique('professors', 'name')->ignore($professor->id)],
        ]);

        if ($professor->update($validated))
            return redirect()->route('professors.index')->with('success', 'ویرایش با موفقیت انجام شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsProfessor $professor)
    {
        if ($professor->delete())
            return redirect()->back()->with('success', 'حذف با موفقیت انجام شد!');
    }
}
