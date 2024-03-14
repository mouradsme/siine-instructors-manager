<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Category;
use App\Models\Instructor;

class ElementController extends Controller
{
    // GET Requests
    public function index() {
        return view('admin.elements.index', array(
            "Elements" => Element::all()
        ));
    }

    public function addPage() {

        return view('admin.elements.add', array(
            "Categories" => Category::all()
        ));

    }

    public function toverify() {
        $Instructor = Instructor::where('user_id', auth()->user()->id)->firstOrFail();
        $category = $Instructor->category;
        $Elements = Element::where('category', $category)->where('status', 0)->get();
        return view('instructor.toverify', array(
            "Elements" => $Elements
        ));
    }

    // POST requests

    public function store(Request $request) {
        $title = trim($request->input('title'));
        $video = trim($request->input('video'));
        $order = trim($request->input('order'));
        $uid = trim($request->input('uid'));
        $description = trim($request->input('description'));
        $category = $request->input('category');
        $added_by = auth()->user()->id;
        $validated = $request->validate([
            'video' => 'required',
            'uid' => 'required',
            'category' => 'required'
        ]);

        $Element = Element::create([
            "title" => "N/A",
            'description' => "N/A",
            'video' => $video,
            'order' => 0,
            'uid' => $uid,
            'added_by' => $added_by,
            'category' => $category
            ]
        );
        if ($Element->exists) {
            return redirect('/admin/elements');
        }


        return redirect('dashboard');
    }
}
