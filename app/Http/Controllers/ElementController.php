<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Category;
use App\Models\Note;
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

    public function approved() {
        if (auth()->user()->role == 1) {
            // Admins
            $Elements = Element::where('status', 1)->get();

        } else {
            $Instructor = Instructor::where('user_id', auth()->user()->id)->firstOrFail();
            $category = $Instructor->category;
            $Elements = Element::where('category', $category)->where('status', 1)->get();

        }

        return view('instructor.approved', array(
            "Elements" => $Elements
        ));
    }

    public function unverified() {
        if (auth()->user()->role == 1) {
            // Admins
            $Elements = Element::whereNot('status', 1)->get();

        } else {
            $Instructor = Instructor::where('user_id', auth()->user()->id)->firstOrFail();
            $category = $Instructor->category;
            $Elements = Element::where('category', $category)->whereNot('status', 1)->get();

        }
        return view('instructor.unverified', array(
            "Elements" => $Elements
        ));
    }

    public function verifyElementPage(Request $request, $id) {
        $Element = Element::find($id);
        $Notes = Note::where('video_id', $id)->get();

        $url = $Element->video;
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        $fullEmbedUrl = 'https://www.youtube.com/embed/' . $youtube_id ;

        $Element->video = $fullEmbedUrl;
        return view('instructor.verify', array(
            "Element" => $Element,
            "Notes" => $Notes
        ));
    }

    function approvedElementPage(Request $request, $id) {

        $Element = Element::find($id);



        return view("instructor.approvedOne", array(
            "Element" => $Element
        ));

    }

    // POST requests
    public function addNote(Request $request) {
        $message = trim($request->input('message'));
        $video_id = $request->input('video_id');

        $Note = Note::create(array(
            'message' => $message,
            'video_id' => $video_id,
            'status' => 0
        ));

        if ($Note->exists) {
            return redirect()->to(route('unverified.verify.page', $video_id));
        }

        return redirect('unverified');

    }

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

    function updateElement(Request $request) {
        $title = trim($request->input('title'));
        $order = trim($request->input('order'));
        $status = trim($request->input('status'));
        $description = trim($request->input('description'));
        $id = trim($request->input('id'));

        $validated = $request->validate([
            'title' => 'required',
            'status' => 'required',
            'description' => 'required',
            'order' => 'required',
            'documents' => 'nullable|file', // Adjust allowed file types as needed

        ]);

        $Element = Element::find($id);


        if ($Element->update($validated)) {
            if ($request->hasFile('documents')) {
                $file = $request->file('documents');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/quizzes'), $fileName);
                $Element->quiz_file = 'uploads/quizzes/' . $fileName;
                $Element->save();
            }
            return redirect()->to(route('unverified.verify.page', $id));
        }

        return redirect('unverified');

    }
}
