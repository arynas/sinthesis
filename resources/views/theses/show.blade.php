@extends('main.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Detail Skripsi</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <section class="vbox">
            @if($thesis->is_finished == 0)
                <section class="scrollable">
                    <header class="header header-height bg-white b-b b-light">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <p class="p-header"></p>
                            </div>
                            <div class="col-xs-15 col-md-4 text-right">
                                <p class="p-header">
                                    <a href="/theses" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </p>
                            </div>
                        </div>
                    </header>
                    <div class="wrapper">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="panel panel-default">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <label for="" style="">Judul Skripsi</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->title}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Nama Mahasiswa</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->student->name}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">NIM</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->student->nim}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Dosen Pembimbing</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->lecturer->name}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Semester</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->semester}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Tanggal Mulai</label><br/>
                                            <label for="" style="font-size: large">{{date("d-m-Y", strtotime($thesis->starts_at))}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Tanggal Selesai</label><br/>
                                            <label for="" style="font-size: large">{{date("d-m-Y", strtotime($thesis->ends_at))}}</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            @else
                <section class="scrollable">
                    <header class="header header-height bg-white b-b b-light">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <p class="p-header">Detail Skripsi</p>
                            </div>
                        </div>
                    </header>
                    <div class="wrapper">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="panel panel-default">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <label for="" style="">Judul Skripsi</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->title}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Nama Mahasiswa</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->student->name}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">NIM</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->student->nim}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Dosen Pembimbing</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->lecturer->name}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Semester</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->semester}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Tanggal Mulai</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->starts_at}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Tanggal Selesai</label><br/>
                                            <label for="" style="font-size: large">{{$thesis->ends_at}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Bimbingan Terakhir</label><br/>
                                            @if(!is_null($conseling))
                                                <label for="" style="font-size: large">{{date("d-m-Y H:i", strtotime($conseling->created_at))}}</label>
                                            @else
                                                <label for="" style="font-size: large">Belum ada bimbingan</label>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            @endif
        </section>
    </div><!--/.row-->

@endsection