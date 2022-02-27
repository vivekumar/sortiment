<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="">
    <title><?php echo e(__('Order confirmation')); ?></title>
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
                            <?php echo e(__('Order confirmation')); ?>

                        </td>
                    </tr>
                    <tr>
                        <td style="color: #ffffff; font-size: 17px;">
                            <?php echo e(__('We have now received your order')); ?> - <?php echo e(__('you will receive an email every time your order goes to the next step in the process')); ?>.
                        </td>
                    </tr>
                </table><!-- banner -->
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="padding: 50px 15px; width: 100%;">
                    <tr>
                        <td>
                            <table style="width: 100%;">
                                <?php $__currentLoopData = $order['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td valign="top">
                                        <img src="<?php echo e($message->embed('public/'.\App\Models\CustomizeProduct::where('id',$items['product_id'])->value('product_thambnail') )); ?>" width="150px" alt="">
                                    </td>

                                    <td valign="top">
                                        <h3 style="margin: 0;"><?php echo e(\App\Models\CustomizeProduct::where('id',$items['product_id'])->value('product_name')); ?></h3>
                                        <p><strong><?php echo e($items['qty']); ?> stk.</strong></p>
                                        <?php
                                            $orderItemsAttr=DB::table('order_item_attrs')->where('order_item_id',$items['id'])->get();
                                        ?>
                                        <?php $__currentLoopData = $orderItemsAttr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderAttr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <p><strong style="font-size: 18px;"><?php echo e(__(\App\Models\Attribute::where('id',$orderAttr->attribute_id)->value('attr_name'))); ?>:</strong> <?php echo e($orderAttr->attribute_value); ?></p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <!--<p><strong style="font-size: 18px;">Size:</strong> 1S · 2M · 2L · 5XL</p>-->
                                        <p><strong style="font-size: 18px;"><small style="color: #001FD1; font-size: 18px;"><?php echo e(__('Item costs')); ?>:</small> <?php echo e($items['price']); ?> DKK</strong></p>
                                        <h3 style="margin: 15px 0 0; color: #001FD1;"><?php echo e(__('Estimated delivery date')); ?>:</h3>
                                        <p style="margin-top: 5px;"><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $items['estimated_delivery_date'])->format('d. F')); ?></p>
                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </table>
                        </td>

                        <td valign="top">
                            <table style="width: 100%;">
                                <tr>
                                    <td valign="top">
                                        <h3 style="margin: 0; color: #001FD1;"><?php echo e(__('Delivery address')); ?>:</h3>
                                        <p style="margin-top: 5px;"><?php echo e($order['address']); ?></p>
                                        <h3 style="margin: 15px 0 0; color: #001FD1;"><?php echo e(__('Delivery costs')); ?>:</h3>
                                        <p style="margin-top: 5px;"><?php echo e($order['delivery_costs']); ?> DKK</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p><strong style="font-size: 18px;"><small style="color: #001FD1; font-size: 18px;"><?php echo e(__('Total costs')); ?>:</small> <?php echo e($order['amount']+$order['delivery_costs']); ?> DKK</strong></p>
                                        <p><strong><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order['order_recieved_date'])->format('d. F H:i')); ?></strong></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td><img src="<?php echo e($message->embed('public/frontend/mail/img/check-icon.png')); ?>" width="20" alt=""></td>
                                                <td style="padding: 0 5px;"><img src="<?php echo e($message->embed('public/frontend/mail/img/clipboard-regular.png')); ?>" width="20" alt=""></td>
                                                <td><p><strong><?php echo e(__('Order placed')); ?></strong><br> <small><?php echo e(__('We have received your order')); ?>.</small></p></td>
                                            </tr>
                                        </table>
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
                    <h2 style="color: #001FD1; font-size: 30px; font-weight: bold; margin: 0 0 10px;"><?php echo e(__('Do you have a question?')); ?></h2>
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
<?php /**PATH /var/www/html/laravel/sortiment/resources/views/mail/order-confirmed.blade.php ENDPATH**/ ?>