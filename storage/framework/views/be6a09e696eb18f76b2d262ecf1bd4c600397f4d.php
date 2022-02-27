<?php if (isset($component)) { $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\GuestLayout::class, []); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <style>
        .start_pg {
            padding: 0 8%;
        }
        .start_pg {
            width: 100%;
            text-align: center;
        }

        .start_pg h3 {
            font-size: 4rem;
            color: #011ed1;
        }

        .start_pg p {
            font-size: 32px;
            color: #000;
        }

        .start_pg p span {
            font-weight: bold;
            line-height: 1.4;
        }

        .start_pg h4 {
            font-size: 28px;
            font-weight: normal;
            color: #011ed1;
        }
    </style>
    <div id="main-wrapper">
        <div class="form-wrapper approval-page row">
            <div class="col-md-5 left-col d-flex align-items-center flex-column justify-content-between">
                <div class="top-head text-center">
                    <h1 class="main-heading"><?php echo e(__('Welcome to Sortiment')); ?></h1>
                    <p><?php echo e(__('Your products are waiting for you in the shop, go login and see the products for yourself')); ?>.</p>
                </div><!-- Top heading -->
                <div class="mid-col text-center">
                <form method="POST" action="<?php echo e(url('logout')); ?>" >
                        <?php echo csrf_field(); ?>
                        <?php if(Auth::user()): ?>
                        <a class="block btn bdr-btn" href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault();
                                        this.closest('form').submit();">Log ud</a>
                        <?php endif; ?>
                    </form>
                    <!--<a href="<?php echo e(route('login')); ?>" class="btn bdr-btn"><?php echo e(__('Log ud')); ?></a>-->
                    <p><a href="<?php echo e(route('login')); ?>"><strong><?php echo e(__('Already have an account?')); ?> </strong></a></p>
                </div><!-- Middle col -->
                <div class="bot-col text-center">
                    <p><?php echo e(__('If you have any questions please contact Sortiment using')); ?> <strong>info@sortiment.dk or 41 88 80 80</strong></p>
                </div><!-- Bottom col -->
            </div><!-- left col -->
            <div class="col-md-7 right-col d-flex align-items-center justify-content-center">
                <div class="start_pg">
                <h3>Succes!</h3>

                <p><?php echo e(__('You are almost ready we have received your account information and your account is being reviewed. This is only to make sure you’re not a bot')); ?></p>

                <p><span><?php echo e(__('A employee will look at your account momentarily and approve your account ASAP')); ?></span></p>

                <h4><strong><?php echo e(__('For urgent requests')); ?></strong><br>
                <?php echo e(__('Phone')); ?>: +45 41 88 80 80</h4>

                    </div>
          </div><!-- Right col -->
        </div><!-- Form wrapper -->
    </div><!-- Main wrapper -->

    
 <?php if (isset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015)): ?>
<?php $component = $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015; ?>
<?php unset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/welcome.blade.php ENDPATH**/ ?>