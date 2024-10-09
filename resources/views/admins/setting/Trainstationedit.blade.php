@extends('adminlte::page')

@section('title', 'Update Station')

@section('content_header')
    {!! displayAlert() !!}
    {!! admin_check(session()->all()) !!}
    <div class="row">
        <h5 class="mx-2"><a href="{{route('admin.adminSetting.index')}}">ตั้งค่า</a> / </h5><h5 class="text-dark">แก้ไขทางออกของสถานี {{$station_name}}</h5>
    </div>
    <link rel="stylesheet" href="{{asset('css/hosterAdmin.css')}}">
@endsection
@section('content')
<div class="continer">
    <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="card py-2" style="border-radius: 15px;">
                    <div class="card-body">
                        
                        <form action="{{route('admin.setting.update.mainstation',$station_key)}}" enctype="multipart/form-data" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('get')
                        <div class="row">
                        <div class="col-12 col-md-6 col-xl-6 overflow-auto">
                            <div class="form-group">
                                <label for="station_name">ชื่อสถานี</label>
                                <input type="text"
                                  class="form-control mb-2 form-control-sm" name="station_name" id="station_name"  aria-describedby="helpId" placeholder="กรอกชื่อสถานี" value="{{$station_name}}">
                                <label class="mt-2" for="exdors">ทางออก 
                                    <a href="javascript:void(0);" onclick="validateAndSubmit();" class="btn btn-success btn-xs" id="addButton" disabled>เพิ่ม</a>
                                    <input type="hidden" id="getdoorID" name="getdoorID" value="">
                                    <input type="hidden" id="station_key" value="{{$station_key}}">
                                    <a onclick="send_to_doorUpdate()" id="edit_btn" class="btn btn-primary btn-xs">แก้ไข</a> <small class="text-muted">(โปรดเลือกทางออกก่อนแก้ไข)</small></label>
                                <select class="form-control form-control-sm shadow-sm" name="exdors" id="exdors" onchange="handleSelectChange(this)">
                                    @foreach ($exit_door as $key => $exdr)
                                        @if ($exdr!=null)
                                        <option value="{{$key}}">
                                            {{ $exdr['exdor_name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group text-sm">
                            
                                <label class="mt-2" for="price">ราคา</label>
                                <input type="text"
                                  class="form-control mb-2 form-control-sm" name="price" id="price" aria-describedby="helpId" placeholder="กรอกราคา" value="{{$price}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6 overflow-auto text-md">
                            <label class="text-sm" for="facility_select">สิ่งอำนวยความสะดวก</label><br>
                                <select id="facility_select" class="facility_select form-select form-select-sm shadow-sm"
                                    name="facilities[]" multiple="multiple">
                                    
                                    @foreach ($fac_all as $key => $facty)
                                        <option value="{{ $key }}" @if (in_array($key, $facility['id'])) selected @endif>{{ $facty['fac_name'] }}</option>
                                    @endforeach
                                </select>
                                
                                <label class="mt-2 text-sm" for="central_select">Location_set : Longitude/Latitude</label><br>
                                <div class="form-inline">
                                    <input type="text"
                                    class="form-control mb-2 form-control-sm" id="longtitude" name="longtitude" placeholder="ลองติจูด" aria-describedby="helpId" placeholder="lo" value="{{$local_station[0]}}">
                                  <input type="text"
                                    class="form-control mb-2 form-control-sm ml-2" id="latitude" name="latitude" placeholder="ละติจูด"  aria-describedby="helpId" placeholder="lo" value="{{$local_station[1]}}">
                                </div>   
                            </div>
                        </div>
                        <button class="btn btn-blue w-100 mt-3">บันทึกข้อมูล</button>
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
            var exdorselect = document.getElementById('exdors').value;
            var exdor_id = document.getElementById('getdoorID').value;
            var station_id = document.getElementById('station_key').value;

            function send_to_doorUpdate(){
                if (exdor_id !== "") {
                    console.log(exdor_id);
                    console.log(station_id);
                    window.location.href = "/admin/admin/setting/station/doors/update/"+ exdor_id +"/"+station_id;
                }else if(exdorselect !== ""){
                    console.log(exdorselect);
                    window.location.href = "/admin/admin/setting/station/doors/update/"+ exdorselect +"/"+station_id;

                }
            }

            function handleSelectChange(select) {
                exdor_id = select.value;
                document.getElementById('getdoorID').value = exdor_id;
            }
            var priceInput = document.getElementById('price');
            var namestation = document.getElementById('station_name');
            var longitude = document.getElementById('longtitude');
            var latitude = document.getElementById('latitude');
            function validateAndSubmit() {
                if ((priceInput.value.trim() !== '')&&(namestation.value.trim() !== '')&&(longitude.value.trim() !== '')&&(latitude.value.trim() !== '')) {
                    window.location.href = "/admin/admin/setting/station/doors/create/trans/"+station_id; 
                } else {
                    Swal.fire({
                        title: "ไม่สามารถเพิ่มข้อมูลทางออกได้",
                        text: "กรุณากรอกข้อมูลให้ครบถ้วนก่อน",
                        icon: "warning"
                    });
                }
            }

            priceInput.addEventListener('input', function () {
                var addButton = document.getElementById('addButton');
                if (this.value.trim() !== '') {
                    addButton.removeAttribute('disabled');
                } else {
                    console.log("Add data");
                    addButton.setAttribute('disabled', 'disabled');
                }
            });
            namestation.addEventListener('input', function () {
                var addButton = document.getElementById('addButton');
                if (this.value.trim() !== '') {
                    addButton.removeAttribute('disabled');
                } else {
                    console.log("Add data");
                    addButton.setAttribute('disabled', 'disabled');
                }
            });
            longitude.addEventListener('input', function () {
                var addButton = document.getElementById('addButton');
                if (this.value.trim() !== '') {
                    addButton.removeAttribute('disabled');
                } else {
                    console.log("Add data");
                    addButton.setAttribute('disabled', 'disabled');
                }
            });
            latitude.addEventListener('input', function () {
                var addButton = document.getElementById('addButton');
                if (this.value.trim() !== '') {
                    addButton.removeAttribute('disabled');
                } else {
                    console.log("Add data");
                    addButton.setAttribute('disabled', 'disabled');
                }
            });
        </script>

        <script src="{{ asset('js/host_insert.js') }}"></script>

        {{-- CKEditor --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#est_detail' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>

    @endsection

    @section('plugins.Datatables', true)
