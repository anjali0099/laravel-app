<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Verify Your Email Address</h1>
                    </div>
                    <div class="card-body">
                        <p class="text-center">
                            Before proceeding, please check your email for a verification link.
                            If you did not receive the email, you can request a new one.
                        </p>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">
                                    Resend Verification Email
                                </button>
                            </div>
                        </form>

                        @if (session('message'))
                            <div class="alert alert-success mt-3">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
