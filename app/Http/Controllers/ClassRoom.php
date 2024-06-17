<?php

namespace App\Http\Controllers;

use App\Models\Classroom as ModelsClassroom;
use App\Models\EducationalGroup;
use App\Models\Entry;
use App\Models\Professor;
use App\Models\TimePeriod;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\College;

class ClassRoom extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentCollegeID =session('current_college_id');
        $currentTermID = session('current_term_id'); // Assuming the current term ID is stored in the session

        $classrooms = ModelsClassroom::where('college_id', $currentCollegeID)
                                     ->where('term_id', $currentTermID)
                                     ->get();
        $time_periods = TimePeriod::orderBy('id')->get();

        $show_lesson_group = true;
        $show_lesson_name = true;
        $show_professor_name = true;
        $show_status = true;
        $show_entry_year = true;
        $show_eg_name = true;

        return view('classrooms.index', compact('classrooms', 'time_periods', 'show_lesson_group', 'show_lesson_name', 'show_professor_name', 'show_status', 'show_entry_year', 'show_eg_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $time_periods = TimePeriod::orderBy('id')->get();
        return view('classrooms.create', compact('time_periods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentCollegeID =session('current_college_id');
        $currentTermID = session('current_term_id'); // Assuming the current term ID is stored in the session

        if (!($request->has('lesson_id') || $request->has('professor_id') || $request->has('status') || $request->has('eg_id') || $request->has('entry_id')))
            return back()->with('failed', 'لطفا مقادیری را برای تعریف کلاس انتخاب کنید');

        $keys = array_unique(array_merge(array_keys($request->lesson_id ?? []), array_keys($request->professor_id ?? []), array_keys($request->status ?? []), array_keys($request->eg_id ?? []), array_keys($request->entry_id ?? [])));

        foreach ($keys as $key) {
            $array = explode('-', $key);

            $class['lesson_id'] = $request->lesson_id[$key] ?? null;
            $class['professor_id'] = $request->professor_id[$key] ?? null;
            $class['status'] = $request->status[$key] ?? null;
            $class['eg_id'] = $request->eg_id[$key] ?? null;
            $class['entry_id'] = $request->entry_id[$key] ?? null;
            $class['week_day'] = $array[0] + 1;
            $class['time_period_id'] = $array[1];
            $class['college_id'] = $currentCollegeID;
            $class['term_id'] = $currentTermID;

            ModelsClassroom::create($class);
        }

        return back()->with('success', 'کلاس ها با موفقیت تعریف شدند!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsClassroom $classroom)
    {
        $class_ids = array_unique(array_merge(array_keys($request->lesson_id ?? []), array_keys($request->professor_id ?? []), array_keys($request->status ?? []), array_keys($request->eg_id ?? []), array_keys($request->entry_id ?? [])));

        foreach ($class_ids as $class_id) {
            $lesson_id = $request->lesson_id[$class_id] ?? null;
            $professor_id = $request->professor_id[$class_id] ?? null;
            $status = $request->status[$class_id] ?? null;
            $eg_id = $request->eg_id[$class_id] ?? null;
            $entry_id = $request->entry_id[$class_id] ?? null;

            if (is_null($lesson_id) && is_null($professor_id) && is_null($status) && is_null($eg_id) && is_null($entry_id)) {
                ModelsClassroom::find($class_id)->delete();
            } else {
                ModelsClassroom::find($class_id)->update([
                    'lesson_id' => $lesson_id,
                    'professor_id' => $professor_id,
                    'status' => $status,
                    'eg_id' => $eg_id,
                    'entry_id' => $entry_id
                ]);
            }
        }

        return redirect()->route('classrooms.index')->with('success', 'ویرایش با موفقیت انجام شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsClassroom $classroom)
    {
        if ($classroom->delete())
            return redirect()->route('classrooms.index')->with('success', 'حذف با موفقیت انجام شد!');
    }

    public function filter(Request $request)
    {
        $currentCollegeID =session('current_college_id');
        $currentTermID = session('current_term_id'); // Assuming the current term ID is stored in the session

        $classrooms = ModelsClassroom::where('college_id', $currentCollegeID)
                                     ->where('term_id', $currentTermID);

        if (!$request->manually_select) {
            if ($request->has('professors')) {
                $classrooms = $classrooms->where(function (Builder $query) use ($request) {
                    foreach ($request->professors as $key => $professor_id) {
                        $professor = Professor::find($professor_id);
                        $query->orWhereIn('id', $professor->classrooms->pluck('id'));
                    }
                });
            }

            if ($request->has('educational_groups')) {
                $classrooms = $classrooms->where(function (Builder $query) use ($request) {
                    foreach ($request->educational_groups as $key => $eg_id) {
                        $educational_group = EducationalGroup::find($eg_id);
                        $query->orWhereIn('id', $educational_group->classrooms->pluck('id'));
                    }
                });
            }

            if ($request->has('entries')) {
                $classrooms->where(function (Builder $query) use ($request) {
                    foreach ($request->entries as $key => $entry_id) {
                        $entry = Entry::find($entry_id);
                        $query->orWhereIn('id', $entry->classrooms->pluck('id'));
                    }
                });
            }

            if (!is_null($request->status))
                $classrooms = $classrooms->where('status', $request->status);
        } else {
            if ($request->has('classes')) {
                $classrooms = $classrooms->whereIn('id', $request->classes);
            }
        }

        $classrooms = $classrooms->get();
        $time_periods = TimePeriod::orderBy('id')->get();

        $show_lesson_group = request('show_lesson_group');
        $show_lesson_name = request('show_lesson_name');
        $show_professor_name = request('show_professor_name');
        $show_status = request('show_status');
        $show_entry_year = request('show_entry_year');
        $show_eg_name = request('show_eg_name');

        return view('classrooms.index', compact('classrooms', 'time_periods', 'show_lesson_group', 'show_lesson_name', 'show_professor_name', 'show_status', 'show_entry_year', 'show_eg_name'));
    }
}