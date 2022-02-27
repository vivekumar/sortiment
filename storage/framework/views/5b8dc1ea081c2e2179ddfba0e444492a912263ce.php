<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>Pdf Download</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
   <style>
      @page  {
         size: A4;
         margin: 0;
      }

      body {
         padding: 30px;

      }

      .invoice-wrap {
         background-color: #fff;
         border: 1px solid #ccc;
         padding: 15px;
         position: relative;
         overflow: hidden;
      }

      ul {
         padding: 0;
      }

      ul li {
         list-style: none;
         font-size: 15px;
         line-height: 1.4;
      }

      .logo {
         display: block;
         margin: 0 auto 40px;
         text-align: center;
      }

      .logo a {
         display: block;
      }

      .logo a img {
         height: 24px;
      }

      .line {
         background: #001fd1;
         height: 3px;
         margin-bottom: 15px;
         width: 50%;
      }

      .address h3 {
         font-size: 24px;
         font-weight: bold;
         color: #001fd1;
      }

      .invoive-add h3 {
         font-size: 35px;
         text-transform: uppercase;
         font-weight: bold;
      }

      .invoive-add {
         float: right;
         margin-bottom: 45px;
      }

      .bg-first {
         position: absolute;
         right: -37px;
         height: 160px;
         width: 160px;
         background: #001fd1;
         border-radius: 45px;
         top: -107px;
         transform: rotate(45deg);
      }

      .bg-sec {
         position: absolute;
         left: -56px;
         height: 160px;
         width: 259px;
         background: #161615;
         border-radius: 45px;
         transform: rotate(15deg);
         bottom: -70px;
         z-index: 1;
      }

      .bg-sec2 {
         position: absolute;
         left: -65px;
         height: 160px;
         width: 327px;
         background: #001fd1;
         border-radius: 45px;
         transform: rotate(15deg);
         bottom: -59px;
         z-index: 0;
      }

      h3.tt-tt {
         font-size: 24px;
         background: #e9ecef;
         padding: 10px 15px 12px;
         line-height: 1;
         border-left: 5px solid #001fd1;
      }

      h3.tt-tt strong {
         color: #001fd1;
      }

      .media {
         align-items: center;
         margin-bottom: 15px;
      }

      .media .media-left {
         height: 42px;
         width: 42px;
         background: #ccc;
         border-radius: 100%;
         border: 1px solid #000;
         padding: 5px;
         display: flex;
         align-items: center;
         unicode-bidi: ju;
         justify-content: center;
         margin-right: 15px;
      }

      .media .media-left img {
         width: 24px;
         margin: 0 auto;
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .media .media-body p {
         margin: 0;
      }

      .price-dtails {
         margin-bottom: 50px;
         float: right;
      }
      .delivery-dtails{
        float: right;
        margin-top: -50px;
      }
      h5 {
         font-size: 18px;
         margin-top: 30px;
      }

      h5 span {
         width: 50px;
         height: 2px;
         background: #848484;
         display: inline-block;
      }

      tr.th-bg {
         background: #001fd1;
      }

      tr.th-bg th {
         border-bottom-color: #001fd1;
         color: #fff;
      }

      .custom-table {
         margin: 0 auto;
      }

      .custom-table td {
         padding: 25px;
         text-align: center;
         vertical-align: text-top;
      }


   </style>
</head>

<body>

   <div class="container">

      <div class="row">
         <div class="col-md-12">
            <div class="invoice-wrap">
               <div class="bg-first"></div>




               <div class="logo"><a href="#"><img src="<?php echo e(asset('frontend/assets/img/sortiment-logo.png')); ?>"
                        alt="sortiment" class="img-fluid"></a></div>
<br>
<br>
<br>
<br>


               <div class="row">
                  <div class="col-md-12">
                     <div class="address">
                        <h3>Sortiment ApS </h3>
                        <div class="line"></div>
                        <ul>
                           <li>Hansborggade 30, 6100 Haderslev</li>
                           <li>Tlf : <strong>30 30 30 30</strong></li>
                           <li>Kontakt : <strong>info@sortiment.dk</strong></li>
                        </ul>
                     </div>
                  </div>


                  <div class="col-md-12">
                     <div class="invoive-add">
                        <h3>Invoice</h3>

                        <ul>
                           <li>Invoice : <strong><?php echo e($order->order_number); ?></strong></li>
                           <li>Order Date : <strong><?php echo e($order->order_recieved_date); ?></strong></li>
                           <li>Address : <strong><?php echo e($order->name); ?></strong> <br>
                              <?php echo e($order->address); ?> <br>
                              Email : <?php echo e($order->email); ?> <br>
                              Phone : <?php echo e($order->phone); ?>

                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
<br>
<br>
<br>
<br>
                <?php
                    $orderItems=DB::table('order_items')->where('order_id',$order->id)->get();
                    $i=1;
                ?>
                <div class="row">
                  <div class="col-md-12">
                  <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1=>$orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <h3 class="tt-tt">Product Name : <strong><?php echo e(\App\Models\CustomizeProduct::where('id',$orderItem->product_id)->value('product_name')); ?></strong></h3>
                     <?php
                    $orderItemssubs=DB::table('order_label_qties')->where(['order_id'=>$order->id,'order_item_id'=>$orderItem->id])->get();

                    ?>


                    <?php
                    $orderItemsAttr=DB::table('order_item_attrs')->where(['order_item_id'=>$orderItem->id,'order_item_id'=>$orderItem->id])->get();
                    //print_r($orderItemsAttr);die;
                    $aatttrr2=[];
                    ?>


                    <?php if($orderItemsAttr->count()>0): ?>
                     <h5><span></span> Product for yourself</h5>
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>NO</th>
                                 <th>Product Name</th>
                                 <?php $__currentLoopData = $orderItemsAttr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderAttr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <th><?php echo e(\App\Models\Attribute::where('id',$orderAttr->attribute_id)->value('attr_name')); ?></th>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                 <th>Quantity</th>
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
                                 <td><?php echo e($orderItemssub->label); ?></td>
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
                     <h5><span></span> Product for Employees</h5>
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>NO</th>
                                 <th>Employee Name</th>
                                 <th>Color</th>
                                 <th>Size</th>
                                 <th>Quantity</th>
                              </tr>
                           </thead>

                           <tbody>
                           <?php
                           $k=1;
                           ?>
                           <?php $__currentLoopData = $orderemployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderemployee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                 <td><?php echo e($k); ?></td>
                                 <td><?php echo e(\App\Models\Employee::where('id',$orderemployee->employee_id)->value('name')); ?></td>
                                 <td><?php echo e($orderemployee->color); ?></td>
                                 <td><?php echo e($orderemployee->size); ?></td>
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
                                 <th>NO</th>
                                 <th>Product Name</th>
                                 <th>Quantity</th>
                                 <th>Unit Price</th>
                                 <th>Total Price</th>
                              </tr>
                           </thead>

                           <tbody>

                              <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                              <tr>
                                 <td><?php echo e($i); ?></td>
                                 <td><?php echo e(\App\Models\CustomizeProduct::where('id',$orderItem->product_id)->value('product_name')); ?></td>
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
               <div class="row delivery-dtails">
                  <div class="col-md-12">
                     <div class="">
                        <h5>Delivery Costs : <strong style="color: #001fd1"><?php echo e($order->delivery_costs); ?></strong></h5>
                     </div>
                  </div>

               </div>
               <br>
<br>
<br>

               <div class="row price-dtails">

                  <div class="col-md-12">
                     <div class="">
                        <h3 style="background: #ccc;
    padding: 5px 15px 10px;">Amount Paid : <strong style="color: #001fd1"><?php echo e($order->amount + $order->delivery_costs); ?></strong></h3>
                     </div>
                  </div>
               </div>
<br>
<br>
<br>
<br>

               <div class="row">
                  <div class="col-md-12">
                     <table class="custom-table">
                        <tr>
                           <td><img src="https://cdn2.iconfinder.com/data/icons/font-awesome/1792/phone-512.png" alt=""class="img-fluid" width="32">
                                 <p>30 30 30 30<br>
                                 30 30 30 30</p></td>
                           <td><img src="http://simpleicon.com/wp-content/uploads/global1.png" alt="" class="img-fluid" width="32">
                                 <p>info@sortiment.com<br>
                                 http://sortiment.dk/</p></td>
                                 <td><img src="https://icon-library.com/images/map-marker-icon-png/map-marker-icon-png-7.jpg" alt="" class="img-fluid" width="32">
                                 <p>Sortiment ApS <br>
                                             Hansborggade 30, 6100 Haderslev</p></td>
                        </tr>
                     </table>
                  </div>
               </div>



               <h6 style="font-weight:400;width:100%;text-align: center;">This invoice is computer generated,no signature is required.</h6>


               <div class="bg-sec"></div>
               <div class="bg-sec2"></div>
            </div>
         </div>
      </div>
   </div>

</body>

</html>
<?php /**PATH /var/www/html/laravel/sortiment/resources/views/pdf/invoice.blade.php ENDPATH**/ ?>