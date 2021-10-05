<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jobs Suggestion for you</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    <style>
        /* Remove space around the email design. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            /* background-color: #dedede; */
        }
        .content {
            width: 100%;
            max-width: 600px;
        }
        /* A Fix for Apple Mail */
        @media only screen and (min-device-width: 601px) {
            .content {
                width: 600px;
            }
            .col400 {
                width: 400px !important;
            }
        }
    </style>
</head>
<body>
    <table align="center" border="0" bgcolor="#cccccc" cellspacing="0" cellpadding="0" width="100%" height="100%">
        <tr>
            <td align="center">
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="content" style="max-width: 600px;" width="100%">
                    <!-- header -->
                    <tr>
                        <td style="background: #ededed; text-align: center; padding: 36px 14px 36px 14px;">
                            <h1 style="font-family: 'Questrial', sans-serif; font-size: 32px; color: #000; margin: 0;">Huawei Seeds for Future</h1>
                        </td>
                    </tr>

                    <!-- Details -->
                    <tr>
                        <td style="background-color: #033691; display: block; text-align: center; padding: 20px 16px 32px;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tr>
                                    <td align="left" style="margin: 0; padding: 4px 0 4px;">
                                        <h1 style="font-size: 32px; font-weight: bold; margin: 0; font-family: 'Questrial', sans-serif;">
                                            <span style="color:#fff; display: block; font-family: 'Questrial', sans-serif;">Welcome!</span>
                                        </h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-top: 12px; padding-bottom: 25px;">
                                        <p style="color: #fff; margin: 0 auto; font-family: 'Questrial', sans-serif; font-size: 18px; line-height: 1.5;">Thank you for registering on the Seeds for the Future Nepal platform. Please click the below 'Verify Now' button to verify your registration and begin your application</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="middle">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                @if(!isset($code))
                                                    <td align="center" bgcolor="#033691" style="border-radius: 32px;">
                                                        <a href="{{env('MIX_APP_BASE_URL')}}/user/verify/{{$token}}" target="_blank" style="border-radius: 32px; border: 1px solid blue; background: mediumblue; box-shadow: 0 0 5px; color: #fff; display: inline-block; font-family: 'Questrial', sans-serif; font-size: 18px; font-weight: bold; line-height: 1.5; padding: 10px 32px; text-decoration: none; ">Verify Now</a>
                                                    </td>
                                                @else
                                                    <td align="center" style="padding-top: 12px; padding-bottom: 25px;">
                                                        <p style="color: #fff; margin: 0 auto; font-family: 'Questrial', sans-serif; font-size: 25px; line-height: 1.5;">{{$code}}</p>
                                                    </td>
                                                @endif
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                  

                  <!-- copyright -->
                  <tr>
                        <td style="background: #ededed; text-align: center; padding: 36px 14px 36px 14px;">
                            <p style="font-family: 'Questrial', sans-serif; font-size: 12px; color: #666; margin: 0;">&copy; {{now()->year}} All rights reserved &reg;</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
