{{-- cities/show.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'عرض المدينة')

@section('content')
    <div class="container mt-4">
        <div class="d-flex flex-row-reverse mb-3">
            @can('city-edit', $city) {{-- Check if the user has 'city-edit' permission --}}
                <a class="btn btn-primary mr-2" href="{{ route('cities.edit', $city->id) }}">تحرير</a>
            @endcan

            @can('city-delete', $city) {{-- Check if the user has 'city-delete' permission --}}
                <form action="{{ route('cities.destroy', $city->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-2" type="submit" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            @endcan

            <a class="btn btn-secondary" href="{{ route('cities.index') }}">العودة إلى المدن</a>
        </div>

        <div class="row">
            <div class="card mt-4">
                <div class="card-body mt-4">
                    <div class="d-flex justify-content-center">
                        <h1 class="position-relative">
                            {{ $city->name }}
                            @if($city->postalCodes)
                                <span class="position-absolute top-0 start-100 ms-3 translate-middle badge rounded-pill bg-primary fs-5">
                                    {{ $city->postalCodes->code }}
                                    <span class="visually-hidden">postal code</span>
                                </span>
                            @endif
                        </h1>
                    </div>

                    <div class="d-flex justify-content-between"></div>

                    <div class="col mt-3">
                        @if($city->areas->count() > 0)
                            <div class="d-flex flex-wrap">
                                @php
                                    $totalAreas = $city->areas->count();
                                @endphp
                                <span class="badge badge-info fs-5 mr-2">عدد المناطق: {{ $totalAreas }}</span>
                            </div>
                        @else
                            <p class="text-center">لا توجد مناطق لهذه المدينة.</p>
                        @endif
                    </div>

                    <div class="col mt-3">
                        @if($city->areas->count() > 0)
                            <div class="d-flex flex-wrap">
                                @php
                                    $totalStreets = $city->areas->sum(function ($area) {
                                        return $area->streets->count();
                                    });
                                @endphp
                                <span class="badge badge-success fs-5 mr-2">عدد الشوارع: {{ $totalStreets }}</span>
                            </div>
                        @else
                            <p class="text-center">لا توجد شوارع لهذه المدينة.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion mt-3" id="accordionExample">
            <div class="card">
                <div class="card-header navCityShow" id="headingActive">
                    <h5 class="mb-0" data-bs-toggle="collapse" data-bs-target="#collapseAreas" aria-expanded="true"
                        aria-controls="collapseAreas">
                        <i class="fa-solid fa-hand-point-down"></i>
                        <span>
                            المناطق
                        </span>
                        <div class="col-12 mt-2">
                            <span class="text-secondary fs-6">مجموع المناطق والرمز البريدي للمناطق داخل هذه المدينة</span>
                        </div>
                    </h5>
                </div>

                <div id="collapseAreas" class="collapse" aria-labelledby="headingActive" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            @foreach($city->areas as $area)
                                <span class="badge badge-info mr-2">{{ $area->name }}</span>
                                <span class="badge badge-secondary mr-2">{{ optional($area->postCodeArea)->code }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header navCityShow" id="headingLink">
                    <h5 class="mb-0" data-bs-toggle="collapse" data-bs-target="#collapseStreets" aria-expanded="false"
                        aria-controls="collapseStreets">
                        <i class="fa-solid fa-hand-point-down"></i>
                        <span class="collapsed">
                            الشوارع
                        </span>
                        <div class="col-12 mt-2">
                            <span class="text-secondary fs-6">مجموع الشوارع داخل هذه المدينة</span>
                        </div>
                    </h5>
                </div>

                <div id="collapseStreets" class="collapse" aria-labelledby="headingLink" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            @foreach($city->areas as $area)
                                @foreach($area->streets as $street)
                                    <span class="badge badge-success mr-2">{{ $street->name }}</span>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
