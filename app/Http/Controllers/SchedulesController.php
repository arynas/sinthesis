<?php

namespace App\Http\Controllers;

use App\ConselingRequest;
use App\Lecturer;
use App\Student;
use App\ConselingSchedule as Schedule;
use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    public function index()
    {
        $userActive = Auth::user();
        if($userActive->role == 'student')
        {
            $student = Student::where('user_id',$userActive->id)->first();

            if($student->thesis)
            {
                $schedules = Schedule::where('lecturer_id', $student->thesis->lecturer->id)->get();
                $requests = ConselingRequest::where('student_id', $student->id)->paginate(5);

                return view('schedules.index', compact('schedules','requests','student','userActive'));
            }
            else
            {
                return view('schedules.index', compact('student','userActive'));
            }

        }
        elseif($userActive->role == 'lecturer')
        {
            $lecturer = Lecturer::where('user_id',$userActive->id)->first();
            $schedules = Schedule::where('lecturer_id', $lecturer->id)->paginate(5);

            return view('schedules.index', compact('schedules','lecturer','userActive'));
        }
    }

    public function show($id)
    {
        $userActive = Auth::user();
        if($userActive->role == 'student')
        {
            $userActive = Auth::user();
            $student = Student::where('user_id',$userActive->id)->first();

            if(!is_null($student->conseling_requests->last()))
            {
                $now = date('Y-m-d H:i:s');
                $time = date('Y-m-d H:i:s', strtotime($student->conseling_requests->last()->conseling_schedule->starts_at));

                if($student->conseling_requests->last()->is_confirmed == null ||($student->conseling_requests->last()->is_confirmed == 1 && $time >= $now))
                {

                    return redirect('schedules')->with('have_date', 'Anda masih mempunyai jadwal.');

                }else{

                    $schedule = Schedule::find($id);

                    return view('schedules.show', compact('schedule', 'student','userActive'));

                }
            }else{
                $schedule = Schedule::find($id);

                return view('schedules.show', compact('schedule', 'student','userActive'));
            }
        }
        elseif($userActive->role == 'lecturer')
        {
            $request = ConselingRequest::find($id);

            return view('schedules.show', compact('request','userActive'));
        }
    }

    public function store(Request $requests, $id)
    {
        $userActive = Auth::user();
        if($userActive->role == 'student')
        {
            $request = new ConselingRequest();
            $request->conseling_schedule_id = $id;
            $request->student_id = \Request::input('student');
            $request->save();

            return redirect('schedules')->with('success', 'Berhasil memesan jadwal bimbingan. Tunggu konfirmasi dari dosen.');

        }
        elseif($userActive->role == 'lecturer')
        {
            $validator = Validator::make($requests->all(), [
                'date' => 'required',
                'time_starts' => 'required',
                'time_ends' => 'required',
                'note' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $starts = date("Y-m-d", strtotime(\Request::input('date'))) . ' ' .date("H:i:s", strtotime(\Request::input('time_starts')));
            $ends = date("Y-m-d", strtotime(\Request::input('date'))) . ' ' .date("H:i:s", strtotime(\Request::input('time_ends')));

            $schedule = new Schedule();
            $schedule->lecturer_id = $id;
            $schedule->note = \Request::input('note');
            $schedule->starts_at = $starts;
            $schedule->ends_at = $ends;
            $schedule->save();

            return redirect('schedules')->with('success', 'Berhasil menambahkan jadwal bimbingan');
        }
    }


    public function confrim()
    {
        $status = \Request::input('status');

        if ($status == 1) {

            $id = \Request::input('id');

            $request = ConselingRequest::find($id);
            $request->is_confirmed = 1;
            $request->save();

        } else {

            $id = \Request::input('id');

            $request = ConselingRequest::find($id);
            $request->is_confirmed = 0;
            $request->save();

        }

    }

    public function destroy($id)
    {
        $userActive = Auth::user();
        if($userActive->role == 'student')
        {
            $request = ConselingRequest::find($id);

            $requests = ConselingRequest::where('conseling_schedule_id', $request->conseling_schedule_id)->get();

            if(ConselingRequest::where('conseling_schedule_id', $request->conseling_schedule_id)->get()->count() != 1){

                foreach($requests as $request){

                    $schedule = ConselingRequest::destroy($request->id);

                }

            }else{

                $schedule = ConselingRequest::destroy($id);
            }

            return redirect('schedules')->with('success', 'Berhasil menghapus jadwal.');

        }
        elseif($userActive->role == 'lecturer')
        {
            $schedule = Schedule::find($id);

            $count = $schedule->conseling_requests()->get()->count();

            if($count == 0)
            {
                $schedule = Schedule::destroy($id);

                return redirect('schedules')->with('success', 'Berhasil menghapus jadwal.');

            }else{

                $schedule = Schedule::find($id)->delete();

                return redirect('schedules')->with('success', 'Berhasil menghapus jadwal.');
            }

        }

    }
}
