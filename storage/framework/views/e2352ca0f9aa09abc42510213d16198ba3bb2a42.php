<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="">
    <title> <?php echo e(__('Product confirmation')); ?></title>
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
                        <td style="font-size: 30px; font-weight: 600; color: #ffffff; padding-bottom: 15px;">
                            <?php echo e(__('Product confirmation')); ?>

                        </td>
                    </tr>
                    <tr>
                        <td style="color: #ffffff; font-size: 17px;">
                            <?php echo e(__('We have now created your product, and it’s waiting for your approval on your account')); ?>. <?php echo e(__('If you have any questions please contact our support, with the information below')); ?>.
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
                                    <td colspan="2" style="font-size: 30px; font-weight: 700; padding-bottom: 30px;"><?php echo e($details['product_title']); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="top">
                                        <img src="<?php echo e($message->embed('public/'.$details['product_thambnail'])); ?>" width="300px" alt="">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td valign="top" style="padding:10px;"><?php echo e(__('Do you want your logo on the product')); ?>?</td>
                                            <td style="text-align: right; font-weight: bold; padding:10px;"><?php if($details['request']['logo_on_product']==1): ?> <?php echo e(__('Yes')); ?> <?php else: ?> <?php echo e(__('No')); ?> <?php endif; ?></td>
                                        </tr>
                                        <?php if($details['request']['logo_on_product']==1): ?>
                                        <tr>
                                            <td valign="top" style="padding:10px;">Logo position</td>
                                            <td style="text-align: right; font-weight: bold; padding:10px;">
                                                <?php if(!empty($details['logo_value'])): ?> <?php echo e(str_replace('|',',',$details['request']['logo_value'])); ?> <?php endif; ?>

                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="2"><hr></td>
                                        </tr>

                                        <tr>
                                            <td valign="top" style="padding:10px;"><?php echo e(__('Do you want to assign a text to the product')); ?>?</td>
                                            <td style="text-align: right; font-weight: bold; padding:10px;"><?php if($details['request']['text_on_product']==1): ?> <?php echo e(__('Yes')); ?> <?php else: ?> <?php echo e(__('No')); ?> <?php endif; ?></td>
                                        </tr>
                                        <?php if($details['request']['text_on_product']==1): ?>
                                        <tr>
                                            <td valign="top" style="padding:10px;">Tekst position</td>
                                            <td style="text-align: right; font-weight: bold; padding:10px;">
                                                <?php if(!empty($details['logo_value'])): ?> <?php echo e(str_replace('|',',',$details['request']['logo_value'])); ?> <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="2"><hr></td>
                                        </tr>
                                        <tr>
                                            <td valign="top" style="padding:10px;">Din brugerdefinerede note</td>
                                            <td style="padding:10px; font-size: 13px; width: 60%;"><?php echo e($details['request']['message']); ?></td>
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
                                        <h2 style="font-weight: bold; color: #001FD1; font-size: 30px; margin-top: 0; margin-bottom: 10px;"><?php echo e(__('Price')); ?>: <?php echo e($details['amount']); ?> DKK</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style="width: 100%; background-color: #8a99ea;" cellspacing="0">
                                            <thead style="background-color: #001FD1;">
                                                <tr>
                                                    <th style="color: #fff; font-size: 13px; padding: 10px; text-align: left;"><?php echo e(__('Quantity')); ?></th>
                                                    <th style="color: #fff; font-size: 13px; padding: 10px; text-align: right;"><?php echo e(__('Price pr. item')); ?></th>
                                                </tr>
                                            </thead>
                                            <?php $__currentLoopData = $details['priceArr']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pqty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td style="padding: 10px; font-size: 13px; color: #fff; border-bottom: 1px solid #fff;"><?php echo e($pqty['qty']); ?></td>
                                                <td style="padding: 10px; font-size: 13px; color: #fff; border-bottom: 1px solid #fff; text-align: right;"><?php echo e($pqty['price']); ?> DKK</td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="<?php echo e($details['page_url']); ?>" style="background-color: #001FD1; color: #ffffff;display: block; padding: 12px 25px;border-radius: 5px;text-decoration: none; text-align: center;"><?php echo e(__('View your product')); ?></a>
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
                    <img src="<?php echo e($message->embed('public/frontend/mail/img/Ellipse 45.png')); ?>" alt="" width="150">
                </td>
                <td style="padding-right: 15px; padding-left: 15px; width: 50%;">
                    <h2 style="color: #001FD1; font-size: 30px; font-weight: bold; margin: 0 0 10px;">Do you have a question?</h2>
                    <p style="margin: 0;">“Name” is ready to answer your questions</p>
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
<?php /**PATH /var/www/html/laravel/sortiment/resources/views/mail/product-confirmation.blade.php ENDPATH**/ ?>