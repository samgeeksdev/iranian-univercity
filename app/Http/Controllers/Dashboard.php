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
        $lessons_count = lesson::all()->count();
        $professors_count = Professor::all()->count();
        $egs_count = EducationalGroup::all()->count();
        $entries_count = Entry::all()->count();
        $classes_count = Classroom::all()->count();
        $locations_count = Location::all()->count();

        return view('dashboard', compact('lessons_count', 'professors_count', 'egs_count', 'entries_count', 'classes_count', 'locations_count'));
    }
}