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
    <title>Discussion Reminder Mail</title>
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
                                                <td style="text-align: right; color:#999"><span>Task Reminder</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                        <b>This is a discussion reminder notfication,</b><br>
                        <b>Lead : </b> <a href="{{adminShowRoute('lead',$discussion->lead_id)}}"><span
                                class="text-muted">#{{$discussion->lead->code ?? 'N/A'}}</span></a>
                        <br>
                        <b>Type : </b> <span
                            class="badge badge-{{$discussion->getTypeColor()}}">{{$discussion->type}}</span>
                        <br>
                        <b>Status : </b> <span
                            class="badge badge-{{$discussion->getStatusColor()}}">{{$discussion->getStatus()}} </span>
                        <br>
                        <b>Discussion Date : </b> <span
                            class="text-muted">{{\Carbon\Carbon::create($discussion->discussion_date)->toFormattedDateString()}}</span>
                        @isset($discussion->subject)
                        <b>Subject : </b><span class="text-muted">{{$discussion->subject}}</span><br>
                        @endisset
                        @if (isset($discussion->discussion))
                        <b class="text-center"><u>Discussion</u></b>
                        <hr>
                        <p class="text-muted">{{$discussion->discussion}}</p>
                        <br>
                        @endif
                        @if (isset($task->deadline))
                        <b class="text-danger">Reminder Date :
                            {{\Carbon\Carbon::create($task->reminder_datetime)->toFormattedDateString()}}</b>
                        @endif
                        <br>
                        <b>Thank You.</b>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>