<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // GET Requests
    public function index() {
        return view('admin.categories.index', array(
            "Categories" => Category::all()
        ));
    }

    public function addPage() {

        return view('admin.categories.add');

    }

    // POST requests

    public function store(Request $request) {
        $name = trim($request->input('name'));

        if (strlen($name > 4)) {
            $Category = Category::create(
                array("name" => $name)
            );
            if ($Category->exists) {
                return redirect('/admin/categories');
            }
        }

        return redirect('dashboard');
    }
}
