<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\lesson as ModelsLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\returnSelf;

class Lesson extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentCollegeID = Auth::user()->college_id;
        $currentTermID = session('current_term_id'); // Assuming the current term ID is stored in the session
    
        $lessons = ModelsLesson::where('college_id', $currentCollegeID)
                                ->where('term_id', $currentTermID)
                                ->latest()
                                ->paginate(10);
    
        return view('lessons.index', compact('lessons'));
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentCollegeID = Auth::user()->college_id;
        $collegeID = College::where('id', $currentCollegeID)->first()->id;

        $validated = $request->validate([
            'name' => ['required'],
            'code' => ['nullable', 'string'],
            'group' => ['nullable'],
         ]);

        if (
            ModelsLesson::create([
                'name' => $validated['name'],
                'code' => $validated['code'],
                'group' => $validated['group'],
                'term_id' => session('current_term_id'),
                'college_id' => $collegeID

            ])
        )
            return back()->with('success', 'درس با موفقیت ایجاد شد!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelsLesson $lesson)
    {
        return view('lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModelsLesson $lesson, Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'code' => ['nullable', 'string'],
            'group' => ['nullable', 'string']
        ]);

        if ($lesson->update($validated))
            return redirect()->route('lessons.index')->with('success', 'ویرایش با موفقیت انجام شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsLesson $lesson)
    {
        if ($lesson->delete())
            return redirect()->back()->with('success', 'حذف با موفقیت انجام شد!');
    }
}
