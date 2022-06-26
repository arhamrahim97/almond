<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SI PINTAR BERAKSI</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="shortcut icon" href="{{ asset('assets/landingPage/favicon/favicon.ico') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
                urls: ['{{ asset('assets') }}/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets') }}/css/dataTables.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets') }}/css/atlantis.css">

    <style>
        .btn-success {
            background-color: #15c68e !important;
            border-color: #15c68e !important;
        }

        .btn-success:hover {
            background-color: #37bd93 !important;
            border-color: #37bd93 !important;
        }

        .badge-success {
            background-color: #15c68e !important;
            border-color: #15c68e !important;
        }

        /* .badge-succes:hover {
            background-color: #976980 !important;
            border-color: #976980 !important;
        } */

        a:hover {
            text-decoration: none;
        }

        .sidebar-wrapper {
            padding-bottom: 0px !important;
        }

        .table td,
        .table th {
            padding: 0 12px !important;
        }

        .is-invalid+.select2-container--bootstrap .select2-selection--single {
            border: 1px solid #f44336;
        }

        .is-invalid+.selectgroup-button {
            border: 1px solid #f44336;
        }

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

        @media screen and (max-width:600px) {
            .dataTables_filter {
                margin-top: 10px;
            }
        }

        .dataTables_filter {
            display: inline !important;
            float: right !important;
        }

        .dataTables_filter.col-sm {
            margin-top: 10px;
        }

        .dt-buttons {
            display: inline !important;

            margin-left: 10px !important;
            float: left !important;
            ;

        }

        .dt-button-collection {
            margin-top: 10px !important;
            margin-bottom: 10px !important;
        }

        .buttons-columnVisibility {
            margin-bottom: 5px;
            background-color: rgba(var(--danger-rgb), 0.15);
            color: var(--danger-color);
            border-color: transparent;
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            ont-size: 14px;
            border-radius: 2rem;
            padding: .25rem .5rem;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            user-select: none;
            border: 0.1px solid grey;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .buttons-columnVisibility:hover {
            background-color: rgba(var(--primary-rgb), 0.15);
            color: var(--primary-color);
            border: 0.1px solid transparent;
        }

        .dt-button-collection .active {
            margin-bottom: 5px;
            background-color: rgba(var(--primary-rgb), 0.15);
            color: var(--primary-color);
            border-color: transparent;
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            ont-size: 14px;
            border-radius: 2rem;
            padding: .25rem .5rem;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            border-left-color: transparent;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .dataTables_length {
            display: inline !important;
            margin-bottom: 5px !important;
            float: left;
        }

        .paginate_button {
            font-size: 12px !important;
        }

        .dataTables_paginate {
            margin-top: 10px !important;
        }

        .btn:focus {
            color: white
        }
    </style>

    @stack('style')

</head>

</head>

<body>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <div class="wrapper fullheight-side">
        <!-- Logo Header -->
        <div class="logo-header position-fixed" data-background-color="blue">

            <a href="{{ url('/dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/logo2.png') }}" alt="navbar brand" class="navbar-brand mt-2"
                    width="165em">
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->

        @include('dashboard.layouts.header')

        @include('dashboard.layouts.sidebar')


        <div class="main-panel full-height">
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">@yield('title')</h4>
                        @yield('breadcrumb')
                    </div>
                    <div class="page-category">@yield('content')</div>
                    <!-- Modal Ubah Status Aset-->
                    <div class="modal fade" id="modal-ubah-akun" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="exampleModalLongTitle">Ubah Akun</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body mx-2">
                                    <form method="PUT" id="form-ubah-akun">
                                        @csrf
                                        <div class="row align-items-end">
                                            <div class="col-12 px-2 w-100">
                                                <div class="col-12 px-2">
                                                    <div class="form-group">
                                                        @component('dashboard.components.formElements.input', ['label' => 'Nama Lengkap', 'name' => 'nama_lengkap_', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Nama Lengkap', 'id' => 'nama-lengkap'])
                                                        @endcomponent
                                                    </div>
                                                </div>
                                                <div class="col-12 px-2">
                                                    <div class="form-group">
                                                        @component('dashboard.components.formElements.input', ['label' => 'Username', 'name' => 'username_', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Username', 'id' => 'username'])
                                                        @endcomponent
                                                    </div>
                                                </div>

                                                <div class="col-12 px-2">
                                                    <div class="form-group">
                                                        @component('dashboard.components.formElements.input', ['label' => 'Password Baru', 'name' => 'password_', 'class' => 'req', 'placeholder' => 'Masukkan Password Baru', 'id' => 'password'])
                                                        @endcomponent
                                                        <span class="text-muted" style="font-style: italic">Kosongkan
                                                            saja apabila tidak
                                                            ingin mengubah
                                                            password yang sekarang</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-12 justify-content-end text-right">
                                                <button type="submit" class="btn btn-success" id="btn-submit"
                                                    value="">
                                                    <i class="fas fa-save"></i>
                                                    Perbarui Akun</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-lg col-sm-12 mb-1">
                                        <button type="button" class="btn btn-md btn-dark w-100" data-dismiss="modal"><i
                                                class="fas fa-times"></i>
                                            Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets') }}/js/core/jquery.3.2.1.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>

    {{-- Image Uploader --}}
    <script src="{{ asset('assets') }}/image_uploader/image-uploader.min.js"></script>



    <!-- jQuery UI -->
    <script src="{{ asset('assets') }}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets') }}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Moment JS -->
    <script src="{{ asset('assets') }}/js/plugin/moment/moment.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/moment/moment-with-locales.min.js"></script>


    <!-- Chart JS -->
    <script src="{{ asset('assets') }}/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets') }}/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets') }}/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets') }}/js/plugin/datatables/datatables.min.js"></script>

    {{-- Bootstrap Notify --}}
    <script src="{{ asset('assets') }}/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- Bootstrap Toggle -->
    <script src="{{ asset('assets') }}/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets') }}/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Google Maps Plugin -->
    <script src="{{ asset('assets') }}/js/plugin/gmaps/gmaps.js"></script>

    <!-- Dropzone -->
    <script src="{{ asset('assets') }}/js/plugin/dropzone/dropzone.min.js"></script>

    <!-- Fullcalendar -->
    <script src="{{ asset('assets') }}/js/plugin/fullcalendar/fullcalendar.min.js"></script>

    <!-- DateTimePicker -->
    <script src="{{ asset('assets') }}/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

    <!-- Bootstrap Tagsinput -->
    <script src="{{ asset('assets') }}/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

    <!-- Bootstrap Wizard -->
    <script src="{{ asset('assets') }}/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

    <!-- jQuery Validation -->
    <script src="{{ asset('assets') }}/js/plugin/jquery.validate/jquery.validate.min.js"></script>

    <!-- Summernote -->
    <script src="{{ asset('assets') }}/js/plugin/summernote/summernote-bs4.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets') }}/js/plugin/select2/select2.full.min.js"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets') }}/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Jquery Mask -->
    <script src="{{ asset('assets') }}/js/plugin/jquery.mask/jquery.mask.min.js"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('assets') }}/js/plugin/owl-carousel/owl.carousel.min.js"></script>

    <!-- Magnific Popup -->
    <script src="{{ asset('assets') }}/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>


    <!-- Atlantis JS -->
    <script src="{{ asset('assets') }}/js/atlantis.min.js"></script>

    {{-- DataTables Extensions --}}
    <script src="{{ asset('assets') }}/datatables/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/datatables/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/datatables/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/datatables/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/datatables/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/datatables/buttons.colVis.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(function() {
            moment.locale('id');
            $('.tanggal').mask('00-00-0000');
            $('.rupiah').mask('000.000.000.000.000', {
                reverse: true
            })
            $('.waktu').mask('00:00');
            $('.angka').mask('00000000000000000000');
        })

        function disabledCloseModal() {
            $('#modal-lihat').modal({
                backdrop: 'static',
                keyboard: false
            })
        }

        $('#ubah-akun').click(function() {
            $('#modal-ubah-akun').modal('show');

            $('#nama-lengkap').val('{{ Auth::user()->nama_lengkap }}');
            $('#username').val('{{ Auth::user()->username }}');
        })

        $('#form-ubah-akun').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('')
            swal({
                title: 'Perbarui Akun?',
                text: 'Apakah anda yakin ingin perbarui akun anda?',
                icon: "info",
                buttons: ["Batal", "Ya"],
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url: `{{ url('update-akun') }}` + '/' + `{{ Auth::user()->id }}`,
                        type: 'POST',
                        data: new FormData(this),
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if ($.isEmptyObject(response.error)) {
                                swal({
                                    title: "Berhasil!",
                                    text: "Data berhasil disimpan!",
                                    icon: "success",
                                }).then((value) => {
                                    location.href = "{{ url()->current() }}";
                                });
                            } else {
                                swal({
                                    title: "Gagal!",
                                    text: "Terjadi kesalahan, mohon periksa kembali data yang diinputkan.",
                                    icon: "error",
                                    button: "Ok",
                                });
                                printErrorMsg(response.error);
                            }
                        },
                        error: function(response) {
                            alert(response.responseJSON.message)
                        }
                    })
                } else {
                    swal("Data batal disimpan.", {
                        icon: "error",
                    });
                }
            });
            const printErrorMsg = (msg) => {
                $.each(msg, function(key, value) {
                    $('.' + key + '-error').text(value);
                });
            }
        })




        function validation(formData) {
            $('.error-text').html('');
            $('.req').removeClass('is-invalid');
            let count = 0
            $.each(formData, function(i, field) {
                let getAttr = document.getElementsByName(field.name);
                let getNodeName = getAttr[0].nodeName;
                let getType = getAttr[0].type;
                let attr = $(getNodeName + "[name=" + field.name + "]");
                if ((attr.val() == "")) {
                    if (attr.hasClass('req garis datar')) {
                        $('.' + field.name + '-error').html('<b>' + attr.data('label') +
                            '</b> tidak boleh kosong. Berikan garis datar (-) apabila ingin tetap mengosongkannya.'
                        );
                    } else if (attr.hasClass('req')) {
                        $('.' + field.name + '-error').html('<b>' + attr.data('label') +
                            '</b> tidak boleh kosong.'
                        );
                    }
                    count++;
                    attr.addClass('is-invalid')
                }
            });
            if (count > 0) {
                swal({
                    title: "Gagal!",
                    text: "Terdapat " + count + " kolom yang tidak boleh kosong.",
                    icon: "error"
                }).then(function() {
                    $('.rupiah').mask('000.000.000.000.000', {
                        reverse: true
                    })
                });
                e.preventDefault()
            }
        }

        $('.select2').select2({
            placeholder: "- Pilih Salah Satu -",
            theme: "bootstrap"
        })

        $('.btn-close').click(function() {
            $('.modal').modal('hide');
        })

        var overlay = $('#overlay').hide();
        $(document)
            .ajaxStart(function() {
                overlay.show();
            })
            .ajaxStop(function() {
                overlay.hide();
            });

        $('.numerik').on('input', function(e) {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        });
    </script>
    @stack('script')
</body>

</html>
