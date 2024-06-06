{{-- areas/create.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'إنشاء منطقة جديدة')

@section('content')


{{-- Toast for success or error message --}}
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
        <h3 class="text-center">إنشاء منطقة جديدة</h3>
        <div class="d-flex flex-row-reverse">
            <a class="btn btn-secondary" href="{{ route('areas.index') }}">العودة إلى القائمة</a>
        </div>

        <form action="{{ route('areas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">اسم المنطقة:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="city_id">المدينة:</label>
                <select class="form-control" name="city_id" required>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group d-flex justify-content-between">
                <div class="col-8">
                 <label for="post_code_area_id">رمز المنطقة البريدية:</label>
                <select class="form-control" name="post_code_area_id" required>
                    @foreach ($postCodeAreas as $postCodeArea)
                        <option value="{{ $postCodeArea->id }}">{{ $postCodeArea->code }}</option>
                    @endforeach
                </select>
                </div>
                <div class="col-4 d-flex align-items-center d-flex justify-content-evenly ">
                <a href="{{ route('postCodeAreas.create') }}" style="text-decoration: none;">إنشاء منطقة جديدة للرمز البريدي</a>
                <i class="fa-solid fa-map-location-dot"></i>
                </div>
              

            </div>
            <button type="submit" class="btn btnColor">إنشاء</button>
        </form>



    </div>
@endsection
