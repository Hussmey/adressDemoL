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

<div class="container mt-4">
    <div class="row">
        <div class="text-center">
            <h3 class="text-center">الرموز البريدية</h3>
        </div>
        <div class="col-md-3 py-4 mt-2 d-flex justify-content-center">
            @can('postcode-create') {{-- Check if the user has 'postcode-create' permission --}}
                <a class="btn btnColor" href="{{ route('postCodes.create') }}">إنشاء رمز بريدي جديد</a>
            @endcan
        </div>
        <table id="postCodesTable" class="table table-striped mt-4">
            <thead>
                <tr>
                    <th class="col-2">الرمز البريدي</th>
                    <th class="col-4">اسم المدينة</th>
                    <th class="col-6">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postCodes as $postCode)
                    <tr>
                        <td class="col-2">{{ $postCode->code }}</td>
                        <td class="col-4">{{ $postCode->city->name }}</td>
                        <td class="col-6">
                            @can('postcode-list') {{-- Check if the user has 'postcode-list' permission --}}
                                <a class="btn btn-primary" href="{{ route('postCodes.show', $postCode->id) }}">
                                    <i class="fas fa-eye"></i> <!-- Font Awesome Eye icon for 'View' -->
                                </a>
                            @endcan
                            @can('postcode-edit') {{-- Check if the user has 'postcode-edit' permission --}}
                                <a class="btn btn-warning" href="{{ route('postCodes.edit', $postCode->id) }}">
                                    <i class="fas fa-edit"></i> <!-- Font Awesome Edit icon for 'Edit' -->
                                </a>
                            @endcan
                            @can('postcode-delete') {{-- Check if the user has 'postcode-delete' permission --}}
                                <form action="{{ route('postCodes.destroy', $postCode->id) }}" method="POST" style="display:inline;">
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
