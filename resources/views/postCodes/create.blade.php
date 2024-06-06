{{-- postCodes/create.blade.php --}}
@extends('layouts.app')

@section('navbar-title', 'إنشاء رمز بريدي جديد')

@section('content')
    <div class="container mt-4">
        <h3 class="text-center">إنشاء رمز بريدي جديد</h3>
        <div, class="d-flex flex-row-reverse">
      <a class="btn btn-secondary " href="{{ route('postCodes.index') }}">العودة إلى القائمة</a>      
        </div>
        
        <form action="{{ route('postCodes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="code">الرمز البريدي:</label>
                <input type="text" class="form-control" name="code" required>
            </div>
            <div class="form-group">
                <label for="city_id">المدينة:</label>
                <select class="form-control" name="city_id" required>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btnColor">إنشاء</button>
        </form>

        {{-- Toast for success or error message --}}
        @if (session('success') || session('error'))
            <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true"
                style="position: absolute; top: 0; left: 50%; transform: translateX(-50%);">
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
        @endif

    </div>
@endsection
