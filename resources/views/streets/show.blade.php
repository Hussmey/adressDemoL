@extends('layouts.app')

@section('navbar-title', 'عرض الشارع')

@section('content')
    <div class="container mt-4">
        <div class="d-flex flex-row-reverse mb-3">
            @can('street-edit') {{-- Check if the user has 'street-edit' permission --}}
                <a class="btn btn-primary mr-2" href="{{ route('streets.edit', $street->id) }}">تحرير</a>
            @endcan
            @can('street-delete') {{-- Check if the user has 'street-delete' permission --}}
                <form action="{{ route('streets.destroy', $street->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-2" type="submit" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            @endcan
            <a class="btn btn-secondary" href="{{ route('streets.index') }}">العودة إلى الشوارع</a>
        </div>

        <div class="row">
            <div class="card mt-4">
                <div class="card-body mt-4">
                    <h3 class="text-center">{{ $street->name }}</h3>
                    <p class="text-center">المنطقة: {{ $street->area->name }}</p>
                    <div class="d-flex justify-content-between">
                        <!-- Additional details if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
