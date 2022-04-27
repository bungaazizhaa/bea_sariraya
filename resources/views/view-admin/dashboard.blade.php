@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Dashboard Beasiswa Sariraya</title>
@endsection
@section('title')
    <h4 class="m-0 p-0">Dashboard</h4>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Main content -->
        {{-- <div class="col-lg-3 col-6">
                <!-- small box -->
                <div onclick="location.href='{{ route('periode', $periodeOpenned->id) }}'"
                    class="small-box bg-info rounded-md myshadow">
                    <div class="inner">
                        <h3>5</h3>
                        <p>Status Periode</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('periode', $periodeOpenned->id) }}" class="small-box-footer rounded-bottom-md">More
                        info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div> --}}
    </div>
@endsection
