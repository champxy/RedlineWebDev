<div class="container">
    {!! Form::open(['route' => ['admin.setting.update.station'], 'method' => 'post']) !!}
    @csrf

    <div class="card" style="border-radius: 15px;">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <div class="form-inline">
                        <h4 class="text-secondary ml-2 text-bold mt-1">Trainstation System</h4>
                            @if(isset($station) && (($stt_c = count($station))!=null))
                                <small class="text-muted mt-1 ml-2">All ({{$stt_c}})</small>
                            @endif
                    </div>
                    <a href="{{route('admin.adminStation.create')}}" class="btn-light-git mb-1 ml-1" ><i
                        class="fa fa-plus-circle mr-1" aria-hidden="true"></i> เพิ่มสถานีรถไฟฟ้าสายสีแดง</a>
                </div>
                <div class="ml-auto">
                    <button type="button" id="" class="btn-reseted">💿 Default Reset</a>
                </div>
            </div>
        </div>
        <div class="card-body ml-2">
            <div class="row station-set">
                @foreach ($station as $key =>$stt)
                    <div class="station-data col-12 col-md-12 col-xl-5">
                        <div class="form-inline mb-2">
                            <input class="form-control form-control-sm" style="width: 170px;border-radius: 7px;" name="station[]"
                                value="{{ $stt['station_name'] }}" data-original-value="{{ $stt['station_name'] }}" required placeholder="ชื่อสถานี">
                            <button type="button" class="btn btn-primary btn-sm ml-1" style="border-radius: 7px;" onclick="resetInput(this)">
                                <i class="fa fa-refresh" aria-hidden="true"></i></button>
                            <a href="{{route('admin.adminStation.edit',$key)}}" class="btn btn-secondary btn-sm ml-1" style="border-radius: 7px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <span class="deleteStation btn btn-light btn-sm ml-1" style="border-radius: 7px;"
                            data-id="{{ $key }}" data-name="{{ $stt['station_name'] }}"><i class="fa fa-trash"
                            aria-hidden="true"></i>
                        </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col d-flex justify-content-center">
                {!! Form::submit('Save Setting', ['class' => 'text-bold btn btn-light btn-sm shadow-sm my-2 w-50']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    
    
    
</div>

<script>
    function resetInput(button) {
        var input = button.parentNode.querySelector('input');
        var originalValue = input.getAttribute('data-original-value');
        input.value = originalValue;
    }

    $('.deleteStation').on('click', (e) => {
        Swal.fire({
            title: "คุณต้องการลบข้อมูล?",
            input: "text",
            inputAttributes: {
                autocapitalize: "off"
            },
            text: `คุณแน่ใจหรือว่าต้องการลบข้อมูลของ ${e.currentTarget.dataset.name}`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "ใช่! ยืนยันการลบ",
            cancelButtonText: "ยกเลิก",
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    var enteredCode = willDelete.value;
                    if (enteredCode === "yes") {
                        $.ajax({
                            url: '/admin/admin/setting/station/delete/' + e.currentTarget.dataset.id,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'X-HTTP-Method-Override': 'DELETE',
                            },
                            success: function(response) {
                                $(e.currentTarget).closest('.station-data').remove();
                                Swal.fire(`คุณได้ลบ ${e.currentTarget.dataset.name}`, "สำเร็จ", "success");
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    } else {
                        Swal.fire("กรุณายืนยันการลบ!", "โปรดลองอีกครั้ง", "error");
                    }
                    
                } else {
                    swal("การลบถูกยกเลิก!");
                }
            });
    });

    
    // function addStationInput() {
    //     var newRow = document.createElement('div');
    //     newRow.className = 'station-data col-12 col-md-12 col-xl-5';

    //     var formInline = document.createElement('div');
    //     formInline.className = 'form-inline mb-2';

    //     var input = document.createElement('input');
    //     input.className = 'form-control form-control-sm';
    //     input.style = 'width:170px;border-radius:7px;';
    //     input.name = 'station_new[]';
    //     input.value = '';
    //     input.required = true;
    //     input.placeholder = 'ชื่อสถานี';

    //     var refreshButton = document.createElement('button');
    //     refreshButton.type = 'button';
    //     refreshButton.style = 'border-radius:7px;';
    //     refreshButton.className = 'btn btn-primary btn-sm ml-1';
    //     refreshButton.innerHTML = '<i class="fa fa-refresh" aria-hidden="true"></i>';
    //     refreshButton.addEventListener('click', function() {
    //         resetInput(this);
    //     });

    //     var deleteButton = document.createElement('button');
    //     deleteButton.style = 'border-radius:7px;';
    //     deleteButton.className = 'btn btn-light btn-sm ml-1 remove_station';
    //     deleteButton.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';


    //     formInline.appendChild(input);
    //     formInline.appendChild(refreshButton);
    //     formInline.appendChild(deleteButton);


    //     newRow.appendChild(formInline);

    //     var rowContainer = document.querySelector('.station-set');
    //     rowContainer.appendChild(newRow);

    //     $(document).on("click", ".remove_station", function(e) { // เมื่อกดปุ่ม Remove
    //         e.preventDefault();
    //         $(this).closest('.station-data').remove(); // ลบช่อง select ที่เป็นพ่อของปุ่มนั้นออก
    //     });
    // }
</script>
