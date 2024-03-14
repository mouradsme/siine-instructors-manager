<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Category;

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

    // POST requests

    public function store(Request $request) {
        $title = trim($request->input('title'));
        $video = trim($request->input('video'));
        $order = trim($request->input('order'));
        $description = trim($request->input('description'));
        $category = $request->input('category');
        $added_by = auth()->user()->id;
        $validated = $request->validate([
            'video' => 'required',
            'title' => 'sometimes',
            'description' => 'sometimes',
            'order' => 'required',
            'category' => 'required'
        ]);

        $Element = Element::create([
            "title" => $title,
            'description' => $description,
            'video' => $video,
            'order' => $order,
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
