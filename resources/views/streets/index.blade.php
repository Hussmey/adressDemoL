@extends('layouts.app')

@section('navbar-title', 'جميع الشوارع')

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
        <div class="row">
            <div class="text-center">
                <h3 class="text-center">الشوارع</h3>
            </div>
            <div class="col-md-3 py-4 mt-2 d-flex justify-content-center">
                @can('street-create') {{-- Check if the user has 'street-create' permission --}}
                    <a class="btn btnColor" href="{{ route('streets.create') }}">إنشاء شارع جديد</a>
                @endcan
            </div>
            <table id="streetsTable" class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th class="col-4">الاسم</th>
                        <th class="col-4">المنطقة</th>
                        <th class="col-4">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($streets as $street)
                        <tr>
                            <td class="col-4">{{ $street->name }}</td>
                            <td class="col-4">{{ $street->area->name ?? '-' }}</td>
                            <td class="col-4">
                                @can('street-list') {{-- Check if the user has 'street-show' permission --}}
                                    <a class="btn btn-primary" href="{{ route('streets.show', $street->id) }}">
                                        <i class="fas fa-eye"></i> <!-- Font Awesome Eye icon for 'Show' -->
                                    </a>
                                @endcan
                                @can('street-edit') {{-- Check if the user has 'street-edit' permission --}}
                                    <a class="btn btn-warning" href="{{ route('streets.edit', $street->id) }}">
                                        <i class="fas fa-edit"></i> <!-- Font Awesome Edit icon for 'Edit' -->
                                    </a>
                                @endcan
                                @can('street-delete') {{-- Check if the user has 'street-delete' permission --}}
                                    <form action="{{ route('streets.destroy', $street->id) }}" method="POST" style="display:inline;">
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
@endsection
