<?php

namespace App\Http\Controllers;

use App\Models\Term as ModelsTerm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Auth;
use App\Models\College;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class Term extends Controller
{
    public function store(Request $request)
    {

        $currentCollegeID =session('current_college_id');
        $validated = $request->validate([
            'number' => ['required', 'integer', 'unique:terms,number'],
        ]);
 
        if (
            ModelsTerm::create([

                'number' => $validated['number'],
                'college_id' => $currentCollegeID
            ])
        )
            return back()->with('success', 'ترم جدید با موفقیت اضافه شد!');
    }

    public function index()
    {
        $currentCollegeID =session('current_college_id');

        //  $terms = DB::table('terms')->orderBy('number')->paginate(10);
        $terms = ModelsTerm::where('college_id', $currentCollegeID)->paginate(10);
        return view('terms.index', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('terms.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelsTerm $term)
    {
        return view('terms.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsTerm $term)
    {
        $validated = $request->validate([
            'number' => ['required', 'integer', Rule::unique('terms', 'number')->ignore($term->id)],
        ]);

        if ($term->update($validated)) {
            request()->session()->put('current_term', $validated['number']);
            request()->session()->put('current_term_id', $term->id);

            return redirect()->route('terms.index')->with('success', 'ویرایش با موفقیت انجام شد!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsTerm $term)
    {
        if ($term->delete()) {
            if ((session('current_term') == $term->number) && (session('current_term_id') == $term->id)) {
                session()->forget('current_term');
                session()->forget('current_term_id');

                if (!is_null($last_term = ModelsTerm::orderBy('number', 'desc')->first())) {
                    request()->session()->put('current_term', $last_term->number);
                    request()->session()->put('current_term_id', $last_term->id);
                }
            }


            return redirect()->back()->with('success', 'حذف با موفقیت انجام شد!');
        }
    }

    public function setTerm(ModelsTerm $term)
    {
        request()->session()->put('current_term', $term->number);
        request()->session()->put('current_term_id', $term->id);
        return back();
    }
}
