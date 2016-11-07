@extends('main.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tesis</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <section class="vbox">
            @if(Auth::user()->role == 'student')
                <section class="scrollable">
                    <header class="header header-height bg-white b-b b-light">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <p class="p-header text-right">
                                    @if(is_null($student->proposal))
                                        <a href="proposals/{{$student->id}}/create" class="btn btn-info"><i class="fa fa-file-text"></i> Ajukan Proposal</a>
                                    @endif
                                    @if(!is_null($student->proposal) && !is_null($student->proposal->is_check) && $student->proposal->is_check == 0)
                                        <a href="proposals/{{$student->id}}/create" class="btn btn-info"><i class="fa fa-file-text"></i> Revisi Proposal</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </header>
                    <div class="wrapper">
                        @include('partials.success')
                        @if(is_null($student->proposal))
                            <div class="jumbotron text-center">
                                <h2>Silakan Ajukan Proposal Terlebih Dahulu.</h2>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-header text-center" style="padding-top:10px;padding-bottom:10px;">
                                            <label for="" style="font-size: large">Proposal</label>
                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <label for="" style="">Judul Proposal</label><br/>
                                                <label for="" style="font-size: large">{{$student->proposal->title}}</label>
                                            </li>
                                            <li class="list-group-item">
                                                <label for="" style="">Nama Mahasiswa</label><br/>
                                                <label for="" style="font-size: large">{{$student->proposal->student->name}}</label>
                                            </li>
                                            <li class="list-group-item">
                                                <label for="" style="">NIM</label><br/>
                                                <label for="" style="font-size: large">{{$student->proposal->student->nim}}</label>
                                            </li>
                                            <li class="list-group-item">
                                                <label for="" style="">File</label><br/>
                                                <a href="/proposals/{{$student->proposal->file->id}}/download" class="btn btn-default btn-md" role="button">
                                                    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download Proposal
                                                </a>
                                            </li>
                                            @if(is_null($student->proposal->is_check))
                                                <li class="list-group-item">
                                                    <label for="" style="">Status</label><br/>
                                                    <label for="" style="font-size: large">Belum Dicek</label>
                                                </li>
                                            @elseif($student->proposal->is_check == 0)
                                                <li class="list-group-item">
                                                    <label for="" style="">Status</label><br/>
                                                    <label for="" style="font-size: large">Ditolak</label>
                                                </li>
                                            @elseif($student->proposal->is_check == 1)
                                                <li class="list-group-item">
                                                    <label for="" style="">Status</label><br/>
                                                    <label for="" style="font-size: large">Diterima</label>
                                                </li>
                                            @endif
                                            @if(!is_null($student->proposal->note))
                                                <li class="list-group-item">
                                                    <label for="" style="">Catatan</label><br/>
                                                    <label for="" style="font-size: large">{{$student->proposal->note}}</label>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-header text-center" style="padding-top:10px;padding-bottom:10px;">
                                            <label for="" style="font-size: large">Skripsi</label>
                                        </div>
                                        @if(is_null($student->thesis))
                                            <ul class="list-group">
                                                <li class="list-group-item text-center">
                                                    <label for="" style="">Belum Bisa Mengerjakan Skripsi</label><br/>
                                                </li>
                                            </ul>
                                        @else
                                            <ul class="list-group">
                                                <li class="list-group-item text-left">
                                                    <label for="" style="">Judul Skripsi</label><br/>
                                                    <label for="" style="font-size: large">{{$student->thesis->title}}</label>
                                                </li>
                                            </ul>
                                            <ul class="list-group">
                                                <li class="list-group-item text-left">
                                                    <label for="" style="">Nama Mahasiswa</label><br/>
                                                    <label for="" style="font-size: large">{{$student->name}}</label>
                                                </li>
                                            </ul>
                                            <ul class="list-group">
                                                <li class="list-group-item text-left">
                                                    <label for="" style="">NIM</label><br/>
                                                    <label for="" style="font-size: large">{{$student->nim}}</label>
                                                </li>
                                            </ul>
                                            <ul class="list-group">
                                                <li class="list-group-item text-left">
                                                    <label for="" style="">Dosen Pembimbing</label><br/>
                                                    <label for="" style="font-size: large">{{$student->thesis->lecturer->name}}</label>
                                                </li>
                                            </ul>
                                            <ul class="list-group">
                                                <li class="list-group-item text-left">
                                                    <label for="" style="">Semester</label><br/>
                                                    <label for="" style="font-size: large">{{$student->thesis->semester}}</label>
                                                </li>
                                            </ul>
                                            <ul class="list-group">
                                                <li class="list-group-item text-left">
                                                    <label for="" style="">Tanggal Mulai</label><br/>
                                                    <label for="" style="font-size: large">{{date("d-m-Y", strtotime($student->thesis->starts_at))}}</label>
                                                </li>
                                            </ul>
                                            <ul class="list-group">
                                                <li class="list-group-item text-left">
                                                    <label for="" style="">Tanggal Selesai</label><br/>
                                                    <label for="" style="font-size: large">{{date("d-m-Y", strtotime($student->thesis->ends_at))}}</label>
                                                </li>
                                            </ul>
                                            @if($student->thesis->is_finished == 1)
                                                <li class="list-group-item text-center">
                                                    <label for="" style="color: green;"><b>SKRIPSI SELESAI</b></label><br/>
                                                </li>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            @elseif(Auth::user()->role == 'administrator')
                <section class="scrollable">
                    <div class="wrapper">
                        @include('partials.success')
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#pane1" data-toggle="tab">Berjalan</a></li>
                                <li><a href="#pane2" data-toggle="tab">Selesai</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="pane1" class="tab-pane active">
                                    <div class="col-md-0">
                                        <section class="panel panel-default">
                                            {{--<header class="panel-heading"> Proposal Belum Diperiksa</header>--}}
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover b-t b-light">
                                                        <thead>
                                                        <tr>
                                                            <th class="col-lg-1 text-center">No</th>
                                                            <th class="col-lg-4 text-center">Judul Skripsi</th>
                                                            <th class="col-lg-3 text-center">Nama Mahasiswa</th>
                                                            <th class="col-lg-4 text-center">Nama Dosen Pembimbing</th>
                                                            <th class="col-lg-4 text-center">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($theses as $key => $thesis)
                                                            <tr>
                                                                <td class="text-center">{{ ($theses->currentPage() - 1) * $theses->perPage() + ($key + 1) }}</td>
                                                                <td>{{ $thesis->title }}</td>
                                                                <td>{{ $thesis->student->name }}</td>
                                                                <td>{{ $thesis->lecturer->name }}</td>
                                                                <td class="text-center">
                                                                    <a href="theses/{{$thesis->id}}" class="btn btn-info">Detail</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <footer class="panel-footer">
                                                <div class="row">
                                                    <div class="col-sm-offset-8 col-sm-4 text-right text-center-xs">
                                                        {!! $theses->links() !!}
                                                    </div>
                                                </div>
                                            </footer>
                                        </section>
                                    </div>


                                </div>
                                <div id="pane2" class="tab-pane">
                                    <div class="col-md-0">
                                        <section class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover b-t b-light">
                                                        <thead>
                                                        <tr>
                                                            <th class="col-lg-1 text-center">No</th>
                                                            <th class="col-lg-2 text-center">Judul Skripsi</th>
                                                            <th class="col-lg-3 text-center">Nama Mahasiswa</th>
                                                            <th class="col-lg-4 text-center">Nama Dosen Pembimbing</th>
                                                            <th class="col-lg-4 text-center">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($thesesEnd as $key => $thesis)
                                                            <tr>
                                                                <td class="text-center">{{ ($theses->currentPage() - 1) * $theses->perPage() + ($key + 1) }}</td>
                                                                <td>{{ $thesis->title }}</td>
                                                                <td>{{ $thesis->student->name }}</td>
                                                                <td>{{ $thesis->lecturer->name }}</td>
                                                                <td class="text-center">
                                                                    <a href="theses/{{$thesis->id}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <footer class="panel-footer">
                                                <div class="row">
                                                    <div class="col-sm-offset-8 col-sm-4 text-right text-center-xs">
                                                        {!! $thesesEnd->links() !!}
                                                    </div>
                                                </div>
                                            </footer>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            @endif
        </section>
    </div><!--/.row-->

@endsection