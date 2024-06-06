{{-- areas/show.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'عرض المنطقة')

@section('content')
    <div class="container mt-4">
        <div class="d-flex flex-row-reverse mb-3">
            @can('area-edit') {{-- Check if the user has 'area-edit' permission --}}
                <a class="btn btn-primary mr-2" href="{{ route('areas.edit', $area->id) }}">تحرير</a>
            @endcan
            @can('area-delete') {{-- Check if the user has 'area-delete' permission --}}
                <form action="{{ route('areas.destroy', $area->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-2" type="submit" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            @endcan
            <a class="btn btn-secondary" href="{{ route('areas.index') }}">العودة إلى المناطق</a>
        </div>

        <div class="row">
            <div class="card mt-4">
                <div class="card-body mt-4">
                    <div class="d-flex justify-content-center">
                        <h1 class="position-relative">
                            {{ $area->name }}
                            @if($area->postCodeArea)
                                <span class="position-absolute top-0 start-100 ms-5 translate-middle badge rounded-pill bg-primary fs-5">
                                    {{ $area->postCodeArea->code }}
                                    <span class="visually-hidden">الرمز البريدي</span>
                                </span>
                            @endif
                        </h1>
                    </div>

                    <div class="d-flex justify-content-between">

                    </div>

                    <div class="col mt-3">
                        @if($area->streets->count() > 0)
                            <div class="d-flex flex-wrap">
                                @php
                                    $totalStreets = $area->streets->count();
                                @endphp
                                <span class="badge badge-success fs-5 mr-2">عدد الشوارع: {{ $totalStreets }}</span>
                            </div>
                        @else
                            <p class="text-center">لا توجد شوارع في هذه المنطقة.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <div class="accordion mt-3" id="accordionExample">
            <div class="card">
                <div class="card-header navCityShow" id="headingActive">
                    <h5 class="mb-0" data-bs-toggle="collapse" data-bs-target="#collapseStreets" aria-expanded="true"
                        aria-controls="collapseStreets">
                        <i class="fa-solid fa-hand-point-down"></i>
                        <span>
                            الشوارع
                        </span>
                        <div class="col-12 mt-2">
                            <span class="text-secondary fs-6">مجموع الشوارع داخل هذه المنطقة</span>
                        </div>
                    </h5>
                </div>

                <div id="collapseStreets" class="collapse" aria-labelledby="headingActive" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            @foreach($area->streets as $street)
                                <span class="badge badge-success mr-2">{{ $street->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
