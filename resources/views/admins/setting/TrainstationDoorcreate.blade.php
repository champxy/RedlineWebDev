@extends('adminlte::page')

@section('title', 'Create Door Station')

@section('content_header')
    {!! displayAlert() !!}
    {!! admin_check(session()->all()) !!}
    <div class="row">
        <h5 class="mx-2"><a href="{{route('admin.adminSetting.index')}}">ตั้งค่า</a> / <a href="{{route('admin.adminStation.edit',$station_id)}}">{{$station['station_name']}}</a> / </h5><h5 class="text-dark">เพิ่มทางออก</h5>
    </div>
    <link rel="stylesheet" href="{{asset('css/hosterAdmin.css')}}">
@endsection
@section('content')
<div class="continer">
    <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="card py-2" style="border-radius: 15px;">
                    <div class="card-body">
                        <form action="{{route('admin.setting.store.door',[$newexdorId,$station_id])}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-12 col-md-6 col-xl-4 overflow-auto">
                                <div class="form-group">
                                    <label for="exit_name">ชื่อทางออก</label>
                                    <input type="text"
                                    class="form-control mb-2 form-control-sm" name="exit_name" id="exit_name"  aria-describedby="helpId" placeholder="กรอกชื่อทางออก" value="">
                                    <label class="mt-2" for="exdors_detail">ทางออก</label>
                                    <textarea type="text" class="form-control mb-2 form-control-sm" name="exdors_detail" id="exdors_detail" aria-describedby="helpId" placeholder="กรอกรายละเอียดอทางออก"></textarea>
                                </div>

                                <div class="trans_editor" id="trans_editor">
                                    <label class="text-sm" for="exit_name">บริการขนส่งสาธารณะ</label><br>
                                    <input type="hidden" id="keycount" value="">
                                </div>
                                <a type="button" id="addTransport" class="btn btn-success btn-sm w-100">เพิ่ม</a>
                            </div>
                            <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                <div class="card border-secondary mb-2">
                                    <div class="card-header pb-2" style="background-color: #F5F5F5">
                                        <small class="text-bold">Marking walk-in</small>
                                            <a type="button" id="add_in" class="text-success ml-auto"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                            <a type="button" id="remove_in" class="text-secondary"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                                <small class="">Latitude</small>
                                            </div>
                                            <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                                <small class="">Longitude</small>
                                            </div>
                                            <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                                <small class="">Attitude</small>
                                            </div>
                                        </div>
                                        <div class="row-markingIn">
                                            <div class="row mb-2 row_in">
                                                <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                                    <input type="number" step="any" class="form-control form-control-sm" id="in_latitude[]" name="in_latitude[]" placeholder="Latitude" value="">
                                                </div>
                                                <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                                    <input type="number" step="any" class="form-control form-control-sm" id="in_longitude[]" name="in_longitude[]" placeholder="Longitude" value="">
                                                </div>
                                                <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                                    <input type="number" step="any" class="form-control form-control-sm" id="in_attitude[]" name="in_attitude[]" placeholder="Attitude" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                            <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                <div class="card border-secondary mb-2">
                                    <div class="card-header pb-2" style="background-color: #F5F5F5">
                                        <small class="text-bold">Marking walk-out</small>
                                            <a type="button" id="add_out" class="text-success ml-auto"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                            <a type="button" id="remove_out" class="text-secondary"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                                    </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                            <small class="">Latitude</small>
                                        </div>
                                        <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                            <small class="">Longitude</small>
                                        </div>
                                        <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                            <small class="">Attitude</small>
                                        </div>
                                    </div>
                                    <div class="row-markingOut">
                                        <div class="row mb-2 row_out">
                                            <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                                <input type="number" step="any" class="form-control form-control-sm" id="out_latitude[]" name="out_latitude[]" placeholder="Latitude" value="">
                                            </div>
                                            <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                                <input type="number" step="any" class="form-control form-control-sm" id="out_longitude[]" name="out_longitude[]" placeholder="Longitude" value="">
                                            </div>
                                            <div class="col-12 col-md-3 col-xl-4 overflow-auto">
                                                <input type="number" step="any" class="form-control form-control-sm" id="out_attitude[]" name="out_attitude[]" placeholder="Attitude" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div> {{-- row --}}
                        <button type="submit" class="btn btn-blue w-100 mt-3">บันทึกข้อมูล</button>
                        </form>
                    </div>
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
                background: #b72717;
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
            var cardCount = 0;
            $(document).ready(function(){
                $('#addTransport').click(function(){
                    var newCard = $('<div class="card border-secondary mb-2 card_trans">' +
                                        '<div class="card-header pb-2" style="background-color: #F5F5F5">' +
                                            '<div class="form-group form-inline">' +
                                                '<input type="text" class="form-control form-control-sm mr-2" name="tran_name[]" id="exit_name" aria-describedby="helpId" placeholder="กรอกชื่อบริการขนส่ง" @required(true)>' +
                                                '<input type="text" class="form-control form-control-sm" name="tran_time[]" id="tran_time" aria-describedby="helpId" placeholder="กรอกเวลาบริการขนส่ง" @required(true)>' +
                                                '<div class="ml-2">' +
                                                    '<button class="btn btn-secondary btn-sm remove_field"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="card-body">' +
                                            '<small class="text-sm text-muted" for="tran_desc">รายละเอียดบริการขนส่ง</small>'+
                                            '<a type="button" class="add_descnew" data-keydesc="'+cardCount+'">'+
                                            '<i class="fa fa-plus-circle my-2 text-success"></i></a> <br>' +
                                            '<div class="rowTransdesc form-inline">' +
                                                '<div class="form-inline desc_tran mb-1">' +
                                                    '<input type="text" class="form-control form-control-sm mr-2" name="tran_desc1_' + cardCount + '[]" id="tran_desc" aria-describedby="helpId" placeholder="สายรถ / เบอร์รถ">' +
                                                    '<input type="text" class="form-control form-control-sm" name="tran_desc2_' + cardCount + '[]" id="tran_desc" aria-describedby="helpId" placeholder="สถานที่ที่รถเดินทาง"><br>' +
                                                    '<button class="btn btn-outline-secondary ml-1 btn-sm remove_desc"> - </button>'+
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>');
                    $('#trans_editor').append(newCard);
                    cardCount++; // เพิ่มค่า cardCount ทีละ 1 หลังจากเพิ่ม card ใหม่
                });
            });

            $(document).ready(function(){
                $('.add_desc').click(function(){
                    console.log("add_desc");
                    var keyDesc = $(this).data('keydesc');
                    var newCard = $('<div class="form-inline mb-1 desc_tran">'+
                                    '<input type="text" class="form-control form-control-sm mr-2" name="tran_desc1_'+keyDesc+'[]" id="tran_desc"  placeholder="สายรถ / เบอร์รถ" value=""> '+
                                    '<input type="text" class="form-control form-control-sm" name="tran_desc2_'+keyDesc+'[]" id="tran_desc" placeholder="สถานที่ที่รถเดินทาง" value="">'+'<br>'+
                                    '<button class="btn btn-outline-secondary ml-1 btn-sm remove_desc"> - </button>'+
                                    '</div>');
                    $(this).closest('.card-body').find('.rowTransdesc').append(newCard);
                });
            });

            $(document).ready(function(){
                $('#add_in').click(function(){
                    console.log("add_in");
                    var newRow = $('<div class="row mb-2 row_in">'+
                                        '<div class="col-12 col-md-3 col-xl-4 overflow-auto">'+
                                            '<input class="form-control form-control-sm" id="in_latitude[]" name="in_latitude[]" placeholder="Latitude" value="">'+
                                        '</div>'+
                                        '<div class="col-12 col-md-3 col-xl-4 overflow-auto">'+
                                           ' <input class="form-control form-control-sm" id="in_longitude[]" name="in_longitude[]" placeholder="Longitude" value="">'+
                                        '</div>'+
                                        '<div class="col-12 col-md-3 col-xl-4 overflow-auto">'+
                                            '<input class="form-control form-control-sm" id="in_attitude[]" name="in_attitude[]" placeholder="Attitude" value="">'+
                                        '</div></div>');
                    $(this).closest('.card-body').find('.row-markingIn').append(newRow);
                });
            });

            $(document).ready(function(){
                $('#add_out').click(function(){
                    console.log("add_out");
                    var newRow = $('<div class="row mb-2 row_out">'+
                                        '<div class="col-12 col-md-3 col-xl-4 overflow-auto">'+
                                            '<input class="form-control form-control-sm" id="out_latitude[]" name="out_latitude[]" placeholder="Latitude" value="">'+
                                        '</div>'+
                                        '<div class="col-12 col-md-3 col-xl-4 overflow-auto">'+
                                           ' <input class="form-control form-control-sm" id="out_longitude[]" name="out_longitude[]" placeholder="Longitude" value="">'+
                                        '</div>'+
                                        '<div class="col-12 col-md-3 col-xl-4 overflow-auto">'+
                                            '<input class="form-control form-control-sm" id="out_attitude[]" name="out_attitude[]" placeholder="Attitude" value="">'+
                                        '</div></div>');
                    $(this).closest('.card-body').find('.row-markingOut').append(newRow);
                });
            });


            $(document).ready(function(){
                $('#trans_editor').on('click', '.add_descnew', function(){
                    console.log("add_desc_newnew");
                    var keyDesc = $(this).data('keydesc');
                    var newCard = $('<div class="form-inline mb-1 desc_tran">'+
                                    '<input type="text" class="form-control form-control-sm mr-2" name="tran_desc1_'+keyDesc+'[]" id="tran_desc"  placeholder="สายรถ / เบอร์รถ" value=""> '+
                                    '<input type="text" class="form-control form-control-sm" name="tran_desc2_'+keyDesc+'[]" id="tran_desc" placeholder="สถานที่ที่รถเดินทาง" value="">'+'<br>'+
                                    '<button class="btn btn-outline-secondary ml-1 btn-sm remove_desc"> - </button>'+
                                    '</div>');
                    $(this).closest('.card-body').find('.rowTransdesc').append(newCard);
                });
            });



            $(document).on("click", ".remove_field", function (e) { // เมื่อกดปุ่ม Remove
                e.preventDefault();
                $(this).closest('.card_trans').remove(); // ลบช่อง select ที่เป็นพ่อของปุ่มนั้นออก
                cardCount--;
            });

            $(document).on("click", ".remove_desc", function (e) { // เมื่อกดปุ่ม Remove
                e.preventDefault();
                $(this).closest('.desc_tran').remove(); // ลบช่อง select ที่เป็นพ่อของปุ่มนั้นออก
            });

            $(document).on("click", "#remove_in", function (e) {
                e.preventDefault();
                $(this).parents('.card-body').find('.row_in').last().remove();
            });

            $(document).on("click", "#remove_out", function (e) {
                e.preventDefault();
                $(this).parents('.card-body').find('.row_out').last().remove();
            });

            $('.remove_maindesc').on('click', function(e) {
                var descname = $(this).data('descname'); // ใช้ $(this) เพื่อเข้าถึง Element ที่ถูกคลิก

                Swal.fire({
                    title: "คุณต้องการลบข้อมูล?",
                    text: `คุณแน่ใจหรือว่าต้องการลบข้อมูลของ ${descname}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "ใช่! ยืนยันการลบ",
                    cancelButtonText: "ยกเลิก",
                }).then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        console.log("show delete");
                        e.preventDefault();
                        $(this).closest('.card_transOld').remove();
                    } else {
                        swal("การลบถูกยกเลิก!");
                    }
                });
            });


        </script>

        <script src="{{ asset('js/host_insert.js') }}"></script>

        {{-- CKEditor --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
        {{-- <script>
            ClassicEditor
                .create( document.querySelector( '#exdors_detail' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script> --}}

    @endsection

    @section('plugins.Datatables', true)
