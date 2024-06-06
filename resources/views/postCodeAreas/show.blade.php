@extends('layouts.app')

@section('navbar-title', 'عرض منطقة الرمز البريدي')

@section('content')
    <div class="container mt-4">
        <div class="d-flex flex-row-reverse mb-3">
            @can('postcodearea-edit', $postCodeArea) {{-- Check if the user has 'postcodearea-edit' permission for this specific postCodeArea --}}
                <a class="btn btn-warning mr-2" href="{{ route('postCodeAreas.edit', $postCodeArea->id) }}">تحرير</a>
            @endcan
            @can('postcodearea-delete', $postCodeArea) {{-- Check if the user has 'postcodearea-delete' permission for this specific postCodeArea --}}
                <form action="{{ route('postCodeAreas.destroy', $postCodeArea->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-2" type="submit" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            @endcan
            <a class="btn btn-secondary" href="{{ route('postCodeAreas.index') }}">العودة إلى قائمة رموز البريد</a>
        </div>

        <div class="row">
            <div class="card mt-4">
                <div class="card-body mt-4">
                    <p class="text-center">رمز المنطقة: {{ $postCodeArea->code }}</p>
                    <p class="text-center">اسم المنطقة: {{ $postCodeArea->area->name ?? 'N/A' }}</p>
                    <div class="d-flex justify-content-between">
                        <!-- Additional details if needed -->
                    </div>
                </div>
            </div>
        </div>

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
    </div>
@endsection
