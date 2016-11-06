<?php

namespace App\Http\Controllers;

use App\Conseling;
use App\Student;
use App\Thesis;
use Auth;
use Illuminate\Http\Request;

class ThesesController extends Controller
{
    public function index()
    {
        $userActive = Auth::user();

        if ($userActive->role == 'administrator') {

            $theses = Thesis::where('is_finished', 0)->paginate(10);
            $thesesEnd = Thesis::where('is_finished', 1)->paginate(10);

            return view('theses.index', compact('theses', 'thesesEnd'));

        } elseif ($userActive->role == 'student') {

            $student = Student::find($userActive->userable_id);

            return view('theses.index', compact('student'));
        }
    }

    public function show($id)
    {
        $thesis = Thesis::find($id);

        return view('theses.show', compact('thesis'));
    }

    public function renew($id)
    {
        $extention = new Extention();
        $extention->theses_id = $id;
        $extention->ends_at = \Request::input('ends_at');
        $extention->save();

        return redirect('theses')->with('success', 'Waktu skripsi berhasil diperpanjang.');
    }

    public function finish($id)
    {
        $finish = Thesis::find($id);
        $finish->is_finished = 1;
        $finish->save();


        return redirect('conselings')->with('success', 'Berhasil mengubah status Skripsi menjadi Selesai.');
    }

    public function download($id)
    {

        if (!defined('DOMPDF_ENABLE_AUTOLOAD')) {
            define('DOMPDF_ENABLE_AUTOLOAD', false);
        }
        if (file_exists($configPath = base_path() . '/vendor/dompdf/dompdf/dompdf_config.inc.php')) {
            require_once $configPath;
        }

        $student = Student::find($id);

        $filename = 'surat-pengantar.pdf';

        $dompdf = new DOMPDF;
        $dompdf->set_base_path("/var/www/dashboard-exam/public/css/");
        $dompdf->load_html(view('theses.covering_letter', compact('student'))->render());
        $dompdf->set_paper("a4");

        $dompdf->render();
        $dompdf->stream($filename);


//          return new Response($dompdf->output(), 200, [
//              'Content-Description' => 'File Transfer',
//              'Content-Disposition' => 'attachment; filename="'.$filename.'"',
//              'Content-Transfer-Encoding' => 'binary',
//              'Content-Type' => 'application/pdf',
//          ]);
    }

}
