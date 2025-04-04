@extends('dashboard')

@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card" style="border: solid 1px black;">
                    <h4 class="text-center" style="margin: 20px 10px;">Màn hình đăng kí</h4>
                    <div class="card-body">
                        <form action="{{ route('user.postUser') }}" method="POST" enctype="multipart/form-data" id="registerForm">
                            @csrf
                            <!-- Username -->
                            <div class="form-group mb-2">
                                <div class="row text-center">
                                    <div class="col-md-4" style="">Username</div>
                                    <div class="col-md-8" style="text-align: left; margin-bottom: 10px;">
                                        <input type="text" id="name" style="border: solid 1px; width: 215px;" name="name"
                                            required autofocus>
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-group mb-2">
                                    <div class="row text-center">
                                        <div class="col-md-4" style="">Email</div>
                                        <div class="col-md-8" style="text-align: left;">
                                            <input type="text" id="email_address" style="border: solid 1px; width: 215px;"
                                                name="email" required autofocus>
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Mật khẩu -->
                                <div class="form-group mb-2">
                                    <div class="row text-center">
                                        <div class="col-md-4" style="">Mật khẩu</div>
                                        <div class="col-md-8" style="text-align: left;">
                                            <input type="password" id="password" style="border: solid 1px; width: 215px;"
                                                name="password" required>
                                            @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <!--Nhập lại mật khẩu -->
                                <div class="form-group mb-2">
                                    <div class="row text-center">
                                        <div class="col-md-4" style="">Nhập lại mật khẩu</div>
                                        <div class="col-md-8" style="text-align: left;">
                                            <input type="password" id="confirmPassword" style="border: solid 1px; width: 215px;"
                                                name="confirmPassword" required>
                                            <span id="errorMessage" class="text-danger"></span><br>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="row">
                                    <div class="col-md-8" style="text-align: right; margin-top: 6px;">
                                        <a href="#" style="text-align: right; text-decoration: none; font-size: 13px;">Bạn đã có tài khoản?</a>
                                    </div>
                                    <div class="col-md-4" style="padding-left: 5px;">
                                        <div class="" style="text-align: left; ">
                                            <button type="submit" class="btn btn-primary btn-block" style=" margin-left: 11px;">Đăng kí</button>
                                        </div>



                        </form>
                        <script>
                            document.getElementById("registerForm").addEventListener("submit", function(event) {
                                var password = document.getElementById("password").value;
                                var confirmPassword = document.getElementById("confirmPassword").value;
                                var error = document.getElementById("errorMessage");

                                if (password !== confirmPassword) {
                                    error.textContent = "Mật khẩu không trùng khớp";
                                    event.preventDefault();
                                } else {
                                    error.textContent = "";
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection