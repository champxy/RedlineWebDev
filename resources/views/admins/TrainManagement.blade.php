@extends('adminlte::page')

@section('title', 'ข้อมูลสถานีทั้งหมด')

@section('content_header')
    {!! displayAlert() !!}
    {!! admin_check(session()->all()) !!}
    <h5 class="text-dark">ข้อมูลสถานีทั้งหมด</h5>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 overflow-auto">
                        <table id="usertable" style="border-radius: 15px;"
                            class="table table-xl table-hover table-light border-1">
                            <thead>
                                <div class="row mb-3">
                                    <button type="button" class="btn btn-primary btn-sm ml-2" style="border-radius: 7px;">
                                        All <span class="badge badge-light">
                                            {{ count(array_filter($train)) }}
                                        </span>
                                    </button>
                                    {{-- <div class="ml-auto">
                                        <a class="btn btn-success btn-xl" href="">เพิ่มข้อมูล</a>
                                    </div> --}}
                                </div>
                                <tr>
                                    <th>#</th>
                                    <th width="200px">ชื่อสถานี</th>
                                    <th>จำนวนทางออก</th>
                                    <th>การใช้งาน</th>
                                    <th>การแสดงความคิดเห็น</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($train as $tkey => $data_train)
                                    @if ($data_train)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{route('admin.adminStation.edit',$tkey)}}">{{ $data_train['station_name'] }}</a> <br>
                                                <div data-parent="#accordion">
                                                    <small class="text-muted">
                                                    </small>
                                                </div>
                                            </td>
                                            <td class="text-md">
                                                @foreach ($data_train['ExitDoors'] as $ekey => $exdor_data)
                                                    @if ($exdor_data != null)
                                                        <a href="{{route('admin.setting.edit.door',[$ekey,$tkey])}}" class="badge badge-dark">
                                                            {{ $exdor_data['exdor_name'] }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-md">
                                                {{-- <span class="badge badge-success w-100" style="width: 30%;"> --}}
                                                    @php
                                                        $count_route = 0;
                                                    @endphp
                                                    @foreach ($users as $user_route)
                                                        @if (!empty($user_route['Routes']))
                                                            @foreach ($user_route['Routes'] as $routes_check)
                                                                @if ($routes_check != null)
                                                                    @if ($routes_check['start'] === $tkey)
                                                                        @php
                                                                            $count_route++;
                                                                        @endphp
                                                                    @endif
                                                                    @if ($routes_check['end'] === $tkey)
                                                                        @php
                                                                            $count_route++;
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    @php
                                                        if(number_format($count_route)!=0){
                                                            echo number_format($count_route);
                                                        }else{
                                                            echo 'The station is not yet in use.';
                                                        }
                                                    @endphp
                                                {{-- </span> --}}
                                            </td>
                                            <td class="text-md">
                                                {{-- <span class="badge badge-primary w-100" style="width: 30%;"> --}}
                                                    @php
                                                        $count_station = 0;
                                                    @endphp
                                                    @foreach ($comment as $stkey => $cmd)
                                                        @php
                                                            if ($stkey === $tkey) {
                                                                foreach ($cmd as $cdkey => $check_comment) {
                                                                    if ($check_comment != null) {
                                                                        $count_station += count(
                                                                            array_filter($check_comment),
                                                                        );
                                                                    }
                                                                }
                                                            }

                                                        @endphp
                                                    @endforeach
                                                    @php
                                                        if($count_station!=0){
                                                            echo number_format($count_station);
                                                        }else{
                                                            echo 'No Comment';
                                                        }
                                                    @endphp
                                                {{-- </span> --}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <style>
            table th,
            td {
                font-size: 0.8rem;
            }

            .paginate_button,
            .dataTables_length,
            .dataTables_filter,
            .dataTables_info {
                font-size: 0.8rem;
            }

            .slider-round {
                height: 10px;
            }

            .slider-round .noUi-connect {
                background: #252525;
            }

            .slider-round .noUi-handle {
                height: 18px;
                width: 18px;
                top: -5px;
                right: -9px;
                border-radius: 9px;
            }

            .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;

            }
        </style>
        <script>
            $(document).ready(function() {
                $('#usertable').DataTable({
                    "paging": true,
                    "pageLength": 13
                });
            });
        </script>
        <script src="{{ asset('js/hostJS.js') }}"></script>
    @endsection
