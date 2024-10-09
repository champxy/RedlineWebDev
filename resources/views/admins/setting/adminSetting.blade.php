@extends('adminlte::page')

@section('title', 'Redline - ตั้งค่าระบบ')

@section('content_header')
    {!! displayAlert() !!}
    {!! admin_check(session()->all()) !!}
    <link rel="stylesheet" href="{{ asset('css/settingAdmin.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-12 col-md-12 col-xl-12">
                    <div class="card mt-3" style="border-radius:15px;">
                        <div class="card-body">
                            <h6 class="text-muted">Setting Redline</h6>
                            <hr>
                            <div class="ml-3">
                                <div class="mt-2"><a class="text-dark" data-toggle="collapse" href="#Trainstation"
                                        role="button" aria-expanded="true" aria-controls="Trainstation">
                                        🌐 Train Station <small class="text-muted"> (สถานีรถไฟฟ้า)</small></a>
                                </div>
                                <div class="mt-2"><a class="text-dark" data-toggle="collapse" href="#Province_setting"
                                        role="button" aria-expanded="true" aria-controls="Province_setting">
                                        🌇 Mapmarking <small class="text-muted"> (พิกัดทางเดิน)</small></a>
                                </div>
                                <div class="mt-2"><a class="text-dark" data-toggle="collapse" href="#District_setting"
                                        role="button" aria-expanded="true" aria-controls="District_setting">
                                        🗼 Users <small class="text-muted"> (ผู้ใช้)</small></a>
                                </div>
                            </div>
                            <hr>
                            <div class="ml-3">
                                <div class="mt-2"><a class="text-dark" data-toggle="collapse" href="#Facility"
                                        role="button" aria-expanded="false" aria-controls="Facility">
                                        📺 Facility <small class="text-muted"> (สิ่งอำนวยความสะดวก)</small></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-xl-12">
                    <div class="card mt-3" style="border-radius:15px;">
                        <div class="card-body">
                            <h6 class="text-muted">Setting Business</h6>
                            <hr>
                            <div class="ml-3">
                                <div class="mt-2"><a href="#" class="text-dark">🪙 Coins <small class="text-muted">
                                            (การเงิน)</small></a></div>
                                <div class="mt-2"><a href="#" class="text-dark">🎫 Promotion <small
                                            class="text-muted"> (โปรโมชั่น)</small></a></div>
                                <div class="mt-2"><a href="#" class="text-dark">💳 Credit <small class="text-muted">
                                            (เครดิต)</small></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-xl-8">
            <div class="card mt-3" style="border-radius:15px;">
                <div class="card-body">
                    <h6 class="text-muted">⚙️ Setting Show</h6>
                    <hr>
                    {{-- Fac --}}
                    <div class="ml-1">
                        <div class="collapse multi-collapse" id="Facility">
                            @include('admins.setting.Facility')
                        </div>
                    </div>

                    <div class="ml-1">
                        <div class="collapse multi-collapse" id="Trainstation">
                            @include('admins.setting.Trainstation')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(function() {
            var collapse = [...$('.collapse')]
            var btncollapse = [...$('[data-toggle="collapse"]')];
            $.each(btncollapse, function(key, item) {
                $(item).click(function(e) {
                    var idcollap = e.target.attributes[2].nodeValue.replace('#', '')
                    $.each(collapse, function(keys, items) {
                        if (items.id === idcollap) {
                            $(items).collapse('show')
                        } else {
                            $(items).collapse('hide')
                        }
                    });
                });
            });
        });
    </script>
@endsection
@section('plugins.Datatables', true)
