<?php $__env->startSection('content'); ?>  
<div class="order-history-wrap shadow-box">
    <div class="order-head d-flex align-items-center justify-content-between">
        <h3><i class="fas fa-receipt"></i> Order history</h3>
        <p>Number of orders: #7</p>
    </div><!-- Order head -->
    <div class="table-content">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order number</th>
                        <th>Product(s)</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tr>
                    <td>
                        <strong>Order: #1</strong>
                    </td>
                    <td>Name of product</td>
                    <td>10</td>
                    <td>4.500</td>
                    <td>
                        <span class="btn btn-status">Received</span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="#"><i class="fas fa-eye"></i></a>
                            <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Order: #2</strong>
                    </td>
                    <td>
                        <div>Name of product</div>
                        <div>Name of product</div>
                    </td>
                    <td>
                        <div>22</div>
                        <div>10</div>
                    </td>
                    <td>10.000</td>
                    <td>
                        <span class="btn btn-status blue">Completed</span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="#"><i class="fas fa-eye"></i></a>
                            <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                            <a href="#"><i class="fas fa-file-pdf"></i></a>
                            <a href="#"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Order: #3</strong>
                    </td>
                    <td>Name of product</td>
                    <td>10</td>
                    <td>4.500</td>
                    <td>
                        <span class="btn btn-status">Started</span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="#"><i class="fas fa-eye"></i></a>
                            <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Order: #4</strong>
                    </td>
                    <td>Name of product</td>
                    <td>10</td>
                    <td>4.500</td>
                    <td>
                        <span class="btn btn-status small-text">Waiting employee details</span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="#"><i class="fas fa-eye"></i></a>
                            <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Order: #5</strong>
                    </td>
                    <td>Name of product</td>
                    <td>10</td>
                    <td>4.500</td>
                    <td>
                        <span class="btn btn-status">Finished</span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="#"><i class="fas fa-eye"></i></a>
                            <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Order: #6</strong>
                    </td>
                    <td>Name of product</td>
                    <td>10</td>
                    <td>4.500</td>
                    <td>
                        <span class="btn btn-status">Sent</span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="#"><i class="fas fa-eye"></i></a>
                            <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Order: #7</strong>
                    </td>
                    <td>Name of product</td>
                    <td>10</td>
                    <td>4.500</td>
                    <td>
                        <span class="btn btn-status blue">Completed</span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="#"><i class="fas fa-eye"></i></a>
                            <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                            <a href="#"><i class="fas fa-file-pdf"></i></a>
                            <a href="#"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </td>
                </tr>
            </table>
        </div><!-- table details -->
    </div>
</div><!-- Order History -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/company/order-history.blade.php ENDPATH**/ ?>