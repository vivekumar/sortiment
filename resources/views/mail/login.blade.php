<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
    <meta name="viewport" content="">
    <title>Her er dit medarbejder login</title>
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

            .input-ff tr, .input-ff tr td{
                display: block!important;
                
            }
            .input-ff tr td:first-child .input-row{
                margin-bottom: 10px;
            }
            input {
                font-size: 14px!important;
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
                            Her er dit medarbejder login
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #ffffff; font-size: 17px;">
                        Din virksomhed {{$details['company']}} har oprettet en bruger til dig p?? sortiment shoppen. Log ind for at se om din virksomhed har tildelt dig nogle produkter som mangler dine informationer
                        </td>
                    </tr>
                </table><!-- banner -->
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="padding: 50px 30px; width: 100%;">
                    <tr>
                        <td class="fs-20" style="font-size: 30px; font-weight: 700; padding-bottom: 5px;">Dine kontooplysninger</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table class="input-ff" style="padding: 10px 30px 0px; width: 100%;">
                                <tr>
                                    <td>
                                        <div class="input-row"  style="position: relative;">
                                            <span style="margin-bottom:10px;display: block;"><img src="{{ $message->embed('public/frontend/assets/img/user-solid.png')}}" alt="" width="25"> Brugernavn</span>

                                            <input type="email" name="email" value="{{$details['email']}}"
                                            style="height: 42px;
                                            width: 85%;
                                            border-radius: 7px;
                                            background: rgba(0, 31, 209, 0.1);
                                            border: none;
                                            font-size: 1.25rem;
                                            padding: 5px 20px;
                                            margin-bottom: 10px;
                                            color: #001fd1;" readonly>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input-row" style="position: relative;">
                                            <span style="margin-bottom:10px;display: block;"><img src="{{ $message->embed('public/frontend/assets/img/key-solid.png')}}" alt="" width="25"> Kodeord</span>

                                            <input type="text" name="password" value="{{$details['password']}}"
                                            style="height: 42px;
                                            width: 85%;
                                            border-radius: 7px;
                                            background: rgba(0, 31, 209, 0.1);
                                            border: none;
                                            font-size: 1.25rem;
                                            margin-bottom: 10px;
                                            padding: 5px 20px;
                                            color: #001fd1;" readonly>
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a class="fs-20" href="{{route('employee-login')}}" style="width: 100%; background-color: #001FD1; color: #ffffff; padding-top: 20px; padding-bottom: 20px; font-size: 25px; font-weight: 600; border-radius: 5px; margin-top: 15px; display: block; text-decoration: none; text-align: center;">Log ind her</a>
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
                    <h2 class="fs-20" style="color: #001FD1; font-size: 30px; font-weight: bold; margin: 0 0 10px;">Har du nogle sp??rgsm??l?</h2>
                    <p style="margin: 0;">Rasmus sidder klar til at hj??lpe dig.</p>
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
