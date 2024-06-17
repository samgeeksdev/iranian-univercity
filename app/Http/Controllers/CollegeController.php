<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollegeController extends Controller
{
    public function index()
    {
        $colleges = College::orderBy('name')->paginate(10);
        $resource = College::orderBy('name')->paginate(10);
        return view('colleges.index', compact('colleges','resource'));
    }

    public function create()
    {
        return view('colleges.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:colleges,name'],
        ]);
      //  dd(session('current_college'));

        if (College::create(['name' => $validated['name']])) {
            return back()->with('success', 'کالج جدید با موفقیت اضافه شد!');
        }
    }

    public function edit(College $college)
    {
        return view('colleges.edit', compact('college'));
    }

    public function update(Request $request, College $college)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', Rule::unique('colleges', 'name')->ignore($college->id)],
        ]);

        if ($college->update($validated)) {
            request()->session()->put('current_college', $validated['name']);
            request()->session()->put('current_college_id', $college->id);

            return redirect()->route('colleges.index')->with('success', 'ویرایش با موفقیت انجام شد!');
        }
    }

    public function destroy(College $college)
    {
        if ($college->delete()) {
            if ((session('current_college') == $college->name) && (session('current_college_id') == $college->id)) {
                session()->forget('current_college');
                session()->forget('current_college_id');

                if (!is_null($last_college = College::orderBy('name', 'desc')->first())) {
                    request()->session()->put('current_college', $last_college->name);
                    request()->session()->put('current_college_id', $last_college->id);
                }
            }

            return redirect()->back()->with('success', 'حذف با موفقیت انجام شد!');
        }
    }

    public function setCollege(Request $request, $collegeId)
    {
        $college = College::find($collegeId);

        if ($college) {
            $request->session()->put('current_college', $college->name);
            $request->session()->put('current_college_id', $college->id);
        } else {
            $request->session()->put('current_college', 'انتخاب نشده');
            $request->session()->put('current_college_id', null);
        }

        return back();
    }
   }