<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\ProposalRequest;
use App\Http\Requests\ThesisRequest;
use App\Lecturer;
use App\Proposal;
use App\Student;
use App\Thesis;
use App\Http\Requests;
use Illuminate\Http\Request;

class ProposalsController extends Controller
{
    public function index()
    {
        $proposals = Proposal::whereNull('is_check')->paginate(10);
        $proposalsChecked = Proposal::whereNotNull('is_check')->paginate(10);

        return view('proposals.index', compact('proposals', 'proposalsChecked'));
    }

    public function show($id)
    {
        $proposal = Proposal::find($id);
        $lecturers = Lecturer::all();

        return view('proposals.show', compact('proposal', 'lecturers'));
    }

    public function download($id)
    {
        $file = File::find($id);

        return response()->download($file->path, $file->name);
    }

    public function reject($id)
    {

        $proposal = Proposal::find($id);
        $proposal->note = \Request::input('note');
        $proposal->is_check = 0;
        $proposal->save();

        return redirect('proposals')->with(
            'success', "Proposal sudah dicek."
        );
    }

    public function accept(ThesisRequest $request, $id)
    {
        $thesis = new Thesis();
        $thesis->title = \Request::input('title');
        $thesis->student_id = \Request::input('student');
        $thesis->lecturer_id = \Request::input('lecturer');
        $thesis->semester = \Request::input('semester');
        $thesis->starts_at = date("Y-m-d", strtotime(\Request::input('starts_at')));
        $thesis->ends_at = date("Y-m-d", strtotime(\Request::input('ends_at')));
        $thesis->save();


        $proposal = Proposal::find($id);
        $proposal->note = \Request::input('note');
        $proposal->is_check = 1;
        $proposal->thesis()->associate($thesis);
        $proposal->save();

        return redirect('proposals')->with(
            'success', "Proposal sudah dicek. Mahasiswa sudah terdaftar skripsi."
        );
    }

    public function create($id)
    {
        $student = Student::find($id);
        return view('proposals.create', compact('student'));
    }

    public function submission(ProposalRequest $request, $id)
    {
        $proposal = new Proposal();
        $proposal->title = $request->input('title');
        $proposal->student_id = $id;
        $proposal->file()->associate(File::upload($request->file('file'), 'proposals'));
        $proposal->save();

        return redirect('theses')->with(
            'success', "Berhasil membuat proposal."
        );
    }

    public function update(ProposalRequest $request, $id)
    {
        $proposal = Proposal::find($id);
        $proposal->title = $request->input('title');
        $proposal->is_check = null;
        $proposal->note = null;
        $proposal->file()->associate(File::upload($request->file('file'), 'proposals'));
        $proposal->save();

        return redirect('theses')->with(
            'success', "Berhasil mengubah proposal."
        );
    }
}
