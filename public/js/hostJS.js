$(document).ready(function () {
    $('.deleteButton').on('click', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        Swal.fire({
            title: "คุณต้องการลบข้อมูล?",
            text: `คุณแน่ใจหรือว่าต้องการลบข้อมูล ${name}`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "ใช่! ยืนยันการลบ",
            cancelButtonText: "ยกเลิก",
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#deleteFormDel_${id}`).submit();
            }
        });
    });
});

// DataTables Options
$(document).ready(() => {
    $('#host-table').DataTable({
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        iDisplayLength: 25,
        language: {
            lengthMenu: 'แสดง _MENU_ รายการต่อหน้า',
            zeroRecords: 'ขออภัย ไม่พบข้อมูล',
            info: 'หน้า _PAGE_ / _PAGES_',
            infoEmpty: 'ไม่พบรายการ',
            infoFiltered: '(จากทั้งหมด _MAX_ รายการ)',
            search: 'ค้นหา',
        },
        
    });
});

//Select2
$(document).ready(function () {
    $('.facility_select').select2({
        placeholder: "เลือกสิ่งอำนวยความสะดวก",
        width: '100%',
        theme: "classic",
    });
});

$(document).ready(function () {
    $('.floors_select').select2({
        placeholder: "เลือกจำนวนชั้นที่ต้องการ",
        width: '100%',
        theme: "classic",
    });
});

$(document).ready(function () {
    $('.central_select').select2({
        placeholder: "เลือกส่วนการที่ต้องการ (ข้อมูลนี้ไม่จำเป็นต้องกรอกก็ได้)",
        width: '100%',
        theme: "classic",
    });
});




    //noUiSlider
    var areaSlider = document.querySelectorAll('.editarea');
    $.each(areaSlider, function (key, item) {
        var skipSlider = document.getElementById(`slider-round-${item.dataset.id}`);
        var area_get = document.getElementById('skip-value-lower_'+item.dataset.id).value;

        noUiSlider.create(skipSlider, {
            connect: 'lower',
            start: area_get,
            range: {
                'min': 0,
                'max': 1000,
            },
            step:10
        });
        var area_show = document.getElementById('skip-value-lower_'+item.dataset.id);
            skipSlider.noUiSlider.on('update', function (values, handle) {
            area_show.value = values[handle];
            });
    });
    
    $('#skip-value-lower').on('blur', function () {
        areaSlider.noUiSlider.set(this.value)
    });

    //slider using area
    var sliderUsingID = document.querySelectorAll('.editusing');
    $.each(sliderUsingID, function (key, item) {
        var sliderUsing = document.getElementById(`slider-using-${item.dataset.id}`);
        var using_z = document.getElementById('using_show_'+item.dataset.id).value;
        noUiSlider.create(sliderUsing, {
            start: using_z,
            range: {
                'min': 0,
                'max': 1000,
            },
            behaviour: 'tap',
            connect: 'lower',
            step: 10 // กำหนด step ที่ต้องการ
            });
        var showusing_z = document.getElementById('using_show_'+item.dataset.id);
            sliderUsing.noUiSlider.on('update', function (values, handle) {
            showusing_z.value = values[handle];
        });
    });

    $('#using_show_').on('blur', function () {
        var formattedValue = (this.value);
        sliderUsingID.noUiSlider.set(formattedValue);
    });

    //AutoSize-Content
    function autoResizeTextArea() {
        const textArea = document.getElementById('est_detail');
        textArea.style.height = 'auto'; // รีเซ็ตความสูง
        textArea.style.height = textArea.scrollHeight + 'px'; 
    }

    //slider price 
    var sliderprice = document.querySelectorAll('.editprices');
    $.each(sliderprice, function (key, item) { 
         var sliderPrices = document.getElementById(`slider-price-${item.dataset.id}`)
         var price_b = document.getElementById('price_show_'+item.dataset.id).value;
         noUiSlider.create(sliderPrices, {
            start: price_b,
            step: 10000,
            range: {
                'min': 0,
                'max': 10000000,
            },
            connect: 'lower',
        });
        var priceshow = document.getElementById('price_show_'+item.dataset.id);
    
        sliderPrices.noUiSlider.on('update', function (values, handle) {
            priceshow.value = formatMoney(values[handle]);
        });
    });

    $('#price_show').on('blur', function () {
        var formattedValue = (this.value);
        sliderprice.noUiSlider.set(formattedValue);
    });

    // ฟังก์ชันสำหรับจัดรูปแบบเงิน
    function formatMoney(value) {
        var formatter = new Intl.NumberFormat('th-TH', {
            style: 'currency',
            currency: 'THB'
        });
        return formatter.format(value);
    }




