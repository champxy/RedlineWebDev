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
var skipSlider = document.getElementById(`slider-round`);
var area_get = document.getElementById('skip-value-lower').value;

noUiSlider.create(skipSlider, {
    connect: 'lower',
    start: area_get,
    range: {
        'min': 0,
        'max': 1000,
    },
    step: 1
});
var area_show = document.getElementById('skip-value-lower');
skipSlider.noUiSlider.on('update', function (values, handle) {
    area_show.value = values[handle];
});

$('#skip-value-lower').on('blur', function () {
    skipSlider.noUiSlider.set(this.value)
});

//slider using area
var sliderUsing = document.getElementById(`slider-using`);
var using_z = document.getElementById('using_show').value;
noUiSlider.create(sliderUsing, {
    start: using_z,
    range: {
        'min': 0,
        'max': 1000,
    },
    behaviour: 'tap',
    connect: 'lower',
    step: 1 // กำหนด step ที่ต้องการ
});
var showusing_z = document.getElementById('using_show');
sliderUsing.noUiSlider.on('update', function (values, handle) {
    showusing_z.value = values[handle];
});

$('#using_show').on('blur', function () {
    var formattedValue = (this.value);
    sliderUsing.noUiSlider.set(formattedValue);
});

//slider price 
var sliderPrices = document.getElementById(`slider-price`)
var price_b = document.getElementById('price_show').value;
noUiSlider.create(sliderPrices, {
    start: price_b,
    step: 10000,
    range: {
        'min': 0,
        'max': 10000000,
    },
    connect: 'lower',
});
var priceshow = document.getElementById('price_show');

sliderPrices.noUiSlider.on('update', function (values, handle) {
    priceshow.value = formatMoney(values[handle]);
});

$('#price_show').on('blur', function () {
    var formattedValue = (this.value);
    sliderPrices.noUiSlider.set(formattedValue);
});

// ฟังก์ชันสำหรับจัดรูปแบบเงิน
function formatMoney(value) {
    var formatter = new Intl.NumberFormat('th-TH', {
        style: 'currency',
        currency: 'THB'
    });
    return formatter.format(value);
}
// เมื่อคลิกที่ปุ่ม "เพิ่ม"
        

