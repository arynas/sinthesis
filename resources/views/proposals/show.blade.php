@extends('main.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Detail Proposal</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <section class="vbox">
            <section class="scrollable">
                <header class="header header-height bg-white b-b b-light">
                    <div class="col-xs-12 col-md-8">
                        <p class="p-header"></p>
                    </div>
                    <div class="col-xs-15 col-md-4">
                        <p class="p-header text-right">
                            <a href="/proposals" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </p>
                    </div>
                </header>

                <div class="wrapper">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            @include ('partials.errors')
                            @if(is_null($proposal->is_check))
                                <div class="panel panel-default">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <label for="" style="">Proposal</label><br/>
                                            <label for="" style="font-size: large">{{$proposal->title}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Nama Mahasiswa</label><br/>
                                            <label for="" style="font-size: large">{{$proposal->student->name}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">NIM</label><br/>
                                            <label for="" style="font-size: large">{{$proposal->student->nim}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/proposals/{{$proposal->file->id}}/download" class="btn btn-default btn-md" role="button">
                                                <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download Proposal
                                            </a>
                                        </li>
                                    </ul>
                                        <div class="panel-footer text-center" style="padding-top:10px;padding-bottom:10px;">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tolak">Tolak</button>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#terima">Terima</button>

                                            <form action="/proposals/{{$proposal->id}}/reject" method="POST">
                                                {{ csrf_field() }}
                                                <div class="modal fade" id="tolak" tabindex="-1" role="tolak" aria-labelledby="tolak">
                                                    <div class="modal-dialog" role="tolak">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="title">{{$proposal->title}}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group text-left">
                                                                    <label for="note">Catatan</label>
                                                                    <textarea class="form-control" rows="3" name="note"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <form action="/proposals/{{$proposal->id}}/accept" method="POST">
                                                <input type="hidden" name="student" value="{{$proposal->student->id}}">
                                                <input type="hidden" name="title" value="{{$proposal->title}}">
                                                {{ csrf_field() }}
                                                <div class="modal fade" id="terima" tabindex="-1" role="terima" aria-labelledby="terima">
                                                    <div class="modal-dialog" role="terima">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="title">{{$proposal->title}}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group text-left">
                                                                    <label for="note">Catatan</label>
                                                                    <textarea class="form-control" rows="3" name="note"></textarea>
                                                                </div>
                                                                <div class="form-group text-left">
                                                                    <label for="selectLecturer">Dosen Pembimbing Tesis</label>
                                                                    <select class="form-control" name="lecturer">
                                                                        <option value="" disabled selected>Pilih dosen</option>
                                                                        @foreach($lecturers as $lecturer)
                                                                            <option value="{{$lecturer->id}}">{{$lecturer->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group text-left">
                                                                    <label for="selectSemester">Semester</label>
                                                                    <select class="form-control" name="semester">
                                                                        <option value="" disabled selected>Pilih semester</option>
                                                                        <option value="Ganjil">Ganjil</option>
                                                                        <option value="Genap">Genap</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group text-left">
                                                                    <label for="selectTime">Waktu Tesis</label>
                                                                    <div class="input-group input-daterange">
                                                                        <span class="input-group-addon">Mulai</span>
                                                                        <input type="text" class="form-control" id='datetimepicker6' value="" name="starts_at">
                                                                        <span class="input-group-addon">Selesai</span>
                                                                        <input type="text" class="form-control" id='datetimepicker7' value="" name="ends_at">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                </div>
                            @else
                                <div class="panel panel-default">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <label for="" style="">Judul Proposal</label><br/>
                                            <label for="" style="font-size: large">{{$proposal->title}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Nama Mahasiswa</label><br/>
                                            <label for="" style="font-size: large">{{$proposal->student->name}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">NIM</label><br/>
                                            <label for="" style="font-size: large">{{$proposal->student->nim}}</label>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/proposals/{{$proposal->file->id}}/download" class="btn btn-default btn-md" role="button">
                                                <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download Proposal
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="" style="">Keterangan</label><br/>
                                            @if(!is_null($proposal->theses_id))
                                                <p style="color:green">Diterima<div>
                                            @else
                                                <p style="color:red">Ditolak<div>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </section>
        </section>
    </div><!--/.row-->

@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker6').datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $('#datetimepicker7').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                format: 'DD-MM-YYYY'
            });
            $("#datetimepicker6").on("dp.change", function (e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker7").on("dp.change", function (e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);

            });

        });
    </script>
@endsection