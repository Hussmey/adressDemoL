{{-- houses/show.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'عرض المنزل')

@section('content')
    <div class="container mt-4">
        <div class="d-flex flex-row-reverse mb-3">
            @can('house-edit', $house) {{-- Check if the user has 'house-edit' permission for this specific house --}}
                <a class="btn btn-primary mr-2" href="{{ route('houses.edit', $house->id) }}">تحرير</a>
            @endcan
            @can('house-delete', $house) {{-- Check if the user has 'house-delete' permission for this specific house --}}
                <form action="{{ route('houses.destroy', $house->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-2" type="submit" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            @endcan
            <a class="btn btn-secondary" href="{{ route('houses.index') }}">العودة إلى المنازل</a>
        </div>

        <div class="row">
            <div class="card mt-4">
                <div class="card-body mt-4">
                    <div class="d-flex justify-content-center">
                        <h1 class="position-relative">
                            <span class="position-absolute top-0 start-100  translate-middle badge rounded-pill bg-primary fs-5">
                                {{ $house->street->name }} {{ $house->number }}
                                <span class="visually-hidden">street name</span>
                            </span>
                        </h1>
                    </div>

                    <div class="d-flex justify-content-between">

                    </div>

                    <div class="col mt-3">
                    <p class="text-center">خط العرض: {{ $house->latitude }}</p>
                        <p class="text-center">خط الطول: {{ $house->longitude }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
