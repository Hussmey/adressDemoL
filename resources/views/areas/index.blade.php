{{-- areas/index.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'جميع المناطق')

@section('content')

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

<div class="container mt-4">
    <div class="text-center">
        <h3 class="text-center">المناطق</h3>
    </div>

    <div class="col-md-3 py-4 mt-2 d-flex justify-content-center">
        @can('area-create') {{-- Check if the user has 'area-create' permission --}}
            <a class="btn btnColor" href="{{ route('areas.create') }}">إنشاء منطقة جديدة</a>
        @endcan
    </div>
    
    <table id="areasTable" class="table table-striped mt-4">
        <thead>
            <tr>
                <th class="col-5">الاسم</th>
                <th class="col-4">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($areas as $area)
                <tr>
                    <td class="col-5">{{ $area->name }}</td>
                    <td class="col-4">
                        <a class="btn btn-primary" href="{{ route('areas.show', $area->id) }}">
                            <i class="fas fa-eye"></i> <!-- Font Awesome Eye icon for 'Show' -->
                        </a>
                        @can('area-edit') {{-- Check if the user has 'area-edit' permission --}}
                            <a class="btn btn-warning" href="{{ route('areas.edit', $area->id) }}">
                                <i class="fas fa-edit"></i> <!-- Font Awesome Edit icon for 'Edit' -->
                            </a>
                        @endcan
                        @can('area-delete') {{-- Check if the user has 'area-delete' permission --}}
                            <form action="{{ route('areas.destroy', $area->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">
                                    <i class="fas fa-trash-alt"></i> <!-- Font Awesome Trash icon for 'Delete' -->
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
