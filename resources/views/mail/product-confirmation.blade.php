<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
    <meta name="viewport" content="">
    <title> {{__('Product confirmation')}}</title>
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
    @php
        $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
    @endphp
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
                            {{__('We have now created your product, and it’s waiting for your approval on your account')}}. {{__('If you have any questions please contact our support, with the information below')}}.
                        </td>
                    </tr>
                </table><!-- banner -->
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="padding: 50px 10px; width: 100%;">
                    <tr>
                        <td style="width: 65%; padding-right: 15px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td colspan="2" style="font-size: 30px; font-weight: 700; padding-bottom: 30px;">{{$details['product_title']}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="top">
                                        <img src="{{ $message->embed('public/'.$details['product_thambnail'])}}" style="height:auto; width: 300px; margin-right:10px" alt="">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td valign="top" style="padding:10px;">{{__('Do you want your logo on the product')}}?</td>
                                            <td style="text-align: right; font-weight: bold; padding:10px;">@if($details['request']['logo_on_product']==1) {{__('Yes')}} @else {{__('No')}} @endif</td>
                                        </tr>
                                        @if($details['request']['logo_on_product']==1)
                                        <tr>
                                            <td valign="top" style="padding:10px;">Logo position</td>
                                            <td style="text-align: right; font-weight: bold; padding:10px;">
                                                @if(!empty($details['request']['logo_value'])) {{str_replace('|',',',$details['request']['logo_value'])}} @endif

                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="2"><hr></td>
                                        </tr>

                                        <tr>
                                            <td valign="top" style="padding:10px;">{{__('Do you want to assign a text to the product')}}?</td>
                                            <td style="text-align: right; font-weight: bold; padding:10px;">@if($details['request']['text_on_product']==1) {{__('Yes')}} @else {{__('No')}} @endif</td>
                                        </tr>
                                        @if($details['request']['text_on_product']==1)
                                        <tr>
                                            <td valign="top" style="padding:10px;">Tekst position</td>
                                            <td style="text-align: right; font-weight: bold; padding:10px;">
                                                @if(!empty($details['request']['logo_value'])) {{str_replace('|',',',$details['request']['logo_value'])}} @endif
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="2"><hr></td>
                                        </tr>
                                        <tr>
                                            <td valign="top" style="padding:10px;">Din brugerdefinerede note</td>
                                            <td style="padding:10px; font-size: 13px; width: 60%;">{{$details['request']['message']}}</td>
                                        </tr>
                                    </table>





                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td valign="top">
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                        <h2 style="font-weight: bold; color: #001FD1; font-size: 30px; margin-top: 0; margin-bottom: 10px;">{{__('Price')}}: {{$formatter->formatCurrency($details['amount'], 'DKK'), PHP_EOL;}}</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style="width: 100%; background-color: #8a99ea;" cellspacing="0">
                                            <thead style="background-color: #001FD1;">
                                                <tr>
                                                    <th style="color: #fff; font-size: 13px; padding: 10px; text-align: left;">{{__('Quantity')}}</th>
                                                    <th style="color: #fff; font-size: 13px; padding: 10px; text-align: right;">{{__('Price pr. item')}}</th>
                                                </tr>
                                            </thead>
                                            @foreach($details['priceArr'] as $pqty)
                                            <tr>
                                                <td style="padding: 10px; font-size: 13px; color: #fff; border-bottom: 1px solid #fff;">{{$pqty['qty']}}</td>
                                                <td style="padding: 10px; font-size: 13px; color: #fff; border-bottom: 1px solid #fff; text-align: right;">{{$formatter->formatCurrency($pqty['price'], 'DKK'), PHP_EOL;}}</td>
                                            </tr>
                                            @endforeach

                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{$details['page_url']}}" style="background-color: #001FD1; color: #ffffff;display: block; padding: 12px 25px;border-radius: 5px;text-decoration: none; text-align: center;">{{__('View your product')}}</a>
                                    </td>
                                </tr>
                            </table>
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
