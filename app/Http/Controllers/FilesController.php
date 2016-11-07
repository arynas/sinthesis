<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * Store a newly created file in storage.
     *
     * @param StoreFileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        $file = File::upload($request->file('file'), $request->get('folder'));

        $file->url_download = $file->url();

        return $file;
    }

    /**
     * Download the specified file.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::find($id);

        return response()->download($file->path, $file->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);

        $file->delete();

        return $file;
    }
}
