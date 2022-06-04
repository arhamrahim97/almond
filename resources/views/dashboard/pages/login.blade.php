<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('assets') }}/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets') }}/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('assets') }}/css/fonts.min.css"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/atlantis.css">

    <style>
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100000;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
</head>

<body class="login">
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <div class="wrapper wrapper-login wrapper-login-full p-0">
        <div
            class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-secondary-gradient">
            <h1 class="title fw-bold text-white mb-3">Inventori</h1>
            {{-- <p class="subtitle text-white op-7">Ayo bergabung dengan komunitas kami untuk masa depan yang lebih baik</p> --}}
        </div>
        <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
            <div class="container container-login container-transparent animated fadeIn">
                <h3 class="text-center">Masuk sebagai Admin / Staf</h3>
                <div class="login-form">
                    <form action="{{ url('/cekLogin') }}" method="POST" id="formLogin">

                        @csrf
                        <div class="form-group">
                            <label for="username" class="placeholder"><b>Nama Pengguna</b></label>
                            <input id="username" name="username" type="text" class="form-control req"
                                data-label="Nama Pengguna">
                            <span class="text-danger d-block error-text username-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="password" class="placeholder"><b>Kata Sandi</b></label>
                            {{-- <a href="#" class="link float-right">Forget Password ?</a> --}}
                            <div class="position-relative">
                                <input id="password" name="password" type="password" class="form-control req"
                                    data-label="Password">
                                <div class="show-password">
                                    <i class="icon-eye"></i>
                                </div>
                            </div>
                            <span class="text-danger d-block error-text password-error"></span>
                        </div>
                        <div class="form-group form-action-d-flex mb-3 text-center justify-content-center">
                            {{-- <div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="rememberme">
								<label class="custom-control-label m-0" for="rememberme">Remember Me</label>
							</div> --}}
                            <button type="submit"
                                class="btn btn-secondary col-md-5 float-center mt-3 mt-sm-0 fw-bold">Masuk</button>
                        </div>
                        {{-- <div class="login-account">
							<span class="msg">Don't have an account yet ?</span>
							<a href="#" id="show-signup" class="link">Sign Up</a>
						</div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets') }}/js/core/jquery.3.2.1.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('assets') }}/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('assets') }}/js/atlantis.min.js"></script>
    <script>
        document.getElementById("username").focus();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function validation(form) {
            $('.text-danger').html('');
            $('.req').removeClass('is-invalid');
            let count = 0
            $.each(form, function(i, field) {
                let attr = $("input[name=" + field.name + "]");
                if ((attr.hasClass('req')) && (attr.val() == "")) {
                    $('.' + field.name + '-error').html('<b>' + attr.data('label') +
                        '</b> tidak boleh kosong');
                    count++;
                    attr.addClass('is-invalid')
                }
            });
            if (count > 0) {
                swal(
                    "Gagal!",
                    "Terdapat " + count + " kolom yang tidak boleh kosong.",
                    "error"
                )
                e.preventDefault()
            }
        }

        $('#formLogin').submit(function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var form = $(this).serializeArray();
            validation(form)
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: form,
                success: function(response) {
                    console.log(response)
                    if (response.res == 'inputan_tidak_lengkap') {
                        swal("Gagal!", "Harap isi semua inputan.", "error");
                    }
                    if (response.res == 'akun_tidak_aktif') {
                        swal(
                            "Gagal!",
                            "Akun anda saat ini dinonaktifkan. Silahkan hubungi admin untuk mengaktifkan.",
                            "error"
                        )
                    }
                    if (response.res == 'gagal') {
                        swal(
                            'Gagal!',
                            'Nama Pengguna beserta Kata Sandi yang dimasukkan tidak ditemukan. Silahkan cek kembali inputan anda.',
                            'error'
                        )
                    }
                    if (response.res == 'berhasil') {
                        window.location.href = "{{ url('/dashboard') }}";
                    }
                }
            });
        });

        var overlay = $('#overlay').hide();
        $(document)
            .ajaxStart(function() {
                overlay.show();
            })
            .ajaxStop(function() {
                overlay.hide();
            });
    </script>
</body>

</html>
