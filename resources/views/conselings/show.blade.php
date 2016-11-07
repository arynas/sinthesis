@extends('main.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(Auth::user()->role == 'student')
                <h1 class="page-header">Detail Bimbingan</h1>
            @elseif(Auth::user()->role == 'lecturer')
                <h1 class="page-header">Daftar Bimbingan</h1>
            @endif
        </div>
    </div><!--/.row-->

    <div class="row">
        <section class="vbox">
            @if(Auth::user()->role == 'student')
                <section class="scrollable">
                    <header class="header header-height bg-white b-b b-light">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <p class="p-header"></p>
                            </div>
                            <div class="col-xs-15 col-md-4">
                                <p class="p-header text-right">
                                    <a href="/conselings" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </p>
                            </div>
                        </div>
                    </header>
                    <div class="wrapper">
                        @include('partials.success')
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-center" style="padding-top:10px;padding-bottom:10px;">
                                        <label for="" style="font-size: large">{{$conseling->topic}}</label>
                                    </div>
                                    <div class="panel-body" style="padding: 30px">
                                        <p>{!! $conseling->content !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form action="/conselings/{{$conseling->id}}/comments/store" method="POST">
                                    <input type="hidden" name="user" value="{{$conseling->user->id}}">
                                    {{ csrf_field() }}
                                    @foreach($conseling->comments as $comment)
                                        @if($comment->user->role == 'lecturer')
                                            <div class="panel panel-default">
                                                <div class="panel-body" style="padding: 30px">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <img class="img-circle" src="{{ asset('img/lecturer.jpeg') }}" style="border: 1px solid #444;" width="100" height="100">
                                                        </div>
                                                        <div class="media-body text-justify">
                                                            <h4 class="media-heading text-left">{{$comment->user->username}}</h4>
                                                            {!! $comment->content !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($comment->user->role == 'student')
                                            <div class="panel panel-default">
                                                <div class="panel-body" style="padding: 30px">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <img class="img-circle" src="{{ asset('img/student.jpg') }}" style="border: 1px solid #444;" width="100" height="100">
                                                        </div>
                                                        <div class="media-body text-justify">
                                                            <h4 class="media-heading text-left">{{$comment->user->username}}</h4>
                                                            {!! $comment->content !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <input id="x" type="hidden" name="content">
                                            <trix-editor input="x" style="height: 150px;"></trix-editor>
                                        </div>
                                        <footer class="panel-footer" style="padding-bottom: 10px; padding-top: 10px;">
                                            <label style="color:#4cc0c1">Drag and Drop untuk mengunggah file</label>
                                            <div class="row">
                                                <div class="col-sm-offset-8 col-sm-4 text-right text-center-xs">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </footer>
                                    </div>
                                    <script type="application/javascript">
                                        document.addEventListener("trix-attachment-add", function(event) {
                                            var attachment, folder = 'comments';
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
                            </div>
                        </div>
                    </div>
                </section>
            @elseif(Auth::user()->role == 'lecturer')
                <section class="scrollable">
                    <header class="header header-height bg-white b-b b-light">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <p class="p-header"></p>
                            </div>
                            <div class="col-xs-15 col-md-4">
                                <p class="p-header text-right">
                                    <a href="/conselings" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </p>
                            </div>
                        </div>
                    </header>
                    <div class="wrapper">
                        @include('partials.success')
                        <div class="row">
                            <div class="col-md-0">
                                <section class="panel panel-default">
                                    {{--<header class="panel-heading"> Proposal Belum Diperiksa</header>--}}
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover b-t b-light">
                                                <thead>
                                                <tr>
                                                    <th class="col-lg-1 text-center">No</th>
                                                    <th>Judul Bimbingan</th>
                                                    <th>Isi</th>
                                                    <th class="col-lg-3 text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($conselings as $key => $conseling)
                                                    <tr>
                                                        <td class="text-center">{{ ($conselings->currentPage() - 1) * $conselings->perPage() + ($key + 1) }}</td>
                                                        <td>{{ $conseling->topic }}</td>
                                                        <td>{!! str_limit($conseling->content,20) !!}</td>
                                                        <td class="text-center">
                                                            <a href="/conselings/{{$conseling->id}}/comments" class="btn btn-info">Detail</a>
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
                                                {!! $conselings->links() !!}
                                            </div>
                                        </div>
                                    </footer>
                                </section>
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