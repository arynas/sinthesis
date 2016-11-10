<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Conseling;
use App\ConselingRequest;
use App\Lecturer;
use App\Notifications\NotificationComment;
use App\Notifications\NotificationConseling;
use App\Student;
use App\Thesis;
use Auth;
use Illuminate\Http\Request;

class ConselingsController extends Controller
{

    public function index()
    {
        $userActive = Auth::user();

        if($userActive->role == 'student')
        {
            $student = Student::where('user_id', $userActive->id)->first();
            if(!is_null($student->thesis))
            {
                $conselings = Conseling::where('theses_id', $student->thesis->id)->paginate(10);
            }

            return view('conselings.index', compact('conselings', 'student','userActive'));

        }elseif($userActive->role == 'lecturer')
        {

            $lecturer = Lecturer::where('user_id', $userActive->id)->first();
            $conselings = Thesis::where('lecturer_id', $lecturer->id)->paginate(10);

            return view('conselings.index', compact('lecturer', 'conselings','userActive'));
        }

    }

    public function store(ConselingRequest $request, $id)
    {
        $conseling = new Conseling();
        $conseling->user_id = $id;
        $conseling->theses_id = \Request::input('thesis');
        $conseling->topic = \Request::input('topic');
        $conseling->content = \Request::input('content');
        $conseling->save();

        $thesis = Thesis::find($conseling->theses_id);

        if (Auth::user()->role == 'student')
        {
            $thesis->lecturer->user->notify(new NotificationConseling($conseling));
        }else{
            $thesis->student->user->notify(new NotificationConseling($conseling));
        }

        return redirect('conselings')->with('success', 'Berhasil membuat bimbingan baru.');
    }

    public function show($id)
    {
        $userActive = Auth::user();

        if($userActive->role == 'student')
        {
            $conseling = Conseling::find($id);

            return view('conselings.show', compact('conseling','userActive'));

        }elseif($userActive->role == 'lecturer')
        {

            $student = Student::find($id);
            $conselings = Conseling::where('user_id', $student->user->id)->paginate(5);

            return view('conselings.show', compact('conselings','userActive'));
        }
    }

    public function comment($id)
    {
        $comment = new Comment();
        $comment->user_id = \Request::input('user');
        $comment->conseling_id = $id;
        $comment->content = \Request::input('content');
        $comment->save();

        if (Auth::user()->role == 'student')
        {
            $comment->conseling->thesis->lecturer->user->notify(new NotificationComment($comment));
        }elseif(Auth::user()->role == 'lecturer'){
            $comment->conseling->thesis->student->user->notify(new NotificationComment($comment));
        }

        return redirect()->back()->with('success', 'Komentar terkirim');

    }

    public function showComments($id)
    {
        $userActive = Auth::user();
        $conseling = Conseling::find($id);

        return view('conselings.show-lecturer', compact('conseling','userActive'));
    }
}