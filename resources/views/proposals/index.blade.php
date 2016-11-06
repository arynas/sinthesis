@extends('main.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Proposal</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <section class="vbox">
            <section class="scrollable">
                <div class="wrapper">
                    @include('partials.success')
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#pane1" data-toggle="tab">Belum Dicek</a></li>
                            <li><a href="#pane2" data-toggle="tab">Sudah Dicek</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="pane1" class="tab-pane active">
                                <div class="col-md-0">
                                    <section class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover b-t b-light">
                                                    <thead>
                                                    <tr>
                                                        <th class="col-lg-1 text-center">No</th>
                                                        <th>Judul Proposal</th>
                                                        <th>Nama Mahasiswa</th>
                                                        <th class="col-lg-3 text-center">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($proposals as $key => $proposal)
                                                        <tr>
                                                            <td class="text-center">{{ ($proposals->currentPage() - 1) * $proposals->perPage() + ($key + 1) }}</td>
                                                            <td>{{ $proposal->title }}</td>
                                                            <td>{{ $proposal->student->name }}</td>
                                                            <td class="text-center">
                                                                <a href="proposals/{{$proposal->id}}" class="btn btn-info">Cek</a>
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
                                                    {!! $proposals->links() !!}
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
                                                        <th class="col-lg-3 text-center">Judul Proposal</th>
                                                        <th class="col-lg-3 text-center">Nama Mahasiswa</th>
                                                        <th class="col-lg-3 text-center">Keterangan</th>
                                                        <th class="col-lg-3 text-center">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($proposalsChecked as $key => $proposal)
                                                        <tr>
                                                            <td class="text-center">{{ ($proposals->currentPage() - 1) * $proposals->perPage() + ($key + 1) }}</td>
                                                            <td>{{ $proposal->title }}</td>
                                                            <td>{{ $proposal->student->name }}</td>
                                                            <td class="text-center">
                                                                @if(!is_null($proposal->theses_id))
                                                                    <p style="color:green">Diterima<div>
                                                                @else
                                                                    <p style="color:red">Ditolak<div>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="proposals/{{$proposal->id}}" class="btn btn-info">Cek</a>
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
                                                    {!! $proposalsChecked->links() !!}
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
        </section>
    </div><!--/.row-->

@endsection