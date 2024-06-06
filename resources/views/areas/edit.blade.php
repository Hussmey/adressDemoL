@extends('layouts.app')

@section('navbar-title', 'تحرير المنطقة')

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
    <h1 class="text-center">تحرير المنطقة</h1>
    <div class="d-flex flex-row-reverse">
        <a class="btn btn-secondary" href="{{ route('areas.index') }}">العودة إلى القائمة</a>
    </div>

    {{-- Display error messages with alert --}}
    @if ($errors->any())
        <div class="alert alert-danger  mt-3">
            <ul class="text-center">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('areas.update', $area->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">اسم المنطقة:</label>
            <input type="text" class="form-control" name="name" value="{{ $area->name }}" required>
        </div>

        <div class="form-group">
            <label for="city_id">المدينة:</label>
            <select class="form-control" name="city_id" required>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ $area->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="post_code_area_id">منطقة الرمز البريدي:</label>
            <select class="form-control" name="post_code_area_id">
                @foreach ($postCodeAreas as $postCodeArea)
                    <option value="{{ $postCodeArea->id }}" {{ $area->postCodeArea && $area->postCodeArea->id == $postCodeArea->id ? 'selected' : '' }}>{{ $postCodeArea->code }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>

@endsection
