@extends('main.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Detail Bimbingan</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <section class="vbox">
                <section class="scrollable">
                    <header class="header header-height bg-white b-b b-light">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <p class="p-header">Isi Bimbingan</p>
                            </div>
                            <div class="col-xs-15 col-md-4">
                                <p class="p-header text-right">
                                    <a href="/conselings/{{$conseling->thesis->student->id}}/show" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
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
                                    <!-- <footer class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-offset-8 col-sm-4 text-right text-center-xs">

                                            </div>
                                        </div>
                                    </footer> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form action="/conselings/{{$conseling->id}}/comments/store" method="POST">
                                    <input type="hidden" name="user" value="{{$userActive->id}}">
                                    {{ csrf_field() }}
                                    {{--<div class="panel-heading text-center" style="padding-top:10px;padding-bottom:10px;">--}}
                                    {{--<label for="" style="font-size: large">Komentar</label>--}}
                                    {{--</div>--}}
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
                                                            {!!$comment->content!!}
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