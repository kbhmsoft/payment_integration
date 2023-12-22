<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        :root {
            --main-bg: #e91e63;
        }

        .main-bg {
            background: var(--main-bg) !important;
        }

        input:focus,
        button:focus {
            border: 1px solid var(--main-bg) !important;
            box-shadow: none !important;
        }

        .form-check-input:checked {
            background-color: var(--main-bg) !important;
            border-color: var(--main-bg) !important;
        }

        .card,
        .btn,
        input {
            border-radius: 0 !important;
        }
    </style>
    <title>Softic User API & Payment Getway</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
</head>

<body class="main-bg">
    <!-- Login Form -->
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card shadow">
                    <div class="card-title text-center border-bottom">
                        <h2 class="p-3">Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('authenticate') }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label for="email"
                                    class="col-md-4 col-form-label font-weight-bolder text-md-start text-start">Email
                                    Address</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password"
                                    class="col-md-4 col-form-label font-weight-bolder text-md-start text-start">Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mb-3 d-flex justify-content-start">
                                <input type="submit" class="text-md-start btn btn-primary" value="Sign In">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
