{{-- houses/index.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'جميع البيوت')

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
                <h3 class="text-center">البيوت</h3>
            </div>
            <div class="col-md-3 py-4 mt-2 d-flex justify-content-center">
                @can('house-create') {{-- Check if the user has 'house-create' permission --}}
                    <a class="btn btnColor" href="{{ route('houses.create') }}">إنشاء بيت جديد</a>
                @endcan
            </div>

            <table id="housesTable" class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-4">رقم البيت</th>
                        <th class="col-4">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($houses as $house)
                        <tr>
                            <td class="col-4">{{ $house->number }}</td>
                            <td class="col-4">
                                <a class="btn btn-primary" href="{{ route('houses.show', $house->id) }}">
                                    <i class="fas fa-eye"></i> <!-- Font Awesome Eye icon for 'Show' -->
                                </a>
                                @can('house-edit', $house) {{-- Check if the user has 'house-edit' permission for this specific house --}}
                                    <a class="btn btn-warning" href="{{ route('houses.edit', $house->id) }}">
                                        <i class="fas fa-edit"></i> <!-- Font Awesome Edit icon for 'Edit' -->
                                    </a>
                                @endcan
                                @can('house-delete', $house) {{-- Check if the user has 'house-delete' permission for this specific house --}}
                                    <form action="{{ route('houses.destroy', $house->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('هل أنت متأكد؟')">
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
