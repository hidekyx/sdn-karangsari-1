<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
                <img src="{{ asset('storage/assets/images/logo.png') }}" alt="Logo" />
            </div>
            <h4>Selamat datang!</h4>
            <h6 class="fw-light">Silahkan login untuk melanjutkan.</h6>
            <form role="form" class="pt-3" action="{{ asset('/login_action') }}" method="post" enctype="multipart/form-data">
            @csrf
                @if (Session::has('error'))
                    <div role="alert" class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                        <strong><i class="fa fa-exclamation-circle"></i> Gagal!</strong>
                        {{ Session::get('error') }}
                    </div>
                @endif
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOG IN</a>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>