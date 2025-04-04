@extends('dashboard')
<style>
  .error-message {
    color: red;
}
</style>
@section('content')
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Update User</h3>
                        <div class="card-body">
                            <form action="{{ route('user.postUpdateUser') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <div class="row">
                                <div class="col-md-4" style="text-align: center">
                                        <p style="margin-top:20px">User name</p>
                                        <p style="margin-top:35px">Email</p>
                                        <p style="margin-top:28px">Nhập lại mặt khẩu</p>
                                    </div>
                                <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <input type="text" style="border: solid 1px; width: 250px; margin-top:15px;" placeholder="Name" id="name" class="form-control" name="name"
                                           value="{{ $user->name }}"
                                           required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" style="border: solid 1px; width: 250px; margin-top:15px;" placeholder="Email" id="email_address" class="form-control"
                                           value="{{ $user->email }}"
                                           name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" style="border: solid 1px; width: 250px; margin-top:15px;" placeholder="Password" id="password" class="form-control"
                                           name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-8" style="text-align: right; margin-top: 6px; margin-left:">
                                        <a href="http://127.0.0.1:8000/login" style="text-align: right; text-decoration: none; font-size: 13px;">Đã có tài khoản</a>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="" style="text-align: right; margin-right: 50px">
                                    <button type="submit" class="btn btn-primary btn-block">Cập Nhật</button>
                                </div>

                              
                            </form> 
                            
                        </div>
                        <!-- <div class="d-grid mx-auto">
                            <a href="{{route('user.list')}}" class="btn btn-dark btn-block">Back</a>
                      </div> -->
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection