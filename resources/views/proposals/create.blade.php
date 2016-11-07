@extends('main.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(is_null($student->proposal))
                <h1 class="page-header">Buat Proposal</h1>
             @else
                <h1 class="page-header">Revisi Proposal</h1>
             @endif
        </div>
    </div><!--/.row-->

    <div class="row">
        <section class="vbox">
            <section class="scrollable">
                <header class="header header-height bg-white b-b b-light">
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <p class="p-header"></p>
                        </div>
                        <div class="col-xs-15 col-md-4">
                            <p class="p-header text-right">
                                <a href="/theses" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </p>
                        </div>
                    </div>
                </header>
                <div class="wrapper">
                    @include('partials.success')
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            @if(is_null($student->proposal))
                                <form action="/proposals/{{$student->id}}/submission" method="POST" enctype="multipart/form-data">
                                    @else
                                        <form action="/proposals/{{$student->proposal->id}}/update" method="POST" enctype="multipart/form-data">
                                            {{ method_field('PUT') }}
                                            @endif
                                            {{ csrf_field() }}
                                            <div class="panel panel-default">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <div class="form-group text-left">
                                                            <label for="title">Judul Proposal</label>
                                                            @if(is_null($student->proposal))
                                                                <input type="text" class="form-control" placeholder="" name="title">
                                                                @if ($errors->has('title'))
                                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                                                @endif
                                                            @else
                                                                <input type="text" class="form-control" placeholder="" name="title" value="{{$student->proposal->title}}">
                                                                @if ($errors->has('title'))
                                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-group text-left">
                                                            <label for="file">Unggah Proposal</label>
                                                            <input type="file" name="file">
                                                            @if ($errors->has('file'))
                                                                <span class="help-block">
                                                    <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                                            @endif
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="panel-footer text-right" style="padding-bottom: 10px; padding-top: 10px;">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div><!--/.row-->

@endsection