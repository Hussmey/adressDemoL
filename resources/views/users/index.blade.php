@extends('layouts.app')

@section('navbar-title', 'إدارة المستخدمين')

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
            <h3 class="text-center">إدارة المستخدمين</h3>
        </div>
        <div class="col-md-3 py-4 mt-2 d-flex justify-content-center">
            @can('user-create') <!-- Check if the user has 'user-create' permission -->
                <a class="btn btnColor" href="{{ route('users.create') }}">إنشاء مستخدم جديد</a>
            @endcan
        </div>
        <div class="table-responsive">
        <table id="usersTable" class="table table-striped mt-4">
            <thead>
                <tr>
                    <th class="col-4">الاسم</th>
                    <th class="col-3">البريد الإلكتروني</th>
                    <th class="col-2">الأدوار</th>
                    <th class="col-3">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                    <tr>
                        <td class="col-4">{{ $user->name }}</td>
                        <td class="col-3">{{ $user->email }}</td>
                        <td class="col-2">
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td class="col-3">
                            <a class="btn btn-primary" href="{{ route('users.show', $user->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
    
                            @can('user-edit') <!-- Check if the user has 'user-edit' permission -->
                                <a class="btn btn-warning" href="{{ route('users.edit', $user->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
    
                            @can('user-delete') <!-- Check if the user has 'user-delete' permission -->
        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
            {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('هل أنت متأكد؟')"]) !!}
        {!! Form::close() !!}
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
