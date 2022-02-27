<?php $__env->startSection('css'); ?>
<style>
    .process-row{padding:15px;}
    .process-row .icon {
        margin-right: 20px;
    }
    .process-row .date-time {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        padding-left: 40px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin'); ?>
<div class="container-full">

    <section class="content">

        <div class="row">
            <div class="col-md-8">
                <div class="order-decs">
                    







                <h3 class="heading head"><?php echo e(__('Order Id')); ?> : #<?php echo e($order->order_number); ?>, <?php echo e(__('Status')); ?> : "<?php echo e(__($order->status)); ?>", year : <?php echo e($order->order_year); ?>


                </h3>

                    <hr>

                    <?php
                    $orderItems=DB::table('order_items')->where('order_id',$order->id)->get();
                    $i=1;
                ?>
               <div class="row">
                  <div class="col-md-12">
                  <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1=>$orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                     <h3 class="tt-tt"><?php echo e(__('Product name')); ?> : <strong><?php echo e(\App\Models\CustomizeProduct::where('id',$orderItem->product_id)->value('product_name')); ?></strong>

                    </h3>
                     <?php
                    $orderItemssubs=DB::table('order_label_qties')->where(['order_id'=>$order->id,'order_item_id'=>$orderItem->id])->get();
                    $product_details=DB::table('customize_products')->where(['id'=>$orderItem->product_id])->first();

                    $distincts = DB::table('customize_product_attributes')->distinct()->select('attribute_id')->where('product_id', '=',$orderItem->product_id)->get();


                    ?>


                    <?php
                    $orderItemsAttr=DB::table('order_item_attrs')->where(['order_item_id'=>$orderItem->id,'order_item_id'=>$orderItem->id])->get();
                    //print_r($orderItemsAttr);die;
                    $aatttrr2=[];

                    ?>


                    <?php if($orderItemsAttr->count()>0): ?>
                     <h5><span></span> <?php echo e(__('Product for yourself')); ?> <a class="btn btn-rounded btn-info pull-right" href="<?php echo e(url('order/order-namelist/'.$order->id.'/'.$orderItem->id)); ?>">Name list</a></h5>
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th><?php echo e(__('NO')); ?></th>
                                 <?php if($product_details->name_on_product=='yes'): ?><th><?php echo e(__('Name label')); ?></th><?php endif; ?>
                                 <?php $__currentLoopData = $orderItemsAttr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderAttr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <th><?php echo e(__(\App\Models\Attribute::where('id',$orderAttr->attribute_id)->value('attr_name'))); ?></th>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                 <th><?php echo e(__('Quantity')); ?></th>
                              </tr>
                           </thead>

                           <tbody>
                           <?php $__currentLoopData = $orderItemsAttr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key3=>$orderItemsAttr_1s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php
                               $aatttrr=$orderItemsAttr_1s->attribute_value;

                               $aatttrr2[]=explode(',',$aatttrr);

                               ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                               <?php

                               $j=1;?>
                               <?php $__currentLoopData = $orderItemssubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2=>$orderItemssub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                              <tr>
                                 <td><?php echo e($j); ?></td>
                                 <?php if($product_details->name_on_product=='yes'): ?><td><?php echo e($orderItemssub->label); ?></td><?php endif; ?>
                                 <?php $__currentLoopData = $aatttrr2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key4=>$aatttr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <td><?php print_r($aatttr[$key2]) ?></td>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <td><?php echo e($orderItemssub->aqty); ?></td>
                              </tr>
                                <?php
                                $j=$j+1;
                                ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                           </tbody>
                        </table>
                     </div>
                    <?php endif; ?>

                    <?php
                    $orderemployees=DB::table('order_employees')->where(['order_item_id'=>$orderItem->id,'order_item_id'=>$orderItem->id])->get();
                    ?>
                    <?php if($orderemployees->count()>0): ?>
                     <h5><span></span> <?php echo e(__('Product for employees')); ?></h5>
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>NO</th>
                                 <th><?php echo e(__('Employee name')); ?></th>
                                 <?php if($product_details->name_on_product=='yes'): ?><th><?php echo e(__('Name label')); ?></th><?php endif; ?>
                                 <?php $__currentLoopData = $distincts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distinct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($distinct->attribute_id==1): ?>
                                        <th><?php echo e(__('Color')); ?></th>
                                    <?php else: ?>
                                        <th><?php echo e(__('Size')); ?></th>
                                    <?php endif; ?>

                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <th><?php echo e(__('Quantity')); ?></th>
                              </tr>
                           </thead>

                           <tbody>
                           <?php
                           $k=1;
                           ?>
                           <?php $__currentLoopData = $orderemployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderemployee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                 <td><?php echo e($k); ?></td>
                                 <td><?php echo e($orderemployee->employee_name); ?></td>
                                 <?php if($product_details->name_on_product=='yes'): ?><th><?php echo e($orderemployee->label); ?></th><?php endif; ?>
                                 <?php $__currentLoopData = $distincts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distinct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($distinct->attribute_id==1): ?>
                                        <td><?php echo e($orderemployee->color); ?></td>
                                    <?php else: ?>
                                        <td><?php echo e($orderemployee->size); ?></td>
                                    <?php endif; ?>

                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                 <td>1</td>
                              </tr>
                              <?php
                                $k=$k+1;
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                           </tbody>
                        </table>
                     </div>

                     <br>
                    <?php endif; ?>


                    <?php
                    $i=$i+1;
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="order-block">
                                <h6><?php echo e(__('Delivery date')); ?>:</h6>
                                <p><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orderItem->estimated_delivery_date)
                            ->format('d. F')); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="order-block">
                                <h6><?php echo e(__('Delivery method')); ?>:</h6>
                                <p><?php echo e($orderItem->delivery_method); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <br>

                  </div>
               </div>




               <div class="row">
                  <div class="col-md-12">
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr class="th-bg">
                                 <th><?php echo e(__('NO')); ?></th>
                                 <th><?php echo e(__('Product name')); ?></th>
                                 <th><?php echo e(__('Quantity')); ?></th>
                                 <th><?php echo e(__('Unit price')); ?></th>
                                 <th><?php echo e(__('Total price')); ?></th>
                              </tr>
                           </thead>

                           <tbody>

                              <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                              <tr>
                                 <td><?php echo e($i); ?></td>
                                 <td><?php echo e($orderItem->product_name); ?></td>
                                 <td><?php echo e($orderItem->qty); ?> stk.</td>
                                 <td><?php echo e($orderItem->price); ?></td>
                                 <td><?php echo e($orderItem->price*$orderItem->qty); ?></td>
                              </tr>

                              

                              <?php
                              $i=$i+1;
                              ?>

                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                           </tbody>


                        </table>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="price-dtails">
                        <h3 style="background: rgba(0, 0, 0, 0.3);text-align: right;
    padding: 10px 15px"><?php echo e(__('Delivery costs')); ?> : <strong><?php echo e($order->delivery_costs); ?></strong></h3>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="price-dtails">
                        <h3 style="background: rgba(0, 0, 0, 0.3);text-align: right;
    padding: 10px 15px"><?php echo e(__('Amount paid')); ?> : <strong><?php echo e($order->amount+$order->delivery_costs); ?></strong></h3>
                     </div>
                  </div>
               </div>




                    <div class="row">
                        <div class="col-md-6">
                        <table class="table table-bordered">
                              <tr class="th-bg">
                                 <th><?php echo e(__('Name')); ?></th>
                                 <th><?php echo e($order->name); ?></th>
                              </tr>
                              <tr class="th-bg">
                                 <th><?php echo e(__('Email')); ?></th>
                                 <th><?php echo e($order->email); ?></th>
                              </tr>
                              <tr class="th-bg">
                                 <th><?php echo e(__('Phone')); ?></th>
                                 <th><?php echo e($order->phone); ?></th>
                              </tr>
                              <tr class="th-bg">
                                 <th><?php echo e(__('Address')); ?></th>
                                 <th><?php echo e($order->address); ?></th>
                              </tr>
                              <tr class="th-bg">
                                 <th><?php echo e(__('Company')); ?></th>
                                 <th><?php echo e($order->company); ?></th>
                              </tr>
                              <tr class="th-bg">
                                 <th><?php echo e(__('Post Code')); ?></th>
                                 <th><?php echo e($order->post_code); ?></th>
                              </tr>
                        </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                              <tr class="th-bg">
                                 <th><?php echo e(__('Order date')); ?>:</th>
                                 <th><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_recieved_date)->format('d. F H:i')); ?></th>
                              </tr>
                              <tr class="th-bg">
                                 <th><?php echo e(__('Payment method')); ?></th>
                                 <th><?php echo e($order->payment_method); ?></th>
                              </tr>
                              <tr class="th-bg">
                                 <th><?php echo e(__('CVR number')); ?></th>
                                 <th><?php echo e($order->cvr_no); ?></th>
                              </tr>
                              <tr class="th-bg">
                                 <th><?php echo e(__('EAN number')); ?></th>
                                 <th><?php echo e($order->ean_no); ?></th>
                              </tr>
                              
                              <tr class="th-bg">
                                 <th><?php echo e(__('Ref nr.')); ?></th>
                                 <th><?php echo e($order->ref_no); ?></th>
                              </tr>
                              <tr class="th-bg">
                                 <th><?php echo e(__('Status')); ?></th>
                                 <th><?php echo e(__($order->status)); ?></th>
                              </tr>
                            </table>
                        </div>
                    </div>

               </div><!-- order descriptions -->






            </div>
            <div class="col-md-4">
                <div class="order-track d-flex justify-content-end align-items-center">
                    <a href="#" class="btn btn-blue"><?php echo e(__('Track delivery')); ?></a>
                    <a href="#" class="btn btn-blue"><i class="fas fa-file-pdf"></i></a>
                </div>
                <div class="order-status">
                    <?php $__currentLoopData = $order_process; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="process-row d-flex align-items-center active">
                        <span class="dot"></span>
                        <?php if($orderp->status=='Order recieved'): ?>
                        <img src="<?php echo e(asset('frontend/assets/img/clipboard-regular.png')); ?>" class="icon" alt="">
                        <?php elseif($orderp->status=='Payment confirmed'): ?>
                        <img src="<?php echo e(asset('frontend/assets/img/money-check-solid.png')); ?>" class="icon" alt="">
                        <?php elseif($orderp->status=='Order being processed'): ?>
                        <img src="<?php echo e(asset('frontend/assets/img/people-carry-solid.png')); ?>" class="icon" alt="">
                        <?php elseif($orderp->status=='Shipping order'): ?>
                            <img src="<?php echo e(asset('frontend/assets/img/shipping-fast-solid.png')); ?>" class="icon" alt="">
                        <?php else: ?>
                            <img src="<?php echo e(asset('frontend/assets/img/shipping-fast-solid.png')); ?>" class="icon" alt="">
                        <?php endif; ?>
                        <h4><?php echo e(__($orderp->status)); ?> <br><small><?php echo e(__($orderp->desc)); ?></small></h4>
                        <p class="date-time"><?php echo e($orderp->date); ?></p>
                    </div><!-- Process row-->
                    <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <br>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo e(__('Update status')); ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form method="post" action="<?php echo e(route('order.status.update')); ?>">

                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="Order recieved" <?php if($order->status=='Order recieved'): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e(__('Order recieved')); ?></option>
                                    <option value="Order being processed" <?php if($order->status=='Order being processed'): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e(__('Order being processed')); ?></option>


                                    <option value="Shipping order" <?php if($order->status=='Shipping order'): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e(__('Shipping order')); ?></option>
                                    <option value="Order delivered" <?php if($order->status=='Order delivered'): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e(__('Order delivered')); ?></option>
                                    <option value="Payment confirmed" <?php if($order->status=='Payment confirmed'): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e(__('Payment confirmed')); ?></option>
                                </select>
                                </div>
                                <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                                <input type="hidden" name="order_number" value="<?php echo e($order->order_number); ?>">
                                <!--<input type="hidden" name="estimated_delivery_date" value="">-->
                                <input type="hidden" name="delivery_costs" value="<?php echo e($order->delivery_costs); ?>">
                                <input type="hidden" name="order_recieved_date" value="<?php echo e($order->order_recieved_date); ?>">
                                <input type="hidden" name="address" value="<?php echo e($order->address); ?>">
                                <input type="hidden" name="amount" value="<?php echo e($order->amount); ?>">
                                <input type="hidden" name="email" value="<?php echo e($order->email); ?>">
                                <input type="hidden" name="tracking_url" value="<?php echo e($order->tracking_url); ?>">
                                <input type="hidden" name="pdf" value="<?php echo e($order->pdf); ?>">
                                <div class="text-xs-right">
                                    <button class="btn btn-rounded btn-info" id="delete2"><?php echo e(__('Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo e(__('Update tracking url')); ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form method="post" action="<?php echo e(route('update.tracking')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                                <div class="form-group"><textarea class="form-control" name="tracking_url" ><?php echo e($order->tracking_url); ?></textarea></div>
                                <div class="text-xs-right"><button class="btn btn-rounded btn-info"><?php echo e(__('Submit')); ?></button></div>
                            </form>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo e(__('Company Order PDF')); ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form method="post" action="<?php echo e(route('update.pdf')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                                <input type="hidden" name="old_pdf" value="<?php echo e($order->pdf); ?>">
                                <div class="form-group"><input type="file" class="form-control" name="order_pdf" /></div>
                                <?php $__errorArgs = ['order_pdf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-tenger red" style="color:red"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="text-xs-right"><button class="btn btn-rounded btn-info"><?php echo e(__('Submit')); ?></button></div>
                                <?php if(!empty($order->pdf)): ?>
                                <br>
                                <iframe src="<?php echo e(asset('public/'.$order->pdf)); ?>" style="width:100%; height:200px;" frameborder="0"></iframe>
                                <a href="<?php echo e(route('remove-order-pdf',$order->id)); ?>" class="btn btn-rounded btn-danger mb-5"><?php echo e(__('Remove PDF')); ?></a>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div><!-- Order status -->

            </div>
        </div><!-- Row -->

    </section>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
function getdetail(that,id){
    //$('#myModal').modal('show');
    $.ajax({
        url: "<?php echo e(url('/company/user/getdetail/ajax')); ?>/"+id,
        type:"GET",
        dataType:"json",
        success:function(data) {
            //console.log(data);
            var html="";
            html+='<div class="row">';
            html+='<div class="col-md-4 offset-md-4">';
            if (data.profile_photo_path == null || data.profile_photo_path==''){
                html+='<div><img src="<?php echo e(url("/")); ?>/public/uploads/no_image.jpg" style="height:100px;width:auto"></div>';
            }else{
                html+='<div><img src="<?php echo e(url("/")); ?>/public/'+data.profile_photo_path+'" style="height:100px;width:auto"></div>';

            }
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Name</label><input class="form-control " type="text" value="'+data.name+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Email</label><input class="form-control " type="text" value="'+data.email+'" readonly>';
            html+='</div>';

            html+='<div class="col-md-6">';
            html+='<label>Phone</label><input class="form-control " type="text" value="'+data.phone+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Company</label><input class="form-control " type="text" value="'+data.company+'" readonly>';
            html+='</div>';

            html+='<div class="col-md-6">';
            html+='<label>Zip Code</label><input class="form-control " type="text" value="'+data.zip+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>CVR-Number</label><input class="form-control " type="text" value="'+data.crv_number+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Address</label><textarea class="form-control" readonly>'+data.address+'</textarea>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Address2</label><textarea class="form-control" readonly>'+data.address2+'</textarea>';
            html+='</div>';

            html+='</div>';


            $('.modal-body').html(html)
            $('#myModal').modal('show');
        },
    });

}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/backend/order/view.blade.php ENDPATH**/ ?>