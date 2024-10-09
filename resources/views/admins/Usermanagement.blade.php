@extends('adminlte::page')

@section('title', 'ข้อมูลผู้ใช้ทั้งหมด')

@section('content_header')
    {!! displayAlert() !!}
    {!! admin_check(session()->all()) !!}
    <h5 class="text-dark">ข้อมูลผู้ใช้ทั้งหมด</h5>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 overflow-auto">
                        <table id="usertable" style="border-radius: 15px;"
                            class="table table-md table-hover table-light border-1">
                            <thead>
                                <div class="row mb-3">
                                    <button type="button" class="btn btn-primary btn-sm ml-2" style="border-radius: 7px;">
                                        All <span class="badge badge-light">
                                            {{ count(array_filter($users)) }}
                                        </span>
                                    </button>
                                </div>
                                <tr>
                                    <th>#</th>
                                    <th width="300px">ชื่อผู้ใช้</th>
                                    <th>อีเมล์</th>
                                    <th>วันที่ใช้งานล่าสุด</th>
                                    <th class="text-center">จำนวนการเดินทาง</th>
                                    <th class="text-center">จำนวนการแสดงความคิดเห็น</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $ukey => $data_user)
                                    @if ($data_user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="#">{{ $data_user['name'] }}</a> <br>
                                                <div data-parent="#accordion">
                                                    <small class="text-muted">
                                                        {{ $data_user['created_date'] }}
                                                    </small>
                                                </div>
                                            </td>
                                            <td>{{ $data_user['email'] }}</td>
                                            <td>{{ $data_user['update_date'] }}</td>
                                            <td class="text-center">
                                                <a href="#" type="button" data-toggle="modal"
                                                data-target="#modelIdRoute_{{$ukey}}">
                                                    @php
                                                        if ($data_user['Routes'] != null) {
                                                            echo count(array_filter($data_user['Routes']));
                                                        }
                                                    @endphp
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" type="button" data-toggle="modal"
                                                    data-target="#modelIdComment_{{ $ukey }}">
                                                    @php
                                                        $num_comment = 0;
                                                        foreach ($comment as $key => $cmd) {
                                                            if ($cmd != null) {
                                                                foreach ($cmd as $ckey => $user_check) {
                                                                    if ($user_check != null) {
                                                                        foreach ($user_check as $gkey => $user_name) {
                                                                            if ($user_name != null) {
                                                                                if (
                                                                                    $user_name['user'] === $data_user['name']
                                                                                ) {
                                                                                    $num_comment++;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        echo $num_comment;
                                                    @endphp
                                                </a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modelIdRoute_{{$ukey}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleIdRoute_{{$ukey}}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content" style="border-radius: 17px;">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ $data_user['name'] }} : Routes</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <div class="modal-body text-md">
                                                                
                                                                    @if((is_array($data_user['Routes'])))
                                                                        @foreach ($data_user['Routes'] as $rtkey => $user_routes) 
                                                                            @if(($user_routes!=null)&&(isset($user_routes)))
                                                                                <div class="card">
                                                                                    <div class="card-body text-left">
                                                                                        <h4 class="card-title">
                                                                                            @foreach ($train as $tnkey => $train_checkRoute )
                                                                                            @if($tnkey===$user_routes['start'])
                                                                                                <span class="badge badge-pill">{{$train_checkRoute['station_name']}}</span> :
                                                                                            @endif
                                                                                            @if($tnkey===$user_routes['end'])
                                                                                                <span class="badge badge-pill ">{{$train_checkRoute['station_name']}}</span>
                                                                                            @endif
                                                                                        </h4>
                                                                                            @endforeach
                                                                                        <small class="card-text text-left text-muted">{{$user_routes['created_date']}}</small>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                    @endif 
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modelIdComment_{{ $ukey }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="modelTitleIdComment_{{ $ukey }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content" style="border-radius: 17px;">
                                                            <div class="modal-header bg-primary">
                                                                <h5 class="modal-title">{{ $data_user['name'] }} : Comments
                                                                </h5>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">

                                                                    @foreach ($comment as $stkey => $cmd)
                                                                        @foreach ($cmd as $exdorkey => $user_comment)
                                                                            @foreach ($user_comment as $data_comment)
                                                                                @if ($data_comment['user'] === $data_user['name'])
                                                                                    <div class="card">
                                                                                        <div class="card-header">
                                                                                            @php
                                                                                                
                                                                                                foreach ($train as $realtrainkey => $train_data) {
                                                                                                    if($stkey===$realtrainkey){
                                                                                                        echo $train_data['station_name'];
                                                                                                    }
                                                                                                }
                                                                                            @endphp
                                                                                            ทางออก : {{$exdorkey}}
                                                                                        </div>
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <h6 class="card-title">{{$data_comment['message']}}</h6>
                                                                                                <div class="ml-auto">
                                                                                                    <p class="card-text">
                                                                                                        @if (isset($data_comment['wholike']))
                                                                                                        {{count($data_comment['wholike'])}}
                                                                                                        @else
                                                                                                        0
                                                                                                        @endif
                                                                                                        likes <i
                                                                                                            class="fa-solid fa-heart"
                                                                                                            style="color: #fa2e2e;"></i>
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-footer text-left">
                                                                                            <div class="small">
                                                                                                @if (isset($data_comment['time']))
                                                                                                        {{($data_comment['time'])}}
                                                                                                        
                                                                                                        @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    $('#exampleModal').on('show.bs.modal', event => {
                                                        var button = $(event.relatedTarget);
                                                        var modal = $(this);
                                                        // Use above variables to manipulate the DOM

                                                    });
                                                </script>
                                            </td>
                                            <td>
                                                @if ($data_user['status'] === 'block')
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm change_status"
                                                        data-user_id="{{ $ukey }}"
                                                        data-username="{{ $data_user['name'] }}"
                                                        data-status="{{ $data_user['status'] }}"><i
                                                            class="fa-solid fa-ban"></i></button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-outline-success btn-sm change_status"
                                                        data-user_id="{{ $ukey }}"
                                                        data-username="{{ $data_user['name'] }}"
                                                        data-status="{{ $data_user['status'] }}"><i
                                                            class="fa-sharp fa-solid fa-badge-check"></i></button>
                                                @endif
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
            $('.change_status').on('click', function(e) {
                var status = $(this).data('status');
                var name = $(this).data('username');
                var user_id = $(this).data('user_id');
                if (status == 'block') {
                    Swal.fire({
                        title: "คุณต้องการลบข้อมูล?",
                        text: `คุณแน่ใจหรือว่าจะตั้งค่า ${name} เป็น Active user`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#6c757d",
                        confirmButtonText: "ใช่! การเปลี่ยน",
                        cancelButtonText: "ยกเลิก",
                    }).then((willDelete) => {
                        if (willDelete.isConfirmed) {
                            console.log("do block");
                            window.location.href = `/admin/active_user/${user_id}`;
                        } else {
                            swal("การลบถูกยกเลิก!");
                        }
                    });
                } else {
                    Swal.fire({
                        title: "คุณต้องการลบข้อมูล?",
                        text: `คุณแน่ใจหรือว่าจะ Block ${name}`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#6c757d",
                        confirmButtonText: "ใช่! การบล็อก",
                        cancelButtonText: "ยกเลิก",
                    }).then((willDelete) => {
                        if (willDelete.isConfirmed) {
                            console.log("do active");
                            window.location.href = `/admin/block_user/${user_id}`;
                        } else {
                            swal("การลบถูกยกเลิก!");
                        }
                    });
                }
            });

            $(document).ready(function() {
                $('#usertable').DataTable({
                    "paging": true,
                    "pageLength": 10
                });
            });
        </script>
        <script src="{{ asset('js/hostJS.js') }}"></script>
    @endsection
