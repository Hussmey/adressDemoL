{{-- houses/create.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'إنشاء منزل جديد')

@section('content')
{{-- Toast --}}
    @if (session('success') || session('error'))
        <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true"
            style="position: absolute; top: 0; left: 50%; transform: translateX(-50%);">
            <div class="d-flex flex-row-reverse">
                <div class="toast-body border-anim border-bottom border-3 @if(session('success')) border-success @else border-danger @endif">
                    @if(session('success'))
                        {{ session('success') }}
                    @endif

                    @if(session('error'))
                        {{ session('error') }}
                    @endif
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif


    <div class="container mt-4">
    <h3 class="text-center">إنشاء منزل جديد</h3>
        <div class="d-flex flex-row-reverse">
        <a class="btn btn-secondary" href="{{ route('houses.index') }}">العودة إلى المنازل</a>
        </div>

        <form action="{{ route('houses.store') }}" method="POST" id="houseForm">
            @csrf
            <div class="form-group">
                <label for="number">رقم المنزل:</label>
                <input type="text" class="form-control" name="number" required>
            </div>
            <div class="form-group">
                <label for="latitude">خط العرض:</label>
                <input type="text" class="form-control" name="latitude" required>
            </div>
            <div class="form-group">
                <label for="longitude">خط الطول:</label>
                <input type="text" class="form-control" name="longitude" required>
            </div>

            <div class="form-group">
                <label for="city">المدينة:</label>
                <select class="form-control" name="city_id" id="city" required>
                    <option value="" selected disabled>اختر المدينة</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="area">المنطقة:</label>
                <select class="form-control" name="area_id" id="area" required>
                    <option value="" selected disabled>اختر المنطقة</option>
                </select>
            </div>

            <div class="form-group">
                <label for="street">الشارع:</label>
                <select class="form-control" name="street_id" id="street" required>
                    <option value="" selected disabled>اختر الشارع</option>
                </select>
            </div>

            <button type="submit" class="btn btnColor">إنشاء</button>
        </form>
        <div class="d-flex mt-3">
            
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('city').addEventListener('change', function () {
                var cityId = this.value;
                if (cityId) {
                    fetch('/get-areas/' + cityId)
                        .then(response => response.json())
                        .then(data => {
                            var areaSelect = document.getElementById('area');
                            areaSelect.innerHTML = '<option value="" selected disabled>اختر المنطقة</option>';
                            data.forEach(function (value) {
                                var option = document.createElement('option');
                                option.value = value.id;
                                option.text = value.name;
                                areaSelect.appendChild(option);
                            });
                        });
                } else {
                    document.getElementById('area').innerHTML = '<option value="" selected disabled>اختر المنطقة</option>';
                }
            });

            document.getElementById('area').addEventListener('change', function () {
                var areaId = this.value;
                if (areaId) {
                    fetch('/get-streets/' + areaId)
                        .then(response => response.json())
                        .then(data => {
                            var streetSelect = document.getElementById('street');
                            streetSelect.innerHTML = '<option value="" selected disabled>اختر الشارع</option>';
                            data.forEach(function (value) {
                                var option = document.createElement('option');
                                option.value = value.id;
                                option.text = value.name;
                                streetSelect.appendChild(option);
                            });
                        });
                } else {
                    document.getElementById('street').innerHTML = '<option value="" selected disabled>اختر الشارع</option>';
                }
            });
        });
    </script>
@endsection
