<!-- Modal Edit Host -->
<div class="modal fade" data-modaledit="edit" id="showHostModal_{{ $dataHost->id }}" tabindex="-1"
    aria-labelledby="showHostModalLabel_{{ $dataHost->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content " style="border-radius: 17px;">
            <div class="modal-header">
                <h5 class="modal-title" class="body-background-success" id="showHostModalLabel_{{ $dataHost->id }}">
                    แก้ไขข้อมูลผู้ปล่อยเช่าอสังหาริมทรัพย์</h5>
                <button type="button" class="close" data-dismiss="modal" data-id="{{ $dataHost->id }}"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['admin.adminHoster.update', $dataHost->id], 'method' => 'put']) !!}
                <div class="form-group col-md-12">
                    <label for="est_name">ชื่ออสังหาริมทรัพย์</label>
                    <input name="user_id" type="hidden" value="{{$dataHost->user_id}}">
                    <input id="est_name" data-id="{{ $dataHost->id }}" name="est_name"
                        class="form-control form-control-sm shadow-sm @error('est_name') is-invalid @enderror"
                        type="text" value="{{ $dataHost->estate_name }}" placeholder="กรอกชื่ออสังหาริมทรัพย์">
                    @error('est_name')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                    <label class="mt-2" for="est_detail">รายละเอียดอสังหาริมทรัพย์</label>
                    <textarea id="est_detail" name="est_detail"
                        class="form-control form-control-sm shadow-sm @error('est_detail') is-invalid @enderror"
                        oninput="autoResizeTextArea()" placeholder="กรอกรายละเอียดอสังหาริมทรัพย์">{{ $dataHost->estate_detail }}</textarea>
                    @error('est_detail')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror

                    <label class="mt-2" for="est_type">ชนิดอสังหาริมทรัพย์</label>
                    <select class="form-control form-control-sm shadow-sm" name="est_type" id="est_type">
                        @foreach ($est_type as $type)
                            <option value="{{$type->id}}" @if ($type->id == $dataHost->type_estate_id) selected @endif>
                                {{ $type->estate_name }}</option>
                        @endforeach
                    </select>
                    <label class="mt-2" for="est_region">ภูมิภาค</label>
                    <select class="form-control form-control-sm shadow-sm" name="est_region"
                        data-estRegion="{{ $dataHost->id }}" id="est_region_{{ $dataHost->id }}">
                        <option value="">เลือกภูมิภาค</option>
                        @foreach ($region_all as $region)
                            <option value="{{ $region->id }}" @if ($region->id == $dataHost->region_id) selected @endif>
                                {{ $region->region_name }}</option>
                        @endforeach
                    </select>
                    <label class="mt-2" for="est_province">จังหวัด</label>
                    <select class="form-control form-control-sm shadow-sm" name="est_province"
                        id="est_province_{{ $dataHost->id }}"  data-estprovice="{{ $dataHost->id }}">
                    </select>
                    <label class="mt-2" for="est_district">เขต/อำเภอ</label>
                    <select class="form-control form-control-sm shadow-sm" name="est_district"
                        id="est_district_{{ $dataHost->id }}">
                    </select>
                    <hr>
                    <label class="" for="facility_select">สิ่งอำนวยความสะดวก</label><br>
                    @php
                        $facy_decode = json_decode($dataHost->facilities, true);
                        $facis = json_decode(json_encode($facil), true);
                    @endphp
                    <select id="facility_select" class="facility_select form-select form-select-sm shadow-sm"
                        name="facilities[]" multiple="multiple">
                        @foreach ($facis as $facty)
                            <option value="{{ $facty['id'] }}" @if (in_array($facty['id'], $facy_decode)) selected @endif>
                                {{ $facty['facility_name'] }}</option>
                        @endforeach
                    </select>

                    <label class="mt-2" for="central_select">ส่วนกลาง</label><br>
                    @php
                        $cent_decode = json_decode($dataHost->centrals, true);
                        $centralAll = json_decode(json_encode($central), true);
                        
                    @endphp
                    <select id="central_select" class="central_select form-select form-select-sm shadow-sm"
                        name="centrals[]" multiple="multiple">
                        @foreach ($centralAll as $cnt)
                            <option value="{{ $cnt['id'] }}"
                            @if($cent_decode!=null) 
                                @if (in_array($cnt['id'], $cent_decode)) selected 
                                @endif
                            @endif> {{ $cnt['central_name'] }}</option>
                        @endforeach
                    </select>

                    <label class="mt-2" for="floors_select">จำนวนชั้น</label><br>
                    <select class="form-control form-control-sm shadow-sm" name="floors">
                        @for ($f = 1; $f <= 20; $f++)
                            <option value="{{ $f }}" @if ($f == $dataHost->floors) selected @endif>
                                {{ $f }}</option>
                        @endfor
                    </select>

                    <label class="mt-2" for="skip-value-lower">ขนาดพื้นที่ทั้งหมด</label><br>
                    <div id="slider-round-{{$dataHost->id}}" data-id="{{$dataHost->id}}" class="slider-round editarea"></div>
                    <div class="form-inline">
                        <input id="skip-value-lower_{{$dataHost->id}}" name="area_zone"
                            class="form-control form-control-sm mt-1 w-25 mr-2" value="{{ $dataHost->area_zone }}">
                        <strong>ตารางเมตร</strong>
                    </div>

                    <label class="mt-2" for="using_show">ขนาดพื้นที่ใช้สอย</label><br>
                    <div id="slider-using-{{$dataHost->id}}" data-id="{{$dataHost->id}}" class="slider-round editusing"></div>
                    <div class="form-inline">
                        <input id="using_show_{{$dataHost->id}}" name="using_zone" class="form-control form-control-sm mt-1 w-25 mr-2"
                            value="{{ $dataHost->using_area }}"> <strong>ตารางเมตร</strong>
                    </div>

                    <label class="mt-2" for="price_show">ราคา</label><br>
                    <div id="slider-price-{{$dataHost->id}}" data-id="{{$dataHost->id}}" class="slider-round editprices"></div>
                    <div class="form-inline">
                        <input id="price_show_{{$dataHost->id}}" name="price" class="form-control form-control-sm mt-1 w-50 mr-2"
                            value="{{ $dataHost->price }}"> <strong>บาท</strong>
                    </div>
                    <hr>
                    <div class="row form-inline">
                        <label class="" for="rooms">ข้อมูลห้อง</label>
                        <button type="button" id="addRoom_{{$dataHost->id}}" data-id="{{$dataHost->id}}" class="addRoom btn btn-success btn-xs ml-1 mt-1"><i
                            class="fa fa-plus-circle my-2"></i> เพิ่ม </button>
                    </div>
                    
                    @php
                        $data_room = json_decode($dataHost->rooms,true);
                    @endphp
                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-xl-10">
                            <div class="" id="room-container_{{$dataHost->id}}" data-id="{{$dataHost->id}}">
                                @if($data_room!=null)
                                @foreach ($data_room as $room_loop)
                                    <div class="room-row form-inline">
                                        <select class="form-control form-control-sm w-50 mt-1 room-select"
                                            name="rooms[]">
                                            @foreach ($rooms as $room_slc)
                                                <option value="{{ $room_slc->id }}" @if ($room_loop['id']==$room_slc->id) selected @endif>
                                                    {{ $room_slc->room_name }} 
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="number"
                                            class="form-control form-control-sm ml-1 mt-1 room-count w-25"
                                            name="room_ct[]" value="{{$room_loop['room_count']}}"
                                            placeholder="จำนวนห้อง" required>
                                        <button type="button" class="btn btn-danger btn-xs ml-1 mt-1 remove_field"><i
                                                class="fa fa-minus-circle my-2"></i> ลบ </button>
                                    </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="col-5">
                                
                            </div>
                        </div>
                    </div>
                    <hr>

                </div>
            </div>
            <div class="px-2 ml-auto">
                {!! Form::submit('อัพเดทข้อมูล', ['class' => 'btn btn-success btn-sm shadow-sm my-2 w-20']) !!}
                <button type="button" data-dismiss="modal" aria-label="Close"
                    class="btn btn-sm btn-secondary">ยกเลิก</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
