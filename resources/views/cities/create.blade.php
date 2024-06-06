{{-- ملف cities/create.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'إنشاء مدينة')

@section('content')
    <div class="container mt-4">
        <h3 class="text-center">إنشاء مدينة</h3>
        <div, class="d-flex flex-row-reverse">
      <a class="btn btn-secondary " href="{{ route('cities.index') }}">العودة إلى القائمة</a>      
        </div>
        
        <form action="{{ route('cities.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">اسم المدينة:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <button type="submit" class="btn btnColor">إنشاء</button>
        </form>
     
    </div>
@endsection
