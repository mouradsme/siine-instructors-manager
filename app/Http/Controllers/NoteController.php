<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Element;
use App\Models\Instructor;

class NoteController extends Controller
{
    //
    public function delete(Request $request, $id) {
        $Note = Note::find($id);
        $Element = Element::find($Note->video_id);
        $User = auth()->user();
        $Instructor = Instructor::where('user_id', $User->id)->firstOrFail();
        $allowedCategory = $Instructor->category;

        if ($Element->category === $allowedCategory) {
            $Note->delete();
            return redirect()->to(route('unverified.verify.page', $Element->id));
        }
        return redirect('unverified');

    }
}
