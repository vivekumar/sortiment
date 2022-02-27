<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
    <meta name="viewport" content="">
    <title>Product Information Confirmed</title>
    <style>
        @media (max-width:  768px){
            tfoot {
                padding: 0 15px;    
                width: 96%;            
            }
            tfoot, tfoot tr, tfoot tr td {
                display: block!important;
                text-align: center!important;
                width: 96%!important;
            }

            tfoot tr td img{
                margin: 0 auto!important;
            }
            tfoot tr td a, tfoot tr td h2, tfoot tr td p{
                text-align: center!important;
                display: block!important;
            }
            .fs-20 {
                font-size: 20px!important;
            }
            tfoot tr td p{
                padding-bottom: 15px;
            }
            tfoot tr td:last-child {
                display: inline-block!important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
    <table cellspacing="0" cellpadding="0" style="max-width: 800px; width: 100%; margin: 0 auto 0 auto;">
        <thead>
            <tr>
                <th  colspan="3" style="padding: 10px 0;">
                    <a href="{{url('/')}}"><img src="{{ $message->embed('public/frontend/mail/img/sortiment-logo.png')}}" width="150" alt="logo"></a>
                </th>
            </tr>
        </thead>
        <tr>
            <td colspan="3">
                <table style="width: 100%; text-align: center; background-color: #001FD1; padding: 20px;">
                    <tr>
                        <td class="fs-20" style="font-size: 30px; font-weight: 600; color: #ffffff; padding-bottom: 15px;">
                            {{__('Succes!')}}
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #ffffff; font-size: 17px;">
                            {{('Vi har modtaget din bestilling!')}}
                        </td>
                    </tr>
                </table><!-- banner -->
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="padding: 50px 30px; width: 100%;">
                    <tr>
                        <td style="">
                            <img src="{{ $message->embed('public/'.$details['product_thambnail'])}}" width="300px" alt="">
                            
                        </td>
                        <td>
                            <h1>{{$details['name']}}</h1>
                            @if(!empty($details['label']))<p style="font-size: 16px;"><strong style="font-size: 24px;">{{__('Label')}}:</strong> {{$details['label']}}</p>@endif
                            @if(!empty($details['color']))<p style="font-size: 16px;"><strong style="font-size: 24px;">{{__('Color')}}:</strong> {{$details['color']}}</p>@endif
                            @if(!empty($details['size']))<p style="font-size: 16px;"><strong style="font-size: 24px;">{{__('Size')}}:</strong> {{$details['size']}}</p>@endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tfoot style="background-color: #f3f3f3;">
            <tr>
                <td style="padding-left: 20px; width: 150px;">
                    <img src="{{ $message->embed('public/frontend/mail/img/Ellipse 45.png')}}" alt="" width="150">
                </td>
                <td style="padding-right: 15px; padding-left: 15px; width: 50%;">
                    <h2 class="fs-20" style="color: #001FD1; font-size: 30px; font-weight: bold; margin: 0 0 10px;">{{__('Do you have a question?')}}</h2>
                    <p style="margin: 0;">{{__('“Name” is ready to answer your questions')}}</p>
                </td>
                <td style="padding-right: 20px;">
                   <a href="#" style="background-color: #001FD1; color: #ffffff; display: block; padding: 12px 25px; border-radius: 5px;text-decoration: none; margin-bottom: 10px;"><img src="{{ $message->embed('public/frontend/mail/img/phone-solid.png')}}" alt="" width="20"> +45 41 88 80 80</a>
                   <a href="mailto:info@sortiment.dk" style="background-color: #001FD1; color: #ffffff; display: block; padding: 12px 25px; border-radius: 5px;text-decoration: none;"><img src="{{ $message->embed('public/frontend/mail/img/envelope-solid.png')}}" alt="" width="20"> info@sortiment.dk</a>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
