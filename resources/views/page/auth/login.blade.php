<!DOCTYPE html>
<html>
    <head>
        <title>{{ Session::get('brand') }} | {{$title}}</title>
        @include('/../../template.header')
    </head>
    <body>
        <div class="page login-page">
            <div class="container d-flex align-items-center">
                <div class="form-holder has-shadow">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="info d-flex align-items-center">
                                <div class="content">
                                    <div class="logo">
                                        <h1>{{ Session::get('brand') }}</h1>
                                    </div>
                                    <p>Sewa alat camping & tour guide.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 bg-white" id="login-div">
                            <div class="form d-flex align-items-center">
                                <div class="content">
                                    <p class="error-message" style="width:100% !important; margin-left:0px !important;"></p>
                                    <form>
                                        <div class="form-group">
                                            <input type="text" name="email" required data-msg="Please enter your username" class="input-material">
                                            <label for="login-username" class="label-material">Email</label>
                                        </div>
                                        <div class="form-group">
                                            <input id="login-password" onchange="login()" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                                            <label for="login-password" class="label-material">Password</label>
                                        </div>
                                        <button id="login" type="button" onclick="login()" class="btn btn-primary" name="button">Login</button>
                                        <div class="form-group">
                                            <p>Tidak punya akun? <a href="#" onclick="getFormRegister()">Daftar disini</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 bg-white" id="register-div" style="display:none">
                            <div class="form d-flex align-items-center">
                                <div class="content">
                                    <p class="error-message" style="width:100% !important; margin-left:0px !important;"></p>
                                    <form>
                                        <div class="form-group">
                                            <input type="text" autocomplete="off" name="email" required class="input-material">
                                            <label for="login-username" class="label-material">Nama Lengkap</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="id_card" required class="input-material">
                                            <label for="login-username" class="label-material">No. Kartu identitas</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" required class="input-material">
                                            <label for="login-password" class="label-material">Password</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" required class="input-material">
                                            <label for="login-password-confirmation" class="label-material">Konfirmasi Password</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="address" required class="input-material">
                                            <label for="login-address" class="label-material">Alamat</label>
                                        </div>
                                        <button id="register" type="button" onclick="register()" class="btn btn-primary" name="button">Register</button>
                                        <div class="form-group">
                                            <p>Memiliki akun? <a href="#" onclick="getFormLogin()">Masuk disini</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyrights text-center">
                <p>Spader Outdor Gear</p>
            </div>
        </div>
    </body>
    @include('/../../template.footer')
    <script src="{{ url('js/page/general/auth/auth.js') }}" charset="utf-8"></script>
</html>
