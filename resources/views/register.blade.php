<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/GK/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="../../assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card">
            <div class="card-body">

              <div class="app-brand justify-content-center mt-2">
                 <h4 class="app-brand-text demo text-body fw-bold ms-1">REGISTER</h4>
              </div>

              <form id="register" class="mb-3">
                <div class="mb-3">
                    <label for="first name" class="form-label">First Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="first_name"
                            name="first_name"
                            placeholder/>
                </div>
                <div class="mb-3">
                    <label for="last name" class="form-label">Last Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="last_name"
                            name="last_name"
                            placeholder/>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                </div>
                <div class="mb-3">
                  <label for="select2Icons" class="form-label">Department</label>
                        <select id="select2Icons" name='department' class="select2-icons form-select">
                            <optgroup label="Mango Coco">
                              <option value="Front" data-icon="ti ti-brand-bootstrap" selected>Front</option>
                              <option value="Dessert" data-icon="ti ti-brand-codepen">Dessert</option>
                              <option value="Kitchen" data-icon="ti ti-brand-php">Kitchen</option>
                              <option value="Bakery" data-icon="ti ti-brand-php">Bakery</option>
                              <option value="Office" data-icon="ti ti-brand-css3">Office</option>
                            </optgroup>
                            <optgroup label="Flying Tigress">
                              <option value="Flying Tigress" data-icon="ti ti-file-description">Flying Tigress</option>
                            </optgroup>
                            <optgroup label="Red Work">
                              <option value="Red Work_Myer" data-icon="ti ti-brand-chrome">Red Work_Myer</option>
                              <option value="Red Work_Macquarie" data-icon="ti ti-brand-firefox">Red Work_Macquarie</option>
                            </optgroup>
                        </select>
                </div>
                <div class="mb-3">
                  <label for="branch" class="form-label">Branch</label>
                  <input type="text" class="form-control" id="Branch" name="branch" placeholder="" />
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"></span>
                  </div>
                </div>
                <button class="btn btn-primary d-grid w-100">Register</button>
                </form>

              <p class="text-center">
                <a class="btn-link" href="{{ route('login') }}">
                  <span>Sign in instead</span>
                </a>
              </p>

            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/pages-auth.js"></script>

    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $("#register").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("register") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(response) {
                if (response.status == 200) {
                    Swal.fire({
                        title: "register Complate.!",
                        text: "user register complate",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.href="/";
                }
                if (response.status == 500) {
                    Swal.fire({
                        title: "Find Not Found.!",
                        text: response.message,
                        icon: "error",
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(response) {
                Swal.fire({
                    title: "Find Not Found.!",
                    text: response.responseJSON.message,
                    icon: "error",
                    allowOutsideClick: false,
                });
                console.log("error");
                console.log(response.responseJSON);

            }
        });
    });
    </script>

  </body>
</html>
