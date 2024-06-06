@extends('layouts.app')

@section('content')
<section class="bg-light p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xxl-11">
        <div class="row g-0">
          <div class="col-12 col-md-6">
            <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('img/singUpMap.jpg') }}" alt="ترحيب بصفحة التسجيل">
          </div>
          <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
            <div class="col-12 col-lg-11 col-xl-10">
              <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                  <div class="col-12">
                    <div class="mb-5">
                      <h4 class="text-center">إنشاء حساب جديد</h4>
                    </div>
                  </div>
                </div>
                <form method="POST" action="{{ route('register') }}">
                  @csrf

                  <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">الاسم</label>
                    <div class="col-md-8">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">البريد الإلكتروني</label>
                    <div class="col-md-8">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">كلمة المرور</label>
                    <div class="col-md-8">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">تأكيد كلمة المرور</label>
                    <div class="col-md-8">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                  </div>

                  <div class="row mb-0">
                    <div class="col-md-12 d-flex justify-content-md-center">
                      <button type="submit" class="btn btn-lg btn-outline-dark">تسجيل</button>
                    </div>
                  </div>
                </form>
                <div class="row mt-4">
  <div class="col-12 d-flex justify-content-md-center">
    <p class="text-center">هل لديك حساب؟</p>
    <div class="pr-3 d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center ">
      <a href="{{ route('login') }}" class="link-secondary text-decoration-none">تسجيل الدخول</a>
    </div>
  </div>
</div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
