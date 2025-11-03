<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uprit Email</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        @media screen and (max-width:600px) {
            .container {
                width: 100% !important;
                padding: 0 16px !important;
            }

            .title-text {
                font-size: 24px !important;
            }

            .body-text {
                font-size: 18px !important;
            }

            .cta-button {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                line-height: normal !important;
                padding: 16px 0 !important;
                font-size: 18px !important;

            }

            .icon {
                max-width: 40px !important;
                height: auto !important;
            }

            .btn-cta {
                padding-left: 32px;
                padding-right: 32px;
            }

            .logo-icon {
                padding-left: 12px;
            }
        }
    </style>
</head>

<body>
    @include('emails.header')

    @yield('body')

    @include('emails.footer')
</body>

</html>
