<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Instructor;
use App\Models\User;
use App\Models\Category;
class InstructorController extends Controller
{
    // GET requests

    public function index() {
        return view('admin.instructors.index', array(
            "Instructors" => Instructor::all()
        ));
    }

    public function addPage() {

        return view('admin.instructors.add', array(
            "Categories" => Category::all()
        ));

    }

    // POST requests

    public function store(Request $request) {
        $name = trim($request->input('name'));
        $email = trim($request->input('email'));
        $password = $request->input('password');
        $category = $request->input('category');

        $validated = $request->validate([
            'name' => 'required|min:5',
            'email' => 'required',
            'password' => 'required|min:5',
            'category' => 'required'
        ]);

        $Instructor = Instructor::create([
            'name' => $name,
            'category' => $category,
        ]);

        if ($Instructor->exists) {
            $addedUser = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 2
            ]);
            if ($addedUser->exists) return redirect('/admin/instructors');
        }
        if ($addedUser->exists) return redirect('/dashboard');

    }
}
