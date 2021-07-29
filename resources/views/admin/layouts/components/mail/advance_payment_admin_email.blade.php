<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="{{ asset(isset($setting->favicon) ? 'storage/' . $setting->favicon : config('adminetic.favicon', 'adminetic/static/favicon.png')) }}"
        type="image/x-icon">
    <link rel="shortcut icon"
        href="{{ asset(isset($setting->favicon) ? 'storage/' . $setting->favicon : config('adminetic.favicon', 'adminetic/static/favicon.png')) }}"
        type="image/x-icon">
    <title>Advance Payment Alert Mail</title>
    <style type="text/css">
        body {
            width: 650px;
            font-family: work-Sans, sans-serif;
            background-color: #f6f7fb;
            display: block;
        }

        a {
            text-decoration: none;
        }

        span {
            font-size: 14px;
        }

        p {
            font-size: 13px;
            line-height: 1.7;
            letter-spacing: 0.7px;
            margin-top: 0;
        }

        .text-center {
            text-align: center
        }

        h6 {
            font-size: 16px;
            margin: 0 0 18px 0;
        }
    </style>
</head>

<body style="margin: 30px auto;">
    <table style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <table style="background-color: #f6f7fb; width: 100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img class="img-fluid"
                                                        src="{{ asset(setting('logo') ? 'storage/' . setting('logo') : 'static/logo.png') }}"
                                                        alt="Logo">
                                                </td>
                                                <td style="text-align: right; color:#999"><span>Advance Payment
                                                        Alert</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                        <b>This is a advance payment notfication,</b><br>
                        <b>Particular : </b> <span class="text-muted">{{$advance->particular ?? 'N/A'}}</span> <br>
                        <b>Client Detail :- </b>
                        <b>Name : </b> <a
                            href="{{adminShowRoute('client',$advance->client_id)}}">{{$advance->client->name ?? 'N/A'}}</a>
                        <br>
                        <b>Phone : </b> <span class="text-muted">{{$advance->client->phone ?? 'N/A'}}</span> <br>
                        <b>Email : </b> <span class="text-muted">{{$advance->client->email ?? 'N/A'}}</span> <br>
                        <b>Amount : </b> <span
                            class="text-muted">{{config('adminetic.currency_symbol','Rs.') . $advance->amount ?? 'N/A'}}</span>
                        <br>
                        @isset($advance->remark)
                        <b>Remark :- </b>
                        <br>
                        {!! $advance->remark !!}
                        @endisset
                        <br>
                        <b>Thank You.</b>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>