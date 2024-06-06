
@extends('layouts.app')

@section('content')


<div class="continer mt-4">
    <div class="row">
        <div class="col-md-8">
<div class="card cardDashboardDwon">
    <div id="map" class="mapHomeClient" style="height: 550px;">
        <!-- Move the icon inside the map container -->
        <form id="searchForm" class="search-form">
            <div class="input-group">
                <a href="#" class="search-icon" onclick="searchAddress(document.getElementById('addressSearch').value)">
                    <i class="fa-solid fa-magnifying-glass-location"></i>
                </a>
                <input type="text" class="form-control search-input" id="addressSearch" placeholder="البحث عن العنوان">
            </div>
        </form>
    </div>
</div>
        </div>
        <div class="d-flex justify-content-center col-md-4 d-flex align-items-center">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                            <button class="btn btn-lg btn-outline-dark" type="button" data-bs-toggle="modal" data-bs-target="#opinionFormModal" style="margin-to:200px !important;">
            <span>ساعدنا وأضف عنوانك</span>
            <i class="fa-solid fa-map-location-dot"></i>
            </button>    
                </div>
                <div class="col-md-12 d-flex justify-content-center mt-3">


<!-- Cities -->
<div class="col-md-3 col-sm-6 mb-3">
    <div class="card cardIconClinet text-center l-bg-blue-dark">
        <div class="card-body">
            <i class="fas fa-city fa-3x mb-3"></i>
            <h5 class="card-title">{{ $totalCities }}</h5>
        </div>
    </div>
</div>

<!-- Areas -->
<div class="col-md-3 col-sm-6 mb-3">
    <div class="card cardIconClinet text-center l-bg-green-dark">
        <div class="card-body">
            <i class="fas fa-map-marker-alt fa-3x mb-3"></i>
            <h5 class="card-title">{{ $totalAreas }}</h5>
        </div>
    </div>
</div>

<!-- Streets -->
<div class="col-md-3 col-sm-6 mb-3">
    <div class="card cardIconClinet text-center l-bg-orange-dark">
        <div class="card-body">
            <i class="fas fa-road fa-3x mb-3"></i>
            <h5 class="card-title">{{ $totalStreets }}</h5>
        </div>
    </div>
</div>
                    <!-- Houses -->
                    <div class="col-md-3 col-sm-6 mb-3">
    <div class="card cardIconClinet text-center l-bg-cherry">
        <div class="card-body">
            <i class="fas fa-home fa-3x mb-3"></i>
            <h5 class="card-title">{{ $totalHouses }}</h5>
        </div>
    </div>
</div>

              </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
        <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; bottom: 10px; left: 50%; transform: translateX(-50%);">
            <div class="d-flex flex-row-reverse">
                <div class="toast-body bg-success">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif

<!-- Form modal for sending information to AdressesOpinionController create -->
<div class="modal fade" id="opinionFormModal" tabindex="-1" aria-labelledby="opinionFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header  d-flex justify-content-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                <h5 class="modal-title" id="opinionFormModalLabel">استمارة جمع الآراء: العناوين</h5>
            </div>
            <div class="modal-body">
            <div class="alert custom-alert text-center" role="alert">
    <i class="fa-solid fa-person-circle-exclamation text-warning me-2" role="img" aria-label="Warning:"></i>
    <div>
    جميع الخانات اختيارية، وهذا الاستبيان من اجل تحسين جودة الخدمات الالكترونية
    </div>
</div>


                <form id="opinionForm" action="{{ route('opinions.store') }}" method="POST">
                    @csrf
<div class="mb-3 text-end">
    <label for="name" class="form-label">اسم عنوان السكن 
        <i class="fas fa-info-circle" data-bs-toggle="tooltip" 
        data-bs-placement="right" title="اكتب اسم عنوان منزل تراه مناسب مثل رقم المنزل والشارع
"></i>
    </label>
    <input type="text" class="form-control" name="name" required>
</div>

                    <div class="mb-3 text-end">
                        <label for="type" class="form-label">نوع العنوان
                        <i class="fas fa-info-circle" data-bs-toggle="tooltip" 
        data-bs-placement="right" title="اختار نوع العقار المناسب لعنوانك
"></i>
                        </label>
                        <select class="form-select" name="type" required>
                            <option value="House">منزل</option>
                            <option value="Apartment">شقة</option>
                            <option value="Farm">مزرعة</option>
                            <option value="Shop">محل تجاري</option>
                            <option value="Restaurant">مطعم</option>
                            <option value="Cafe">كافيه</option>
                            <option value="Other">آخر</option>
                        </select>
                    </div>
                    <div class="mb-3 text-end">
                        <label for="user_name" class="form-label">اسم المستخدم
                        <i class="fas fa-info-circle" data-bs-toggle="tooltip" 
                          data-bs-placement="right" title="اسم المستخدم"></i>
                        </label>
                        <input type="text" class="form-control" name="user_name" required>
                    </div>
                    <div class="mb-3 text-end">
        <label for="message" class="form-label">الرسالة
            <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right"
                title="أضف أي تعليق إضافي"></i>
        </label>
        <textarea class="form-control" name="message"></textarea>
    </div>
                    <button type="submit" class="btn btn-primary">إرسال</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="toast align-items-center" id="errorToast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 0; left: 50%; transform: translateX(-50%);">
    <div class="d-flex flex-row-reverse">
        <div class="toast-body border-anim border-bottom border-3 border-danger">
            <span id="errorToastMessage"></span>
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>


<script>
    var housesData = {!! json_encode($houses) !!};
    console.log('Houses data loaded:', housesData); // Log the loaded houses data

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var opinionForm = document.getElementById('opinionForm');

        // Check if Geolocation is supported by the browser
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                // Create hidden input fields for latitude and longitude
                var latitudeInput = document.createElement('input');
                latitudeInput.type = 'hidden';
                latitudeInput.name = 'latitude';
                latitudeInput.value = position.coords.latitude;

                var longitudeInput = document.createElement('input');
                longitudeInput.type = 'hidden';
                longitudeInput.name = 'longitude';
                longitudeInput.value = position.coords.longitude;

                // Append the hidden input fields to the form
                opinionForm.appendChild(latitudeInput);
                opinionForm.appendChild(longitudeInput);

                // Trigger the success toast
                var successToast = new bootstrap.Toast(document.querySelector('.toast'));
                successToast.show();
            }, function (error) {
                console.error('Error getting location:', error.message);
            });
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    });
</script>



@endsection
