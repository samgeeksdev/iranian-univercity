<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\EducationalGroup;
use App\Models\Entry;
use App\Models\lesson;
use App\Models\Location;
use App\Models\Professor;
use App\Models\Schedule;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
   
        $currentCollegeID = session('current_college_id');

        $lessons_count = Lesson::where('college_id', $currentCollegeID)->count();
        $professors_count = Professor::where('college_id', $currentCollegeID)->count();
        $egs_count = EducationalGroup::where('college_id', $currentCollegeID)->count();
        $entries_count = Entry::where('college_id', $currentCollegeID)->count();
        $classes_count = Classroom::where('college_id', $currentCollegeID)->count();
        $locations_count = Location::where('college_id', $currentCollegeID)->count();

        return view('dashboard', compact('lessons_count', 'professors_count', 'egs_count', 'entries_count', 'classes_count', 'locations_count'));
    }
}