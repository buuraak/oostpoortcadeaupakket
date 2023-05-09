<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
                background-color: #0254bb;
            }

            .content-cell {
                padding: 16px !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }

            .footer .footer-logo {
                text-align: center !important;
            }
        }
        body,
        body .wrapper,.body {
            background-color: #ffffff !important;
            border:none!important;
        }
        #footer {
            background-color: #0254bb !important;
            color: #ffffff !important;

        }
        .footer{
            width: 800px!important;
        }
        .header {
            max-width: 800px;
            width: 800px;
        }
        .footer-logo{
            padding: 32px 32px 0px 32px!important;

        }
        h1{
            color: #0254ba!important;
            font-size: 25px!important;
        }
        p{
            color: black!important;
        }
        .share-moment-btn{
            font-size: 16px !important;
            color: white!important;
            border: none !important;
            background-image: inherit !important;
            background-color: #abaa46 !important;
            border-radius: 4px !important;
            width: 100%!important;
            text-decoration: none!important;
            padding: 0.8rem 10px!important;
        }
    </style>
</head>
<body>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            {{ $header ?? '' }}

            <!-- Email Body -->
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0">
                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                               role="presentation">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell">
                                    {{ Illuminate\Mail\Markdown::parse($slot) }}

                                    {{ $subcopy ?? '' }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{ $footer ?? '' }}
            </table>
        </td>
    </tr>
</table>
</body>
</html>
