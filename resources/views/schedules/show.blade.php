@extends('main.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(Auth::user()->role == 'student')
                <h1 class="page-header">Detail Jadwal</h1>
            @elseif(Auth::user()->role == 'lecturer')
                <h1 class="page-header">Daftar Bimbingan</h1>
            @endif
        </div>
    </div><!--/.row-->

    <div class="row">
        <section class="vbox">
            @if(Auth::user()->role == 'student')
                <section class="vbox">
                    <section class="scrollable">
                        <header class="header header-height bg-white b-b b-light">
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <p class="p-header"></p>
                                </div>
                                <div class="col-xs-15 col-md-4">
                                    <p class="p-header text-right">
                                        <a href="/schedules" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    </p>
                                </div>
                            </div>
                        </header>
                        <div class="wrapper">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <form action="/schedules/{{$schedule->id}}/store" method="POST">
                                        <input type="hidden" name="student" value="{{$student->id}}">
                                        {{ csrf_field() }}
                                        <div class="panel panel-default">
                                            {{--<div class="panel-heading text-center">Data Jadwal Bimbingan</div>--}}
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <label for="" style="">Nama Dosen</label><br/>
                                                    <label for="" style="font-size: large">{{$schedule->lecturer->name}}</label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label for="" style="">Catatan</label><br/>
                                                    <label for="" style="font-size: large">{{$schedule->note}}</label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label for="" style="">Jam Mulai</label><br/>
                                                    <label for="" style="font-size: large">{{date("d-m-Y H:i", strtotime($schedule->starts_at))}}</label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label for="" style="">Jam Selesai</label><br/>
                                                    <label for="" style="font-size: large">{{date("d-m-Y H:i", strtotime($schedule->ends_at))}}</label>
                                                </li>
                                            </ul>
                                            <div class="panel-footer text-center" style="padding-top:10px;padding-bottom:10px;">
                                                <button type="submit" class="btn btn-success">Ikuti Bimbingan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </section>
                </section>
            @elseif(Auth::user()->role == 'lecturer')
                <div class="col-md-0">
                    <section class="panel panel-default">
                        {{--<header class="panel-heading"> Proposal Belum Diperiksa</header>--}}
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover b-t b-light">
                                    <thead>
                                    <tr>
                                        <th class="col-lg-1 text-center">No</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th class="col-lg-3 text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($request->students as $key => $student)
                                        <tr>
                                            {{--<td class="text-center">{{ ($requests->currentPage() - 1) * $requests->perPage() + ($key + 1) }}</td>--}}
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->nim }}</td>
                                            <td class="text-center">
                                                {{--<a href="proposals/{{$proposal->id}}" class="btn btn-info"><i class="fa fa-eye"></i></a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{--<footer class="panel-footer">--}}
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-offset-8 col-sm-4 text-right text-center-xs">--}}
                        {{--{!! $proposals->links() !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</footer>--}}
                    </section>
                </div>
            @endif
        </section>
    </div><!--/.row-->
@endsection