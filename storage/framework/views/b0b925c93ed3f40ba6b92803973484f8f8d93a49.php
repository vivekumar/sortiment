<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="">
    <title><?php echo e(__('Order Completed')); ?></title>
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
                            <?php echo e(__('Konto til godkendelse')); ?>

                        </td>
                    </tr>
                    <tr>
                        <td style="color: #ffffff; font-size: 17px;">
                            <?php echo e(__('En ny virksomhed har tilmeldt sig B2B hjemmesiden - se deres informationer og godkend virksomheden.')); ?>

                        </td>
                    </tr>
                </table><!-- banner -->
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="padding: 50px 30px; width: 100%;">
                    <tr>
                        <td style="font-size: 30px; font-weight: 700; padding-bottom: 5px;">Konto oplysninger</td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <table style="padding: 10px 30px; width: 100%;">
                                <tr>
                                    <td>
                                        <div class="input-row"  style="position: relative;">
                                            <span style="margin-bottom:10px;display: block;">
                                                <img src="<?php echo e($message->embed('public/frontend/assets/img/user-solid.png')); ?>" alt="" width="25"> <?php echo e(__('Name and lastname')); ?></span>

                                            <input type="text" name="name" value="<?php echo e($details['name']); ?>"
                                            style="height: 42px;
                                            width: 85%;
                                            border-radius: 7px;
                                            background: rgba(0, 31, 209, 0.1);
                                            border: none;
                                            font-size: 1.25rem;
                                            padding: 5px 20px;
                                            color: #001fd1;">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input-row" style="position: relative;">
                                            <span style="margin-bottom:10px;display: block;">
                                                <img src="<?php echo e($message->embed('public/frontend/assets/img/users-solid.png')); ?>" alt="" width="25"> <?php echo e(__('Company name')); ?></span>

                                            <input type="text" name="company" value="<?php echo e($details['company']); ?>"
                                            style="height: 42px;
                                            width: 85%;
                                            border-radius: 7px;
                                            background: rgba(0, 31, 209, 0.1);
                                            border: none;
                                            font-size: 1.25rem;
                                            padding: 5px 20px;
                                            color: #001fd1;">
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <table style="padding: 10px 30px; width: 100%;">
                                <tr>
                                    <td>
                                        <div class="input-row"  style="position: relative;">
                                            <span style="margin-bottom:10px;display: block;">
                                                <img src="<?php echo e($message->embed('public/frontend/assets/img/envelope-solid.png')); ?>" alt="" width="25"> <?php echo e(__('Email')); ?></span>

                                            <input type="email" name="email" value="<?php echo e($details['email']); ?>"
                                            style="height: 42px;
                                            width: 85%;
                                            border-radius: 7px;
                                            background: rgba(0, 31, 209, 0.1);
                                            border: none;
                                            font-size: 1.25rem;
                                            padding: 5px 20px;
                                            color: #001fd1;">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input-row" style="position: relative;">
                                            <span style="margin-bottom:10px;display: block;">
                                                <img src="<?php echo e($message->embed('public/frontend/assets/img/map-marker-alt-solid.png')); ?>" alt="" width="25"> <?php echo e(__('Address')); ?></span>

                                            <input type="text" name="address" value="<?php echo e($details['address']); ?>"
                                            style="height: 42px;
                                            width: 85%;
                                            border-radius: 7px;
                                            background: rgba(0, 31, 209, 0.1);
                                            border: none;
                                            font-size: 1.25rem;
                                            padding: 5px 20px;
                                            color: #001fd1;">
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <table style="padding: 10px 30px; width: 100%;">
                                <tr>
                                    <td>
                                        <div class="input-row"  style="position: relative;">
                                            <span style="margin-bottom:10px;display: block;">
                                                <img src="<?php echo e($message->embed('public/frontend/assets/img/key-solid.png')); ?>" alt="" width="25"> <?php echo e(__('City')); ?></span>

                                            <input type="text" name="password" value="<?php echo e($details['city']); ?>"
                                            style="height: 42px;
                                            width: 85%;
                                            border-radius: 7px;
                                            background: rgba(0, 31, 209, 0.1);
                                            border: none;
                                            font-size: 1.25rem;
                                            padding: 5px 20px;
                                            color: #001fd1;">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input-row" style="position: relative;">
                                            <span style="margin-bottom:10px;display: block;">
                                                <img src="<?php echo e($message->embed('public/frontend/assets/img/building-solid.png')); ?>" alt="" width="25"> <?php echo e(__('CVR number')); ?></span>

                                            <input type="text" name="password" value="<?php echo e($details['crv_number']); ?>"
                                            style="height: 42px;
                                            width: 85%;
                                            border-radius: 7px;
                                            background: rgba(0, 31, 209, 0.1);
                                            border: none;
                                            font-size: 1.25rem;
                                            padding: 5px 20px;
                                            color: #001fd1;">
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <a href="<?php echo e(url('/')); ?>" style="width: 100%; background-color: #001FD1; color: #ffffff; padding-top: 20px; padding-bottom: 20px; font-size: 25px; font-weight: 600; border-radius: 5px; margin-top: 15px; display: block; text-decoration: none; text-align: center;"><?php echo e(__('Godkend')); ?></a>
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
                    <p style="margin: 0;"><?php echo e(__('???Name??? is ready to answer your questions')); ?></p>
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
<?php /**PATH /var/www/html/laravel/sortiment/resources/views/mail/admin-company-approval.blade.php ENDPATH**/ ?>