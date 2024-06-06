{{-- cities/index.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'جميع المدن')

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
            <h3 class="text-center">المدن</h3>
        </div>
        <div class="col-md-3 py-4 mt-2 d-flex justify-content-center">
            @can('city-create') {{-- Check if the user has 'city-create' permission --}}
                <a class="btn btnColor" href="{{ route('cities.create') }}">إنشاء مدينة جديدة</a>
            @endcan
        </div>
        <table id="citiesTable" class="table table-striped mt-4">
            <thead>
                <tr>
                    <th class="col-5">الاسم</th>
                    <th class="col-3">الرمز البريدي</th>
                    <th class="col-4">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cities as $city)
                    <tr>
                        <td class="col-5">{{ $city->name }}</td>
                        <td class="col-3">
                            @if($city->postalCodes)
                                {{ $city->postalCodes->code }}
                            @endif
                        </td>
                        <td class="col-4">
                            <a class="btn btn-primary" href="{{ route('cities.show', $city->id) }}">
                                <i class="fas fa-eye"></i> <!-- Font Awesome Eye icon for 'Show' -->
                            </a>
    
                            @can('city-edit') {{-- Check if the user has 'city-edit' permission --}}
                                <a class="btn btn-warning" href="{{ route('cities.edit', $city->id) }}">
                                    <i class="fas fa-edit"></i> <!-- Font Awesome Edit icon for 'Edit' -->
                                </a>
                            @endcan
    
                            @can('city-delete') {{-- Check if the user has 'city-delete' permission --}}
                                <form action="{{ route('cities.destroy', $city->id) }}" method="POST" style="display:inline;">
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
