{{-- cities/edit.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'تحرير المدينة')

@section('content')


    <div class="container mt-4">
        <h3 class="text-center">تحرير المدينة</h3>
        <div, class="d-flex flex-row-reverse">
      <a class="btn btn-secondary " href="{{ route('cities.index') }}">العودة إلى القائمة</a>      
        </div>      
          <form action="{{ route('cities.update', $city->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">اسم المدينة:</label>
                <input type="text" class="form-control" name="name" value="{{ $city->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>
    </div>
@endsection
