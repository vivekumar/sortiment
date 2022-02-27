<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="">
    <title>Vi har modtaget din forspørgsel</title>
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
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e($message->embed('public/frontend/mail/img/sortiment-logo.png')); ?>" width="150" alt="logo"></a>
                </th>
            </tr>
        </thead>
        <tr>
            <td colspan="3">
                <table style="width: 100%; text-align: center; background-color: #001FD1; padding: 20px;">
                    <tr>
                        <td class="fs-20" style="font-size: 30px; font-weight: 600; color: #ffffff; padding-bottom: 15px;">
                            Vi har modtaget din forspørgsel
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #ffffff; font-size: 17px;">
                        Vi har modtaget din forspørgsel på <?php echo e($details['product_name']); ?>. Et tilbud og produkt er nu ved at blive oprettet og du vil derfor modtage en email indenfor 24 timer, så snart dit produkt ligger klar på din profil.
                        </td>
                    </tr>
                </table><!-- banner -->
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="padding: 50px 30px; width: 100%;">
                    <tr>
                        <td colspan="3" style="font-size: 30px; font-weight: 700; padding-bottom: 30px;"><?php echo e($details['product_name']); ?></td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <img src="<?php echo e($message->embed('public/'.$details['product_thambnail'])); ?>" style="height:150px; width: auto; margin-right:10px" alt="">
                        </td>
                        <td style="width: 70%;">
                            <table style="width: 100%;">
                                <tr>
                                    <td valign="top" style="padding:10px;"><?php echo e(__('Do you want your logo on the product')); ?>?</td>
                                    <td style="text-align: right; font-weight: bold; padding:10px;"><?php if($details['logo_on_product']==1): ?> <?php echo e(__('Yes')); ?> <?php else: ?> <?php echo e(__('No')); ?> <?php endif; ?></td>
                                </tr>
                                <?php if($details['logo_on_product']==1): ?>
                                <tr>
                                    <td valign="top" style="padding:10px;">Logo position</td>
                                    <td style="text-align: right; font-weight: bold; padding:10px;">
                                        <?php if(!empty($details['logo_value'])): ?> <?php echo e(str_replace('|',',',$details['logo_value'])); ?> <?php endif; ?>

                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>

                                <tr>
                                    <td valign="top" style="padding:10px;"><?php echo e(__('Do you want to assign a text to the product')); ?>?</td>
                                    <td style="text-align: right; font-weight: bold; padding:10px;"><?php if($details['text_on_product']==1): ?> <?php echo e(__('Yes')); ?> <?php else: ?> <?php echo e(__('No')); ?> <?php endif; ?></td>
                                </tr>
                                <?php if($details['text_on_product']==1): ?>
                                <tr>
                                    <td valign="top" style="padding:10px;">Text posistion</td>
                                    <td style="text-align: right; font-weight: bold; padding:10px;">
                                        <?php if(!empty($details['logo_value'])): ?> <?php echo e(str_replace('|',',',$details['logo_value'])); ?> <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                                <tr>
                                    <td valign="top" style="padding:10px;">Din brugerdefinerede note</td>
                                    <td style="padding:10px; font-size: 13px; width: 60%;"><?php echo e($details['message']); ?></td>
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
                    <img src="<?php echo e($message->embed('public/frontend/mail/img/Ellipse 45.png')); ?>" alt="" width="150">
                </td>
                <td style="padding-right: 15px; padding-left: 15px; width: 50%;">
                    <h2 class="fs-20" style="color: #001FD1; font-size: 30px; font-weight: bold; margin: 0 0 10px;"><?php echo e(__('Do you have a question?')); ?></h2>
                    <p style="margin: 0;"><?php echo e(__('“Name” is ready to answer your questions')); ?></p>
                </td>
                <td style="padding-right: 20px;">
                   <a href="#" style="background-color: #001FD1; color: #ffffff; display: block; padding: 12px 25px; border-radius: 5px;text-decoration: none; margin-bottom: 10px;"><img src="<?php echo e($message->embed('public/frontend/mail/img/phone-solid.png')); ?>" alt="" width="20"> +45 41 88 80 80</a>
                   <a href="mailto:info@sortiment.dk" style="background-color: #001FD1; color: #ffffff; display: block; padding: 12px 25px; border-radius: 5px;text-decoration: none;"><img src="<?php echo e($message->embed('public/frontend/mail/img/envelope-solid.png')); ?>" alt="" width="20"> info@sortiment.dk</a>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
<?php /**PATH /var/www/html/laravel/sortiment/resources/views/mail/product-request-confirmation.blade.php ENDPATH**/ ?>