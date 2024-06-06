{{-- opinions/show.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'عرض الرأي')

@section('content')
    <div class="container mt-4">
        <div class="d-flex flex-row-reverse mb-3">
        <form action="{{ route('opinions.updateReviewStatus', ['opinion' => $opinion]) }}" method="POST">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success mr-2">تمت المراجعة</button>
</form>
             <a class="btn btn-secondary" href="{{ route('opinions.index') }}">العودة إلى الآراء</a>
        </div>

        <div class="row">
            <div class="card mt-4">
                <div class="card-body mt-4">
                    <div class="d-flex justify-content-center">
                        <h1 class="position-relative">
                            {{ $opinion->name }}
                            <span class="badge badge-info fs-5 ms-2">
                                {{ $opinion->latitude }}, {{ $opinion->longitude }}
                            </span>
                        </h1>
                    </div>

                    <ul class="list-group mt-3 opinionShoList">
                        <li class="list-group-item list-group-item-info"><i class="fa-solid fa-map-location-dot icon"></i> <strong>الاسم:</strong> {{ $opinion->name }}</li>
                        <li class="list-group-item list-group-item-success"><i class="fas fa-globe icon"></i> <strong>خط العرض:</strong> {{ $opinion->latitude }}</li>
                        <li class="list-group-item list-group-item-danger"><i class="fas fa-globe icon"></i> <strong>خط الطول:</strong> {{ $opinion->longitude }}</li>
                        <li class="list-group-item list-group-item-warning"><i class="fas fa-tag icon"></i> <strong>النوع:</strong> {{ $opinion->type }}</li>
                        <li class="list-group-item list-group-item-primary"><i class="fas fa-user icon"></i> <strong>اسم المستخدم:</strong> {{ $opinion->user_name }}</li>
                        <li class="list-group-item list-group-item-secondary"><i class="fas fa-envelope icon"></i> <strong>الرسالة:</strong> {{ $opinion->message ?? 'N/A' }}</li>
                        <li class="list-group-item list-group-item-light"><i class="{{ $opinion->active ? 'fas fa-check text-success' : 'fas fa-times text-danger' }} icon"></i> <strong>نشط:</strong> {{ $opinion->active ? 'نعم' : 'لا' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
