$(document).ready(function () {
    $('.facility_select').select2({
        placeholder: "เลือกสิ่งอำนวยความสะดวก",
        width: '100%',
        theme: "bootstrap",
    });
});

$(document).ready(function () {
    $('.floors_select').select2({
        placeholder: "เลือกจำนวนชั้นที่ต้องการ",
        width: '100%',
        theme: "bootstrap",
    });
});

$(document).ready(function () {
    $('.central_select').select2({
        placeholder: "เลือกส่วนการที่ต้องการ (ข้อมูลนี้ไม่จำเป็นต้องกรอกก็ได้)",
        width: '100%',
        theme: "bootstrap",
    });
});

$(document).ready(function () {
    $('.district_select').select2({
        placeholder: "เลือกเขต/อำเภอ",
        width: '100%',
        theme: "bootstrap",
    });
});


//noUiSlider
var skipSlider = document.getElementById(`slider-area`);
var Minarea_get = document.getElementById('skip-value-lower').value;
var Maxarea_get = document.getElementById('skip-value-max').value;
noUiSlider.create(skipSlider, {
    connect: true,
    start: [Minarea_get,Maxarea_get],
    step: 1,
    range: {
        'min': 0,
        'max': 1000,
    },
});
var Minarea_show = document.getElementById('skip-value-lower');
var Maxarea_show = document.getElementById('skip-value-max');

skipSlider.noUiSlider.on('update', function (values, handle) {
    (handle ? Maxarea_show : Minarea_show).value = values[handle];
});

$('#skip-value-lower').on('change', function () {
    skipSlider.noUiSlider.set([this.value, null]);
});

$('#skip-value-max').on('change', function () {
    skipSlider.noUiSlider.set([null, this.value]);
});



//slider using area
var sliderUsing = document.getElementById(`slider-using`);
var using_showMin = document.getElementById('using_showMin').value;
var using_showMax = document.getElementById('using_showMax').value;
noUiSlider.create(sliderUsing, {
    start: [using_showMin,using_showMax],
    range: {
        'min': 0,
        'max': 1000,
    },
    behaviour: 'tap',
    connect: true,
    step: 1 // กำหนด step ที่ต้องการ
});
var showusing_mi = document.getElementById('using_showMin');
var showusing_mx = document.getElementById('using_showMax');
sliderUsing.noUiSlider.on('update', function (values, handle) {
    (handle ? showusing_mx : showusing_mi).value = values[handle];
});

$('#using_showMin').on('change', function () {
    sliderUsing.noUiSlider.set([this.value, null]);
});

$('#using_showMax').on('change', function () {
    sliderUsing.noUiSlider.set([null, this.value]);
});

//slider price 
var sliderPrices = document.getElementById(`slider-price`)
var price_mn = document.getElementById('price_showMin').value;
var price_mx = document.getElementById('price_showMax').value;
noUiSlider.create(sliderPrices, {
    start: [price_mn,price_mx],
    step: 10000,
    range: {
        'min': 0,
        'max': 10000000,
    },
    connect: true,
});
var priceshow_mn = document.getElementById('price_showMin');
var priceshow_mx = document.getElementById('price_showMax');

sliderPrices.noUiSlider.on('update', function (values, handle) {
    (handle ? priceshow_mx : priceshow_mn).value = formatMoney(values[handle]);
});

$('#price_showMin').on('blur', function () {
    sliderPrices.noUiSlider.set([this.value, null]);
});

$('#price_showMax').on('blur', function () {
    var formattedValue = (this.value);
    sliderPrices.noUiSlider.set([null, this.value]);
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
        

