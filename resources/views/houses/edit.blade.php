{{-- houses/edit.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'تحرير المنزل')

@section('content')
    <div class="container mt-4">
        <h3 class="text-center">تحرير المنزل</h3>
        <div class="d-flex flex-row-reverse">
            <a class="btn btn-secondary" href="{{ route('houses.index') }}">العودة إلى المنازل</a>
        </div>
        <form action="{{ route('houses.update', $house->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="number">رقم المنزل:</label>
                <input type="text" class="form-control" name="number" value="{{ $house->number }}" required>
            </div>
            <div class="form-group">
                <label for="latitude">خط العرض:</label>
                <input type="text" class="form-control" name="latitude" value="{{ $house->latitude }}" required>
            </div>
            <div class="form-group">
                <label for="longitude">خط الطول:</label>
                <input type="text" class="form-control" name="longitude" value="{{ $house->longitude }}" required>
            </div>
            <div class="form-group">
                <label for="street_id">الشارع:</label>
                <select class="form-control" name="street_id" required>
                    @foreach ($streets as $street)
                        <option value="{{ $street->id }}" {{ $house->street_id == $street->id ? 'selected' : '' }}>
                            {{ $street->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>

        {{-- Toast --}}
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
    </div>
@endsection
