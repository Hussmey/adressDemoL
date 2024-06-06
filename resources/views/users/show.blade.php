{{-- users/show.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'عرض المستخدم')

@section('content')
    <div class="container mt-4">
        <div class="d-flex flex-row-reverse mb-3">
            {{-- Adjust buttons based on user permissions --}}
            @can('user-edit', $user)
                <a class="btn btn-primary mr-2" href="{{ route('users.edit', $user->id) }}">تحرير</a>
            @endcan

            @can('user-delete', $user)
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-2" type="submit" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            @endcan

            <a class="btn btn-secondary" href="{{ route('users.index') }}">العودة إلى المستخدمين</a>
        </div>

        <div class="row">
            <div class="card mt-4">
                <div class="card-body mt-4">
                    <div class="d-flex justify-content-center">
                        <h1 class="position-relative">
                            {{ $user->name }}
                        </h1>
                    </div>

                    <div class="d-flex justify-content-between"></div>

                    <div class="col mt-3">
                        {{-- Display user details --}}
                        <div class="form-group">
                            <strong>الاسم:</strong>
                            {{ $user->name }}
                        </div>

                        <div class="form-group">
                            <strong>البريد الإلكتروني:</strong>
                            {{ $user->email }}
                        </div>

                        <div class="form-group">
                            <strong>الأدوار:</strong>
                            @if(!empty($user->getRoleNames()))
                                <div class="accordion mt-3" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header navCityShow" id="rolesHeader">

                                            <h5 class="mb-0"  type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#rolesCollapse" aria-expanded="true"
                                                        aria-controls="rolesCollapse">
                                                        <i class="fa-solid fa-hand-point-down"></i>
                                                        <span>
                            الأدوار ({{ count($user->getRoleNames()) }})
                        </span>
                                                    
                                              
                                            </h5>
                                        </div>
                                        <div id="rolesCollapse" class="collapse show" aria-labelledby="rolesHeader"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap">
                                                    @foreach($user->getRoleNames() as $v)
                                                        <span class="badge badge-success mr-2">{{ $v }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
