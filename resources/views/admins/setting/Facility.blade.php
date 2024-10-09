<div class="container">
    {!! Form::open(['route' => ['admin.setting.update.fac'], 'method' => 'post']) !!}
    @csrf
    <div class="card" style="border-radius: 17px;">
        <div class="card-header">
            <div class="row mb-2">
                <div class="col">
                    <div class="form-inline">
                        <h4 class="text-secondary ml-2 text-bold mt-1">Facility Setting</h4>
                        @if(isset($fec) && is_array($fec))
                            <small class="text-muted mt-1 ml-2">All ({{ count($fec) }})</small>
                        @endif
                    </div>
                    <button type="button" class="btn-light-git mb-1 ml-1" onclick="addFacilityInput()">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มสิ่งอำนวยความสะดวก</button>
                </div>
                <div class="ml-auto">
                    <button type="button" id="111facility_default" class="btn-reseted">💿 Default Reset</a>
                </div>
            </div>
        </div>
        <div class="card-body ml-2">
            <div class="row facility-set2">
                @foreach ($fec as $key => $facility)
                    <div class="facility-data col-12 col-md-12 col-xl-5">
                        <div class="form-inline mb-2">
                            <input class="form-control form-control-sm" style="width: 170px;border-radius:7px;" name="facility[]"
                                value="{{ $facility['fac_name'] }}" data-original-value="{{ $facility['fac_name'] }}" required>
                            <button type="button" class="btn btn-primary btn-sm ml-1" style="border-radius:7px;" onclick="resetInput(this)">
                                <i class="fa fa-refresh"aria-hidden="true"></i></button>
                        <span class="deleteFacility2 btn btn-light btn-sm ml-1" style="border-radius:7px;"
                            data-id="{{ $key }}" data-name="{{ $facility['fac_name'] }}"><i class="fa fa-trash"
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

    function addFacilityInput() {
        var newRow = document.createElement('div');
        newRow.className = 'facility-data col-12 col-md-12 col-xl-5';

        var formInline = document.createElement('div');
        formInline.className = 'form-inline mb-2';

        var input = document.createElement('input');
        input.className = 'form-control form-control-sm border';
        input.style = 'width:170px;border-radius:7px;';
        input.name = 'facility_new[]';
        input.value = '';
        input.required = true;
        input.placeholder = 'ชื่อสิ่งอำนวยความสะดวก';

        var refreshButton = document.createElement('button');
        refreshButton.type = 'button';
        refreshButton.style = 'border-radius:7px;';
        refreshButton.className = 'btn btn-primary btn-sm ml-1';
        refreshButton.innerHTML = '<i class="fa fa-refresh" aria-hidden="true"></i>';
        refreshButton.addEventListener('click', function() {
            resetInput(this);
        });

        var deleteButton = document.createElement('button');
        deleteButton.style = 'border-radius:7px;';
        deleteButton.className = 'btn btn-light btn-sm ml-1 remove_facility';
        deleteButton.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';

        formInline.appendChild(input);
        formInline.appendChild(refreshButton);
        formInline.appendChild(deleteButton);

        newRow.appendChild(formInline);

        var rowContainer = document.querySelector('.facility-set2');
        rowContainer.appendChild(newRow);

        $(document).on("click", ".remove_facility", function(e) { // เมื่อกดปุ่ม Remove
            e.preventDefault();
            $(this).closest('.facility-data').remove(); // ลบช่อง select ที่เป็นพ่อของปุ่มนั้นออก
        });
    }

    $('.deleteFacility2').on('click', (e) => {
        Swal.fire({
            title: "คุณต้องการลบข้อมูล?",
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
                    $.ajax({
                        url: '/admin/admin/setting/fac/destroy/' + e.currentTarget.dataset.id,
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'X-HTTP-Method-Override': 'GET',
                        },
                        success: function(response) {
                            $(e.currentTarget).closest('.facility-data').remove();
                            Swal.fire(`คุณได้ลบ ${e.currentTarget.dataset.name}`, "สำเร็จ", "success");
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    swal("การลบถูกยกเลิก!");
                }
            });
    });
</script>
