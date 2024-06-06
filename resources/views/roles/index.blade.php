@extends('layouts.app')

@section('navbar-title', 'إدارة الأدوار') <!-- Update the title accordingly -->

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
    <div class="row mt-3 py2">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">إدارة الأدوار</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <a class="btn btnColor" href="{{ route('roles.create') }}"> إنشاء دور جديد</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success text-center">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="table-responsive">
        <table id="rolesTable" class="table table-striped mt-4">
            <thead>
                <tr>
                    <th class="col-6">الاسم</th>
                    <th class="col-6">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td class="col-6">{{ $role->name }}</td>
                        <td class="col-6">
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-primary">
                                <i class="fa-solid fa-eye"></i> <!-- Your eye icon for 'View' -->
                            </a>

                            @can('role-edit')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i> <!-- Your edit icon for 'Edit' -->
                                </a>
                            @endcan

                            @can('role-delete')
                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">
                                        <i class="fa-solid fa-trash"></i> <!-- Your trash icon for 'Delete' -->
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {!! $roles->render() !!}
</div>

@endsection
