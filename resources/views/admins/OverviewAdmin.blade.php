@extends('adminlte::page')

@section('title', 'Redline Overview')

@section('content_header')
    {!! displayAlert() !!}
    {!! admin_check(session()->all()) !!}
    <link rel="stylesheet" href="{{ asset('css/settingAdmin.css') }}">
@endsection

@section('content')
    <div class="contianer">
        {{-- Header Content --}}
        <div class="row">
            @php
                $color_badge = [
                    '#267365',
                    '#F2CB05',
                    '#F29F05',
                    '#F23030',
                    '#F28705',
                    '#0597F2',
                    '#49D907',
                    '#970FF2',
                    '#402E1E',
                    '#747C8C',
                    '#FF81D0',
                    '#105057',
                    '#919151',
                    '#404040',
                    '#bbddff',
                ];
            @endphp
            <div class="col-6 col-md-2 col-xl-2">
                <a href="#">
                    <div class="card" style="border-radius: 20px;">
                        <div class="card-body mx-2">
                            <div class="row">
                                <h3><i class="fa-duotone fa-users"
                                        style="--fa-primary-color: #1355c9; --fa-secondary-color: #1355c9;"></i>
                                    <b class="ml-1">
                                        @if ($users)
                                            @php
                                                $count_user = count($users);
                                                echo $count_user - 1;
                                            @endphp
                                        @endif
                                    </b>
                                </h3>
                            </div>
                            <div class="row">
                                <h6 class="text-muted mt-2 ml-1">จำนวนผู้ใช้</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 col-xl-2">
                <a href="">
                    <div class="card" style="border-radius: 20px;">
                        <div class="card-body mx-2">
                            <div class="row">
                                <h3><i class="fa-duotone fa-train" style="color: #1fab15;"></i>
                                    <b class="ml-1 text-dark">
                                        @if ($transtation)
                                            {{ count($transtation) }}
                                        @endif
                                    </b>
                                </h3>
                            </div>
                            <div class="row">
                                <h6 class="text-muted mt-2 ml-1">จำนวนสถานี</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 col-xl-2">
                <a href="">
                    <div class="card" style="border-radius: 20px;">
                        <div class="card-body mx-2">
                            <div class="row">
                                <h3><i class="fa-solid fa-comments" style="color: #cc1427;"></i>
                                    <b class="ml-1 text-dark">
                                        @if ($comment)
                                            @php
                                                $count_comment = 0;
                                                foreach ($comment as $station_data) {
                                                    if ($station_data != null) {
                                                        foreach ($station_data as $rkey => $door_data) {
                                                            if ($door_data != null) {
                                                                foreach ($door_data as $ckey => $cmd) {
                                                                    if ($cmd != null) {
                                                                        $count_comment++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                echo $count_comment;
                                            @endphp
                                        @endif
                                    </b>
                                </h3>
                            </div>
                            <div class="row">
                                <h6 class="text-muted mt-2 ml-1">จำนวนคอมเมนท์</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-2 col-xl-2">
                <a href="#">
                    <div class="card" style="border-radius: 20px;">
                        <div class="card-body mx-2">
                            <div class="row">
                                <h3><i class="fa-solid fa-route"
                                        style="--fa-primary-color: #e6c10a; --fa-secondary-color: #e6c10a;"></i>
                                    <b class="ml-1 text-dark">
                                        @if ($users)
                                            @php
                                                $count = 0;
                                                foreach ($users as $route) {
                                                    if (isset($route['Routes']) && $route['Routes'] != null) {
                                                        $count += count(array_filter($route['Routes']));
                                                    }
                                                }
                                                if ($count != 0) {
                                                    echo $count;
                                                }
                                            @endphp
                                        @endif
                                    </b>
                                </h3>
                            </div>
                            <div class="row">
                                <h6 class="text-muted mt-2 ml-1">จำนวนการเดินทาง</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-4 col-xl-4">
                <div class="card" style="border-radius: 20px;">
                    <div class="card-body mx-2">
                        <div class="row mt-1">
                            <small class="text-primary">เจริญรุ่งเรืองกิจ</small>
                            <small class="ml-1 text-primary"> has updated at (01/10/23 10:50)</small>
                        </div>
                        <div class="row mt-1">
                            <small class="text-primary">เจริญรุ่งเรืองกิจ</small>
                            <small class="ml-1 text-primary"> has updated at (01/10/23 10:50)</small>
                        </div>
                        <div class="row mt-1">
                            <small class="text-primary">เจริญรุ่งเรืองกิจ</small>
                            <small class="ml-1 text-primary"> has updated at (01/10/23 10:50)</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="card" style="border-radius: 20px;">
                    <div class="card-body mx-2">
                        <div class="row my-3">
                            <div class="col-12 col-md-6 col-xl-8" style="width:350px;">
                                <h5 class="text-bold">สถานีรถไฟฟ้าสายสีแดง</h5><button onclick="window.print()"
                                    style="border-radius: 7px;" class="btn btn-outline-primary">Print</button>
                                <small class="text-muted">รายละเอียดข้อมูลรถไฟฟ้า</small>
                                <div class="row mt-3">
                                    <div class="col">
                                        <h6>ชื่อสถานีรถไฟฟ้า</h6>
                                        <hr>
                                        @foreach ($transtation as $key => $station)
                                            <span class="badge-pill badge ">{{ $key }}</span><small
                                                class="text-muted ml-2">{{ $station['station_name'] }}</small><br>
                                        @endforeach
                                    </div>

                                    <div class="col">
                                        <h6>จำนวนการใช้งาน</h6>
                                        <hr>
                                        <div class="row">
                                            <div class="col" style="padding-right: 20px;">
                                                @php
                                                    $num_useRoute = [];
                                                    $name_station = [];
                                                    $index_route = 0;
                                                @endphp

                                                @if ($transtation != null)
                                                    @foreach ($transtation as $key => $station)
                                                        @php
                                                            $count_uses = 0;
                                                            if (isset($station) || $station != null) {
                                                                foreach ($users as $rkey => $route) {
                                                                    if ($route !== null && is_array($route['Routes'])) {
                                                                        foreach ($route['Routes'] as $cmkey => $st_end) {
                                                                            if((isset($st_end)&&($st_end!==null))){
                                                                                if ($st_end['start'] === $key) {
                                                                                $count_uses++;
                                                                                }
                                                                                if ($st_end['end'] === $key) {
                                                                                    $count_uses++;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        <span
                                                            class="badge badge-pill badge-lg text-sm text-white w-50 text-left"
                                                            style="background-color: {{ $color_badge[$index_route] }};">{{ $station['station_name'] }}</span>
                                                        <span class="badge-pill text-bold">
                                                            @php
                                                                if ($station !== null) {
                                                                    $num_useRoute[] += $count_uses;
                                                                    $name_station[$index_route] =
                                                                        $station['station_name'];
                                                                }
                                                            @endphp
                                                            @if ($count_uses != 0)
                                                                {{ number_format($count_uses) }}
                                                            @endif
                                                        </span><small class="text-muted ml-2"></small><br>
                                                        @php
                                                            $index_route++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                                <input type="hidden" id="num_routes"
                                                    value="{{ json_encode($num_useRoute) }}">
                                                <input type="hidden" id="station_name"
                                                    value="{{ json_encode($name_station) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <a name="" id="" style="border-radius: 7px;"
                                            class="btn btn-outline-light btn-sm" href="#" role="button">See more
                                            deatil..</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-xl-4" style="width:350px;">
                                <canvas id="station"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-xl-6">
                <div class="card" style="border-radius: 20px;">
                    <div class="card-body">
                        <h5 class="text-bold mt-2 mx-2">รายการเดินทางล่าสุด <i class="fa-duotone fa-person-walking"></i>
                        </h5>
                        <small class="text-muted ml-2">การเดินทางจากสถานีต้นทาง - ปลายทาง</small>
                        <table class="table">
                            <tbody>
                                @if ($users)
                                    @foreach ($users as $key => $route)
                                        @if ($route !== null)
                                            @php
                                                if ($route['Routes']) {
                                                    $last = end($route['Routes']);
                                                }
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <input type="checkbox" name="" id=""
                                                            autocomplete="off">
                                                    </div>
                                                </td>
                                                <td>{{ $route['name'] }}<br>
                                                    <small class="text-muted">{{ $last['created_date'] }}</small>
                                                </td>
                                                <td>
                                                    <small></small>
                                                </td>
                                                <td><span class="badge badge-primary text-sm">
                                                        @php
                                                            foreach ($transtation as $rkey => $value) {
                                                                if ($rkey != null) {
                                                                    if ($rkey === $last['start']) {
                                                                        echo $value['station_name'];
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                    </span>
                                                    <span class="badge badge-success text-sm">
                                                        @php
                                                            foreach ($transtation as $rkey => $value) {
                                                                if ($rkey != null) {
                                                                    if ($rkey === $last['end']) {
                                                                        echo $value['station_name'];
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                    </span>
                                                </td>
                                                @if ($loop->iteration == 13)
                                                @break
                                            @endif
                                    @endif
                                @endforeach
                            @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <a type="button" href="{{route('admin.management_train')}}" style="border-radius: 7px"
                        class="btn btn-sm btn-outline-success">
                        รายละเอียดเพิ่มเติม</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-6">
            <div class="card" style="border-radius: 20px;">
                <div class="card-body">
                    <h5 class="text-bold mt-2 mx-2">การแสดงความคิดเห็นล่าสุด <i
                            class="fa-duotone fa-person-walking"></i>
                    </h5>
                    <small class="text-muted ml-2">รายการแสดงความคิดเห็นสถานีล่าสุด</small>
                    <table class="table">
                        <tbody>
                            @if ($comment)
                                @foreach ($comment as $key => $user_comment)
                                    @if ($user_comment !== null)
                                        @foreach ($user_comment as $tkey => $comment)
                                            @if ($comment != null)
                                                @php
                                                    $last_cmd = end($comment);
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="btn-group" data-toggle="buttons">
                                                            <input type="checkbox" name="" id=""
                                                                autocomplete="off">
                                                        </div>
                                                    </td>
                                                    <td>{{ $last_cmd['user'] }} @php

                                                    @endphp<br>
                                                        <small class="text-muted">{{ $last_cmd['time'] }} /
                                                            @php
                                                                foreach ($transtation as $rkey => $value) {
                                                                    if ($rkey != null) {
                                                                        if ($rkey === $key) {
                                                                            echo $value['station_name'];
                                                                        }
                                                                    }
                                                                }
                                                                echo ' (ทางออก ' . $tkey . ')';
                                                            @endphp</small>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-pill badge-light">
                                                            @php
                                                                if (isset($last_cmd['wholike'])) {
                                                                    echo count($last_cmd['wholike']);
                                                                    echo ' <i class="fa-solid fa-heart" style="color: #fa2e2e;"></i>';
                                                                }
                                                            @endphp
                                                        </span>

                                                    </td>
                                                    <td>
                                                        <small>{{ $last_cmd['message'] }}</small>
                                                    </td>
                                            @endif
                                        @endforeach
                                        @if ($loop->iteration == 13)
                                        @break
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <a type="button" href="{{route('admin.management.user')}}" style="border-radius: 7px"
                    class="btn btn-sm btn-outline-success">
                    รายละเอียดเพิ่มเติม</a>
            </div>
        </div>
    </div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const circle = document.getElementById('station');
    const data_route = JSON.parse(document.getElementById('num_routes').value);
    const data_name = JSON.parse(document.getElementById('station_name').value);
    var color_badge = [
        '#267365',
        '#F2CB05',
        '#F29F05',
        '#F23030',
        '#F28705',
        '#0597F2',
        '#49D907',
        '#970FF2',
        '#402E1E',
        '#747C8C',
        '#FF81D0',
        '#105057',
        '#919151',
        '#404040',
        '#bbddff'
    ];
    new Chart(circle, {
        type: 'doughnut',
        data: {
            labels: data_name,
            datasets: [{
                data: data_route,
                backgroundColor: color_badge,
            }]
        },
        options: {
            legend: {
                display: false,
            },
            plugins: {
                datalabels: {
                    display: true,
                    formatter: (val, ctx) => {
                        const label = ctx.chart.data.labels[ctx.dataIndex];
                        const formattedVal = Intl.NumberFormat('en-US', {
                            minimumFractionDigits: 2,
                        }).format(val);
                        return `${label}: ${formattedVal}`;
                    },
                    color: '#fff',
                    backgroundColor: '#404040',
                },
            },
        },
    }, );
</script>

@endsection
@section('plugins.Datatables', true)
