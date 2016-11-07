@extends('main.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(Auth::user()->role == 'student')
                <h1 class="page-header">Bimbingan</h1>
            @elseif(Auth::user()->role == 'lecturer')
                <h1 class="page-header">Daftar Bimbingan</h1>
            @endif
        </div>
    </div><!--/.row-->

    <div class="row">
        <section class="vbox">
            @if(Auth::user()->role == 'student')
                @if(!is_null($student->thesis))
                    <section class="scrollable">
                        <header class="header header-height bg-white b-b b-light">
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <p class="p-header"></p>
                                </div>
                                <div class="col-xs-15 col-md-4">
                                    <p class="p-header text-right">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#bimbingan"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Buat Bimbingan</button>
                                    <form action="/conselings/{{$userActive->id}}/store" method="POST">
                                        <input type="hidden" value="{{$student->thesis->id}}" name="thesis">
                                        {{ csrf_field() }}
                                        <div class="modal fade" id="bimbingan" tabindex="-1" role="bimbingan" aria-labelledby="bimbingan">
                                            <div class="modal-dialog" role="bimbingan">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title text-center" id="title">Buat Topik Bimbingan Baru</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group text-left">
                                                            <label for="note">Topik</label>
                                                            <input type="text" class="form-control" placeholder="" name="topic">
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label for="note">Isi</label>
                                                            <input id="x" type="hidden" name="content">
                                                            <trix-editor input="x" style="height: 150px;"></trix-editor>
                                                        </div>
                                                        <label style="color:#4cc0c1">Drag and Drop untuk mengunggah file</label>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="application/javascript">
                                            document.addEventListener("trix-attachment-add", function(event) {
                                                var attachment, folder = 'conselings';
                                                attachment = event.attachment;
                                                if (attachment.file) {
                                                    storeFile(attachment.file, folder, function(file) {
                                                        attachment.setAttributes({
                                                            url: file.url_download,
                                                            href: file.url_download
                                                        });
                                                    }, function(progress) {
                                                        attachment.setUploadProgress(progress);
                                                    });
                                                }
                                            });
                                        </script>
                                    </form>
                                    </p>
                                </div>
                            </div>
                        </header>
                        <div class="wrapper">
                            @include('partials.success')
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    @include ('partials.errors')
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center" style="padding-top:10px;padding-bottom:10px;">
                                            <label for="" style="font-size: large">Riwayat Bimbingan</label>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="col-lg-1 text-center">No</th>
                                                    <th>Topik Bimbingan</th>
                                                    <th class="text-center">Isi</th>
                                                    <th class="col-lg-3 text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($conselings as $key => $conseling)
                                                    <tr>
                                                        <td class="text-center">{{ ($conselings->currentPage() - 1) * $conselings->perPage() + ($key + 1) }}</td>
                                                        <td>{{$conseling->topic}}</td>
                                                        <td>{!! str_limit($conseling->content,20)!!}</td>
                                                        <td class="text-center">
                                                            <a href="conselings/{{$conseling->id}}/show" class="btn btn-info">Detail</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <footer class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-offset-8 col-sm-4 text-right text-center-xs">
                                                    {!! $conselings->links() !!}
                                                </div>
                                            </div>
                                        </footer>
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
                                    <p class="p-header">Bimbingan</p>
                                </div>
                            </div>
                        </header>
                        <div class="wrapper">
                            @include('partials.success')
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="jumbotron text-center">
                                        <h1>Perhatian!</h1>
                                        <p>Anda harus sudah terdaftar skripsi untuk menggunakan fitur ini</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @elseif(Auth::user()->role == 'lecturer')
                <section class="scrollable">
                    <header class="header header-height bg-white b-b b-light">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <p class="p-header"></p>
                            </div>
                            <div class="col-xs-15 col-md-4">

                            </div>
                        </div>
                    </header>
                    <div class="wrapper">
                        @include('partials.success')
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                <div class="panel panel-default">
                                    {{--<div class="panel-heading text-center" style="padding-top:10px;padding-bottom:10px;">--}}
                                    {{--<label for="" style="font-size: large">Riwayat Bimbingan</label>--}}
                                    {{--</div>--}}
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th class="col-lg-1 text-center">No</th>
                                                <th class="col-lg-2">Nama Mahasiswa</th>
                                                <th>NIM</th>
                                                <th>Judul Skripsi</th>
                                                <th class="col-lg-2 text-left">Action</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($conselings as $key => $conseling)
                                                <tr>
                                                    <td class="text-center">{{ ($conselings->currentPage() - 1) * $conselings->perPage() + ($key + 1) }}</td>
                                                    <td>{{$conseling->student->name}}</td>
                                                    <td>{{$conseling->student->nim}}</td>
                                                    <td>{{$conseling->title}}</td>
                                                    <td class="text-left">
                                                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#detail"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
                                                        <a href="/conselings/{{$conseling->student->id}}/show" class="btn btn-default btn-xs" role="button">
                                                            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                                        </a>
                                                        @if($conseling->is_finished != 1)
                                                            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#selesai-{{$conseling->id}}"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></button>
                                                        @endif
                                                        <form action="/theses/{{$conseling->id}}/finish" method="POST">
                                                            {{ csrf_field() }}
                                                            <div class="modal fade" id="selesai-{{$conseling->id}}" tabindex="-1" role="selesai" aria-labelledby="selesai">
                                                                <div class="modal-dialog" role="selesai">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header text-center">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="title">Konfirmasi</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                Apakah Anda yakin skripsi mahasiswa bernama {{$conseling->student->name}} sudah selesai?
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Yaa</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <div class="modal fade" id="detail" tabindex="-1" role="detail" aria-labelledby="detail">
                                                            <div class="modal-dialog" role="detail">
                                                                <div class="modal-content">
                                                                    {{--<div class="modal-header">--}}
                                                                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                                                    {{--<h4 class="modal-title" id="title">Detail</h4>--}}
                                                                    {{--</div>--}}
                                                                    <div class="modal-body text-left">
                                                                        <div class="panel panel-default">
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item">
                                                                                    <label for="" style="">Judul Skripsi</label><br/>
                                                                                    <label for="" style="font-size: large">{{$conseling->title}}</label>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <label for="" style="">Nama Mahasiswa</label><br/>
                                                                                    <label for="" style="font-size: large">{{$conseling->student->name}}</label>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <label for="" style="">NIM</label><br/>
                                                                                    <label for="" style="font-size: large">{{$conseling->student->nim}}</label>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <label for="" style="">Mulai</label><br/>
                                                                                    <label for="" style="font-size: large">{{$conseling->starts_at}}</label>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <label for="" style="">Selesai</label><br/>
                                                                                    <label for="" style="font-size: large">{{$conseling->ends_at}}</label>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <label for="" style="">Semester</label><br/>
                                                                                    <label for="" style="font-size: large">{{$conseling->semester}}</label>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </td>
                                                    <td class="text-center font-bold">
                                                        @if($conseling->is_finished == 1)
                                                            <p style="color: green">Selesai</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <footer class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-offset-8 col-sm-4 text-right text-center-xs">
                                                {!! $conselings->links() !!}
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </section>
    </div><!--/.row-->
@endsection
@section('styles')
    <!--Bootstrap Trix-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/0.9.5/trix.css" type="text/css" />
@endsection
@section('scripts')
    <!--Bootsrap Trix-->
    <script src="{{ asset("js/app.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/0.9.5/trix.js"></script>
    <script src="{{ asset('js/attachments.js')}}"></script>
    <script src="{{ asset("js/html-docx.js") }}"></script>
    <script src="{{ asset("js/FileSaver.js") }}"></script>
@endsection