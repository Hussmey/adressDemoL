@extends('layouts.app')

@section('navbar-title', 'عرض رمز بريدي')

@section('content')
    <div class="container mt-4">
        <div class="d-flex flex-row-reverse mb-3">
            @can('postcode-edit') {{-- Check if the user has 'postcode-edit' permission --}}
                <a class="btn btn-primary mr-2" href="{{ route('postCodes.edit', $postCode->id) }}">تحرير</a>
            @endcan
            @can('postcode-delete') {{-- Check if the user has 'postcode-delete' permission --}}
                <form action="{{ route('postCodes.destroy', $postCode->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-2" type="submit" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            @endcan
            <a class="btn btn-secondary" href="{{ route('postCodes.index') }}">العودة إلى رموز البريد</a>
        </div>

        <div class="row">
            <div class="card mt-4">
                <div class="card-body mt-4">
                    <h3 class="text-center">{{ $postCode->code }}</h3>
                    <p class="text-center">المدينة: {{ $postCode->city->name }}</p>
                    <div class="d-flex justify-content-between">
                        <!-- Additional details if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
