@extends('layouts.app')

@section('navbar-title', 'إدارة العناوين')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <h3 class="text-center">إدارة العناوين</h3>
        </div>
        <div class="row mt-3">
            <div class="col-md-3">
                <a class="custom-link" href="{{ route('cities.index') }}">
                <div class="card cardDashbord l-bg-cherry">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                            <h5 class="card-title text-white mb-0">المدن</h5>
                            </div>
                            <div class="col-4 text-right">
                            <h2 class="d-flex align-items-center text-white mb-0">
                                    {{ $citiesCount }}
                                </h2>
                            </div>
                        </div>
                        <div class="progress mt-1" data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                        </div>
                    </div>
                    <div class="pr-4">
                    <p class=""><a  class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">التفاصيل أكثر</a></p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="custom-link" href="{{ route('areas.index') }}">
                <div class="card cardDashbord l-bg-blue-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-map"></i></div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                            <h5 class="card-title text-white mb-0">المناطق</h5>
                            </div>
                            <div class="col-4 text-right">
                            <h2 class="d-flex align-items-center text-white mb-0">
                                    {{ $areasCount }}
                             </h2>
                             </div>
                        </div>
                        <div class="progress mt-1" data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-green-dark" role="progressbar" data-width="20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                     </div>
                    <div class="pr-4">
                    <p class=""><a href="{{ route('areas.index') }}" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">التفاصيل أكثر</a></p>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-3">
                <a class="custom-link" href="{{ route('streets.index') }}">
                <div class="card cardDashbord l-bg-green-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-road"></i></div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                            <h5 class="card-title text-white mb-0">الشوارع</h5>
                            </div>
                            <div class="col-4 text-right">
                            <h2 class="d-flex align-items-center text-white mb-0">
                                    {{ $streetsCount }}
                                </h2>
                            </div>
                        </div>
                        <div class="progress mt-1" data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-orange-dark" role="progressbar" data-width="15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%;"></div>
                        </div>
                    </div>
                    <div class="pr-4">
                    <p class=""><a href="{{ route('streets.index') }}" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">التفاصيل أكثر</a></p>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-3">
                <a class="custom-link" href="{{ route('postCodes.index') }}">
                    <div class="card cardDashbord l-bg-orange-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-mail-bulk"></i></div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                            <h5 class="card-title text-white mb-0">رمز البريد</h5>
                            </div>
                            <div class="col-4 text-right">
                            <h2 class="d-flex align-items-center text-white mb-0">
                                    {{ $postCodesCount }}
                                </h2>
                             </div>
                        </div>
                        <div class="progress mt-1" data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="18%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100" style="width: 18%;"></div>
                        </div>
                    </div>
                    <div class="pr-4">
                    <p class=""><a href="{{ route('postCodes.index') }}" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">التفاصيل أكثر</a></p>
                    </div>
                </div>
                </a>
            </div>
            
        </div>

    </div>
    <div class="container">
    <div class="row">
    <div class="col-md-8">
    <h4 class=" text-center">الخرائط</h4>
    <div class="card cardDashboardDwon">
    <div id="map" style="height: 400px;">
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
        <div class="col-md-4">
        <h4 class=" text-center">الرسم البياني للمدن</h4>
            <div class="card cardDashboardChart">
                <canvas id="chart"></canvas>
            </div>
<div class="">
<h4 class=" text-center">أكثر 3 مدن اكتضاض</h4>

    <table class="table">
        <thead>
            <tr class="text-center">
                <th class="col-6">الاسم</th>
                <th class="col-6">الرمز البريدي</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topCitiesWithPostalCodes as $topCity)
                <tr>
                    <td class="col-6 text-center">{{ $topCity->name }}</td>
                    <td class="col-6 text-center">
                        @foreach($topCity->postalCodes as $postalCode)
                            {{ $postalCode }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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
@endsection
