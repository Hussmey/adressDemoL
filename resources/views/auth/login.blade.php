@extends('layouts.app')

@section('content')
<!-- تسجيل الدخول 8 - Bootstrap Brain Component -->
<section class="bg-light p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xxl-11">
        <div class="row g-0">
          <div class="col-12 col-md-6">
            <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('img/maplibya.jpg') }}" alt="مرحبًا بك مرة أخرى، لقد فاتناك!">
          </div>
          <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
            <div class="col-12 col-lg-11 col-xl-10">
              <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                  <div class="col-12">
                    <div class="mb-5">
                      <h4 class="text-center">مرحبًا بك مرة أخرى !</h4>
                    </div>
                  </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="row gy-3 overflow-hidden" >
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control text-end rtl-placeholder" name="email" id="email" placeholder="البريد الإلكتروني" required >
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control text-end rtl-placeholder" name="password" id="password" value="" placeholder="كلمة المرور" required>
                        <label for="password" class="form-label">كلمة المرور</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="remember" id="remember">
                        <label class="form-check-label text-secondary" for="remember">
                          البقاء متصلاً
                        </label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button class="btn btn-lg btn-outline-dark " type="submit">تسجيل الدخول الآن</button>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                      <a href="{{ route('register') }}" class="link-secondary text-decoration-none">إنشاء حساب جديد</a>
                     <!-- <a href="{{ route('password.request') }}" class="link-secondary text-decoration-none">نسيت كلمة المرور</a> -->
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
