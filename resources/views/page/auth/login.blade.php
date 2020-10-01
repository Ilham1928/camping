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
                                    <p>Simplicity is the ultimate sophistication.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 bg-white">
                            <div class="form d-flex align-items-center">
                                <div class="content">
                                    <p class="error-message" style="width:100% !important; margin-left:0px !important;"></p>
                                    <form>
                                        <div class="form-group">
                                            <input type="text" name="email" required data-msg="Please enter your username" class="input-material">
                                            <label for="login-username" class="label-material">User Name</label>
                                        </div>
                                        <div class="form-group">
                                            <input id="login-password" onchange="auth()" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                                            <label for="login-password" class="label-material">Password</label>
                                        </div>
                                        <button id="login" type="button" onclick="auth()" class="btn btn-primary" name="button">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyrights text-center">
                <p>Codepoint</p>
            </div>
        </div>
    </body>
    @include('/../../template.footer')
    <script src="{{ url('js/page/general/auth/auth.js') }}" charset="utf-8"></script>
</html>
