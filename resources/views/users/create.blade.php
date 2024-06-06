@extends('layouts.app')

@section('navbar-title', 'إنشاء مستخدم جديد')

@section('content')
<div class="container mt-4">
    <h3 class="text-center">إنشاء مستخدم جديد</h3>
    <div class="d-flex flex-row-reverse mb-3">
        <a class="btn btn-secondary" href="{{ route('users.index') }}">العودة إلى القائمة</a>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>عذرًا!</strong> كانت هناك بعض المشاكل في الإدخال الخاص بك.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">الاسم:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">البريد الإلكتروني:</label>
            <input type="text" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">كلمة المرور:</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">تأكيد كلمة المرور:</label>
            <input type="password" class="form-control" name="confirm-password" required>
        </div>
        <div class="form-group">
            <label for="roles">الدور:</label>
            {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
        </div>
        <button type="submit" class="btn btnColor">إرسال</button>
    </form>
</div>

@endsection
