<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    public function dashboard()
    {
        $teachersCount = Teacher::count();
        $activeTeachers = Teacher::where('active', 1)->count();
        $inactiveTeachers = Teacher::where('active', 0)->count();

        return view('dashboard', compact('teachersCount', 'activeTeachers', 'inactiveTeachers'));
    }
}