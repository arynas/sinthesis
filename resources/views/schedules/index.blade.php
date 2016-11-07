@extends('main.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Jadwal Bimbingan</h1>
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
                                <p class="p-header">

                                </p>
                            </div>
                        </div>
                    </header>
                    <div class="wrapper">
                        @if(is_null($student->thesis))
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="jumbotron text-center">
                                        <h1>Perhatian!</h1>
                                        <p>Anda harus sudah terdaftar skripsi untuk menggunakan fitur ini</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            @include('partials.success')
                            @if (session('have_date'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ session('have_date') }}
                                </div>
                            @endif
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#pane1" data-toggle="tab">Jadwal Dosen</a></li>
                                    <li><a href="#pane2" data-toggle="tab">Jadwal Saya</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="pane1" class="tab-pane active">
                                        <section class="scrollable wrapper">
                                            <section class="panel panel-default">
                                                <header class="panel-heading bg-light clearfix">
                                                    <div class="btn-group pull-right" data-toggle="buttons">
                                                        {{--<label class="btn btn-sm btn-bg btn-default active" id="monthview">--}}
                                                        {{--<input type="radio" name="options">Month--}}
                                                        {{--</label>--}}
                                                        {{--<label class="btn btn-sm btn-bg btn-default" id="weekview">--}}
                                                        {{--<input type="radio" name="options">Week--}}
                                                        {{--</label>--}}
                                                        {{--<label class="btn btn-sm btn-bg btn-default" id="dayview">--}}
                                                        {{--<input type="radio" name="options">Day--}}
                                                        {{--</label>--}}
                                                    </div>
                                                    {{--<span class="m-t-xs inline">--}}
                                                    {{--Fullcalendar--}}
                                                    {{--</span>--}}
                                                </header>
                                                <div class="calendar" id="calendar">

                                                </div>
                                            </section>
                                        </section>
                                    </div>
                                    <div id="pane2" class="tab-pane">
                                        <div class="col-md-0">
                                            <section class="panel panel-default">
                                                {{--<header class="panel-heading"> Proposal Belum Diperiksa</header>--}}
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover b-t b-light">
                                                            <thead>
                                                            <tr>
                                                                <th class="col-lg-1 text-center">No</th>
                                                                <th>Nama Dosen</th>
                                                                <th>Hari/Tanggal</th>
                                                                <th>Jam Mulai</th>
                                                                <th>Jam Berakhir</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($requests as $key => $request)
                                                                <tr>
                                                                    @if(is_null($request->conseling_schedule))
                                                                    @else
                                                                        <td class="text-center">{{ ($requests->currentPage() - 1) * $requests->perPage() + ($key + 1) }}</td>
                                                                        <td>{{ $request->conseling_schedule->lecturer->name }}</td>
                                                                        <td>{{ date("l", strtotime($request->conseling_schedule->starts_at)) }}, {{ date("d-m-Y", strtotime($request->conseling_schedule->starts_at)) }}</td>
                                                                        <td>{{ date("H:i:s", strtotime($request->conseling_schedule->starts_at)) }}</td>
                                                                        <td>{{ date("H:i:s", strtotime($request->conseling_schedule->ends_at)) }}</td>
                                                                        <td>
                                                                            @if($request->is_confirmed == 1 && date('Y-m-d H:i:s', strtotime($request->conseling_schedule->starts_at)) <= date('Y-m-d H:i:s'))
                                                                                <p style="color:blue;">Sudah lewat</p>
                                                                            @elseif(is_null($request->is_confirmed))
                                                                                <p style="color:#2e3e4e;">Belum Dikonfirmasi</p>
                                                                            @elseif($request->is_confirmed == 0)
                                                                                <p style="color:red;">Ditolak</p>
                                                                            @elseif($request->is_confirmed == 1)
                                                                                <p style="color:green;">Diterima</p>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus-{{$request->id}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                                                            <form action="/schedules/{{$request->id}}/delete" method="POST">
                                                                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                                                                <div class="modal fade" id="hapus-{{$request->id}}" tabindex="-1" role="hapus" aria-labelledby="hapus">
                                                                                    <div class="modal-dialog" role="hapus">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                                <h4 class="modal-title text-center" id="title">Anda yakin menghapus bimbingan ini?</h4>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="form-group text-left">
                                                                                                    <label><b>Hari/Tanggal</b></label><br>
                                                                                                    <label>{{ date("l", strtotime($request->conseling_schedule->starts_at)) }}, {{ date("d-m-Y", strtotime($request->conseling_schedule->starts_at)) }}</label>
                                                                                                </div>
                                                                                                <div class="form-group text-left">
                                                                                                    <label><b>Jam mulai</b></label><br>
                                                                                                    <label>{{ date("H:i:s", strtotime($request->conseling_schedule->starts_at)) }}</label>
                                                                                                </div>
                                                                                                <div class="form-group text-left">
                                                                                                    <label><b>Jam selesai</b></label><br>
                                                                                                    <label>{{ date("H:i:s", strtotime($request->conseling_schedule->ends_at)) }}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </td>

                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <footer class="panel-footer">
                                                    <div class="row">
                                                        <div class="col-sm-offset-8 col-sm-4 text-right text-center-xs">
                                                            {!! $requests->links() !!}
                                                        </div>
                                                    </div>
                                                </footer>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            @elseif(Auth::user()->role == 'lecturer')
                <section class="scrollable">
                    <header class="header header-height bg-white b-b b-light">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <p class="p-header"></p>
                            </div>
                            <div class="col-xs-15 col-md-4 text-right">
                                <p class="p-header">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#jadwal"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Buat Jadwal</button>
                                <form action="/schedules/{{$lecturer->id}}/store" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal fade" id="jadwal" tabindex="-1" role="jadwal" aria-labelledby="jadwal">
                                        <div class="modal-dialog" role="jadwal">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-center" id="title">Buat Jadwal Baru</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group text-left">
                                                        <label for="note">Tanggal</label>
                                                        <div class="input-group input-daterange">
                                                            <input type="text" class="form-control" id='datetimepicker6' value="" name="date" style="width: 150px;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-left">
                                                        <label for="note">Jam Mulai</label>
                                                        <div class="input-group input-daterange">
                                                            <input type="text" class="form-control" id='datetimepicker7' value="" name="time_starts" style="width: 150px;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-left">
                                                        <label for="note">Jam Selesai</label>
                                                        <div class="input-group input-daterange">
                                                            <input type="text" class="form-control" id='datetimepicker8' value="" name="time_ends" style="width: 150px;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-left">
                                                        <label for="note">Isi</label>
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
                                </p>
                            </div>
                        </div>
                    </header>
                    <div class="wrapper">
                        @include('partials.errors')
                        @include('partials.success')
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#pane1" data-toggle="tab">Jadwal Saya</a></li>
                                <li><a href="#pane2" data-toggle="tab">Mahasiswa Mendaftar Bimbingan</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="pane1" class="tab-pane active">
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
                                                            <th>Hari</th>
                                                            <th>Jam Mulai</th>
                                                            <th>Jam Selesai</th>
                                                            <th>Catatan</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($schedules as $key => $schedule)
                                                            @if(date('Y-m-d H:i:s', strtotime($schedule->starts_at)) >= date('Y-m-d H:i:s'))
                                                                <tr>
                                                                    <td class="text-center">{{ ($schedules->currentPage() - 1) * $schedules->perPage() + ($key + 1) }}</td>
                                                                    <td>{{ date("l", strtotime($schedule->starts_at)) }}, {{ date("d-m-Y", strtotime($schedule->starts_at)) }}</td>
                                                                    <td>{{ date("H:i:s", strtotime($schedule->starts_at)) }}</td>
                                                                    <td>{{ date("H:i:s", strtotime($schedule->ends_at)) }}</td>
                                                                    <td>{{$schedule->note}}</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus-{{$schedule->id}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                                                        <form action="/schedules/{{$schedule->id}}/delete" method="POST">
                                                                            {{ csrf_field() }} {{ method_field('DELETE') }}
                                                                            <div class="modal fade" id="hapus-{{$schedule->id}}" tabindex="-1" role="hapus" aria-labelledby="hapus">
                                                                                <div class="modal-dialog" role="hapus">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                            <h4 class="modal-title text-center" id="title">Anda yakin menghapus bimbingan ini?</h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group text-left">
                                                                                                <label><b>Hari/Tanggal</b></label><br>
                                                                                                <label>{{ date("l", strtotime($schedule->starts_at)) }}, {{ date("d-m-Y", strtotime($schedule->starts_at)) }}</label>
                                                                                            </div>
                                                                                            <div class="form-group text-left">
                                                                                                <label><b>Jam mulai</b></label><br>
                                                                                                <label>{{ date("H:i:s", strtotime($schedule->starts_at)) }}</label>
                                                                                            </div>
                                                                                            <div class="form-group text-left">
                                                                                                <label><b>Jam selesai</b></label><br>
                                                                                                <label>{{ date("H:i:s", strtotime($schedule->ends_at)) }}</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <footer class="panel-footer">
                                                    <div class="row">
                                                        <div class="col-sm-offset-8 col-sm-4 text-right text-center-xs">
                                                            {!! $schedules->links() !!}
                                                        </div>
                                                    </div>
                                                </footer>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="pane2" class="tab-pane">
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
                                                            <th>Hari</th>
                                                            <th>Mahasiswa</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($schedules as $key => $schedule)
                                                            @if(date('Y-m-d H:i:s', strtotime($schedule->starts_at)) >= date('Y-m-d H:i:s'))
                                                                <tr>
                                                                    <td class="text-center">{{ ($schedules->currentPage() - 1) * $schedules->perPage() + ($key + 1) }}</td>
                                                                    <td>{{ date("l", strtotime($schedule->starts_at)) }}, {{ date("d-m-Y", strtotime($schedule->starts_at)) }}</td>
                                                                    <td>
                                                                        <ul>
                                                                            @foreach($schedule->conseling_requests as $request)
                                                                                <li>{{$request->student->name}}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        <ul>
                                                                            @foreach($schedule->conseling_requests as $request)
                                                                                @if(is_null($request->is_confirmed))
                                                                                    <li>
                                                                                        <input type="button" class="btn btn-danger" value="Ditolak" id="off-{{$request->id}}" onclick="off{{$request->id}}();">
                                                                                        <input type="button" class="btn btn-success" value="Diterima" id="on-{{$request->id}}" onclick="on{{$request->id}}();">
                                                                                    </li>
                                                                                    <input type="hidden" value="{{$request->id}}" name="id{{$request->id}}">
                                                                                    <input type="hidden" value="{{$request->conseling_schedule_id }}" name="conseling_schedule_id{{$request->conseling_schedule_id}}">
                                                                                    <script type="text/javascript">
                                                                                        function off{{$request->id}}(){
                                                                                            currentvalue = document.getElementById('off-{{$request->id}}').value;
                                                                                            document.getElementById("on-{{$request->id}}").type="hidden";
                                                                                            $.post('/schedules/confrim',
                                                                                                    {
                                                                                                        'status': 0,
                                                                                                        'id': $('input[name=id{{$request->id}}]').val(),
                                                                                                        'conseling_schedule_id': $('input[name=conseling_schedule_id{{$request->conseling_schedule_id}}]').val(),
                                                                                                        '_token': $('input[name=_token]').val(),
                                                                                                    });
                                                                                        }
                                                                                    </script>
                                                                                    <script type="text/javascript">
                                                                                        function on{{$request->id}}(){
                                                                                            currentvalue = document.getElementById('on-{{$request->id}}').value;
                                                                                            document.getElementById("off-{{$request->id}}").type="hidden";
                                                                                            $.post('/schedules/confrim',
                                                                                                    {
                                                                                                        'status': 1,
                                                                                                        'id': $('input[name=id{{$request->id}}]').val(),
                                                                                                        'conseling_schedule_id': $('input[name=conseling_schedule_id{{$request->conseling_schedule_id}}]').val(),
                                                                                                        '_token': $('input[name=_token]').val(),
                                                                                                    });
                                                                                        }
                                                                                    </script>
                                                                                @elseif($request->is_confirmed == 1)
                                                                                    <p style="color:green">Diterima</p>
                                                                                @elseif($request->is_confirmed == 0)
                                                                                    <p style="color:red">Ditolak</p>
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <footer class="panel-footer">
                                                    <div class="row">
                                                        <div class="col-sm-offset-8 col-sm-4 text-right text-center-xs">
                                                            {!! $schedules->links() !!}
                                                        </div>
                                                    </div>
                                                </footer>
                                            </div>
                                        </div>
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

@section('styles')
    <!--Full Calendar-->
    <link href="{{ asset("css/fullcalendar.css") }}" rel="stylesheet">
    <link href="{{ asset("css/theme.css") }}" rel="stylesheet">
@endsection

@section('scripts')
    <!--Full Calendar-->
    <script src="{{ asset('js/fullcalendar.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.js"></script>

    @if(Auth::user()->role == 'student')
        @if(!is_null($student->thesis))
        <script type="application/javascript">
            !function ($) {
                $(function(){
                    // fullcalendar
                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();
                    $('.calendar').each(function() {
                        $(this).fullCalendar({
                            header: {
                                left: 'prev',
                                center: 'title',
                                right: 'next'
                            },
                            defaultView: 'agendaWeek',
                            events: [
                                    @foreach($schedules as $schedule)
                                    @if(date('Y-m-d H:i:s', strtotime($schedule->starts_at)) >= date('Y-m-d H:i:s'))
                                {
                                    title: '{{$schedule->note}}',
                                    start: '{{$schedule->starts_at}}',
                                    end: '{{$schedule->ends_at}}',
                                    url: '/schedules/{{$schedule->id}}'
                                },
                                @endif
                                @endforeach
                            ]
                        });
                    });
                });
            }(window.jQuery);
        </script>
        @endif
    @elseif(Auth::user()->role == 'lecturer')
        <script type="application/javascript">
            !function ($) {
                $(function(){
                    // fullcalendar
                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();
                    $('.calendar').each(function() {
                        $(this).fullCalendar({
                            header: {
                                left: 'prev',
                                center: 'title',
                                right: 'next'
                            },
                            defaultView: 'agendaWeek',
                            events: [
                                    @foreach($schedules as $schedule)
                                {
                                    title: '{{$schedule->note}}',
                                    start: '{{$schedule->starts_at}}',
                                    end: '{{$schedule->ends_at}}',
                                    url: 'schedules/{{$schedule->id}}'
                                },
                                @endforeach
                            ]
                        });
                    });
                });
            }(window.jQuery);
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker6').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#datetimepicker7').datetimepicker({
                    format: 'HH:mm'
                });
                $('#datetimepicker8').datetimepicker({
                    format: 'HH:mm'
                });
            });
        </script>
    @endif
@endsection