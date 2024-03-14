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

    public function editPage(Request $request, $id) {
        $Instructor = Instructor::findOrFail($id);
        $Credentials = User::find($Instructor->user_id);
        return view('admin.instructors.edit', array(
            "Categories" => Category::all(),
            "Instructor" => $Instructor,
            "Credentials" => $Credentials
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
            'user_id' => 0
        ]);

        if ($Instructor->exists) {
            $addedUser = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 2
            ]);
            if ($addedUser->exists) {
                $Instructor->user_id = $addedUser->id;
                $Instructor->save();

                return redirect('/admin/instructors');
            }
        }
        if ($addedUser->exists) return redirect('/dashboard');

    }
    public function update(Request $request) {
        $name = trim($request->input('name'));
        $email = trim($request->input('email'));
        $category = $request->input('category');
        $id = $request->input('id');

        $validated = $request->validate([
            'name' => 'sometimes|min:5',
            'email' => 'sometimes',
            'category' => 'sometimes'
        ]);

        $Instructor = Instructor::find($id);
        $addedUser = User::find($Instructor->user_id);

        $Instructor->update([
            'name' => $name,
            'category' => $category,
        ]);

        $addedUser->update([
                'name' => $name,
                'email' => $email
            ]);

        return redirect('/admin/instructors');


    }
}
