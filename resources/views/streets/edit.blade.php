{{-- streets/edit.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'تحرير الشارع')

@section('content')
    <div class="container mt-4">
        <h3 class="text-center">تحرير الشارع</h3>
        <div class="d-flex flex-row-reverse">
        <a class="btn btn-secondary" href="{{ route('streets.index') }}">العودة إلى الشوارع</a>
    </div>
        <form action="{{ route('streets.update', $street->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">اسم الشارع:</label>
                <input type="text" class="form-control" name="name" value="{{ $street->name }}" required>
            </div>
            <div class="form-group">
                <label for="area_id">المنطقة:</label>
                <select class="form-control" name="area_id" required>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ $street->area_id == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>
    </div>

    {{-- Toast --}}
    <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 0; left: 50%; transform: translateX(-50%);">
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
@endsection
