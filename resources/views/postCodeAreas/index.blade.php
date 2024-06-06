{{-- postCodeAreas/index.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'جميع الرموز البريدية')

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

<div class="container">
    <div class="row">
        <div class="text-center">
            <h3 class="text-center"> مناطق الرموز البريدية</h3>
        </div>
        <div class="col-md-3 py-4 mt-2 d-flex justify-content-center">
            @can('postcodearea-create') {{-- Check if the user has 'postcodearea-create' permission --}}
                <a href="{{ route('postCodeAreas.create') }}" class="btn btnColor">إنشاء منطقة جديدة للرمز البريدي</a>
            @endcan
        </div>
        <div class="table-responsive">
        <table id="postCodesTable" class="table table-striped mt-4">
            <thead>
                <tr>
                    <th class="1">المعرف</th>
                    <th class="3">الرمز</th>
                    <th class="4">اسم المنطقة</th>
                    <th class="4">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postCodeAreas as $postCodeArea)
                    <tr>
                        <td class="1">{{ $postCodeArea->id }}</td>
                        <td class="3">{{ $postCodeArea->code }}</td>
                        <td class="4">{{ $postCodeArea->area->name ?? 'N/A' }}</td>
                        <td class="4">
                            @can('postcodearea-list', $postCodeArea) {{-- Check if the user has 'postcodearea-show' permission for this specific postCodeArea --}}
                                <a href="{{ route('postCodeAreas.show', $postCodeArea->id) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> <!-- Font Awesome Eye icon for 'View' -->
                                </a>
                            @endcan
                            @can('postcodearea-edit', $postCodeArea) {{-- Check if the user has 'postcodearea-edit' permission for this specific postCodeArea --}}
                                <a href="{{ route('postCodeAreas.edit', $postCodeArea->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> <!-- Font Awesome Edit icon for 'Edit' -->
                                </a>
                            @endcan
                            @can('postcodearea-delete', $postCodeArea) {{-- Check if the user has 'postcodearea-delete' permission for this specific postCodeArea --}}
                                <form action="{{ route('postCodeAreas.destroy', $postCodeArea->id) }}" method="POST" style="display: inline;">
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
    </div>
</div>
@endsection
