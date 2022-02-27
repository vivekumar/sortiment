<?php

use App\Http\Controllers\Backend\AskQuestionController;
use App\Http\Controllers\Backend\DefaultMessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AttributeValueController;
use App\Http\Controllers\Backend\RequestPriceController;
use App\Http\Controllers\Backend\CustomizeProductController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductLogoPostionController;
use App\Http\Controllers\Backend\ChatSettingController;

use App\Http\Controllers\Company\CheckoutController;
use App\Http\Controllers\Company\CartController;
use App\Http\Controllers\Company\DashboardController;
use App\Http\Controllers\Company\EmployeeController as CompanyEmployeeController;
use App\Http\Controllers\Employee\EmpDashboardController;


//use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/updateapp', function()
{
   // \Artisan::call('dump-autoload');
    echo 'dump-autoload complete';
});
Route::get('/cahe', function () {
    Artisan::call('cache:clear');
    echo 'Application cache has clear successfully!';
    Artisan::call('route:cache');
    Artisan::call('optimize');
    Artisan::call('route:clear');
    echo 'Routes cache has clear successfully !';
     Artisan::call('config:cache');
    echo 'Config cache has clear successfully !';    
    Artisan::call('view:clear');
    return 'View cache has clear successfully!';
});





Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
    //Route::post('/logout',[AdminController::class,'destroy'])->name('admin.logout')->middleware('auth:admin');
});
Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
//Route::post('/logout',LogoutController::class)->name('logout')->middleware('auth:web');
Route::get('/admin/profile',[AdminProfileController::class,'AdminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit',[AdminProfileController::class,'AdminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store',[AdminProfileController::class,'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password',[AdminProfileController::class,'AdminChangePassword'])->name('admin.change.password');
Route::post('/update/change/password',[AdminProfileController::class,'UpdateChangePassword'])->name('update.change.password');


Route::middleware(['auth.admin:admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');

Route::middleware(['auth.admin:admin', 'verified'])->get('/admin/default-message',
    [DefaultMessageController::class,'index']
)->name('admin.default.message');
Route::middleware(['auth.admin:admin', 'verified'])->match(['get', 'post'], '/admin/default-message/add',
    [DefaultMessageController::class,'add']
)->name('admin.default.message.add');
Route::middleware(['auth.admin:admin', 'verified'])->match(['get', 'post'], '/admin/default-message/edit/{id}',
    [DefaultMessageController::class,'edit']
)->name('admin.default.message.edit');
Route::middleware(['auth.admin:admin', 'verified'])->get('/admin/default-message/delete/{id}',
    [DefaultMessageController::class,'delete']
)->name('admin.default.message.delete');

Route::middleware(['auth.admin:admin', 'verified'])->get('/admin/ask-qustion',
    [AskQuestionController::class,'index']
)->name('admin.ask.qustion');

Route::middleware(['auth.admin:admin', 'verified'])->get('/admin/ask-qustion/messages/{user_id}',
    [AskQuestionController::class,'messages']
)->name('admin.ask.qustion.messages');


/*Route::group(['prefix'=> 'category', 'middleware'=>['auth.admin:admin']],function(){
    Route::get('/view',[CategoryController::class,'view'])->name('all.category');
    Route::post('/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/update',[CategoryController::class,'update'])->name('category.update');
    Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');

    //SubCategoryController
    Route::get('/sub/view',[SubCategoryController::class,'view'])->name('all.subcategory');
    Route::post('/sub/store',[SubCategoryController::class,'store'])->name('subcategory.store');
    Route::get('/sub/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
    Route::post('/sub/update',[SubCategoryController::class,'update'])->name('subcategory.update');
    Route::get('/sub/delete/{id}',[SubCategoryController::class,'delete'])->name('subcategory.delete');
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);

});
Route::group(['prefix'=> 'positions', 'middleware'=>['auth.admin:admin']],function(){
    Route::get('/view',[ProductLogoPostionController::class,'view'])->name('all.position');
    Route::post('/store',[ProductLogoPostionController::class,'store'])->name('position.store');
    Route::get('/edit/{id}',[ProductLogoPostionController::class,'edit'])->name('position.edit');
    Route::post('/update',[ProductLogoPostionController::class,'update'])->name('position.update');
    Route::get('/delete/{id}',[ProductLogoPostionController::class,'delete'])->name('position.delete');
});

Route::group(['prefix'=> 'brand', 'middleware'=>['auth.admin:admin']],function(){
    Route::get('/view',[BrandController::class,'view'])->name('all.brand');
    Route::post('/store',[BrandController::class,'store'])->name('brand.store');
    Route::get('/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
    Route::post('/update',[BrandController::class,'update'])->name('brand.update');
    Route::get('/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');
});
Route::group(['prefix'=> 'attribute', 'middleware'=>['auth.admin:admin']],function(){
    Route::get('/view',[AttributeController::class,'view'])->name('all.attribute');
    Route::post('/store',[AttributeController::class,'store'])->name('attribute.store');
    Route::get('/edit/{id}',[AttributeController::class,'edit'])->name('attribute.edit');
    Route::post('/update',[AttributeController::class,'update'])->name('attribute.update');
    Route::get('/delete/{id}',[AttributeController::class,'delete'])->name('attribute.delete');

    Route::get('/value/view/{attr_id}',[AttributeValueController::class,'view'])->name('all.attributeval');
    Route::post('/value/store/',[AttributeValueController::class,'store'])->name('attributeval.store');
    Route::get('/value/edit/{id}',[AttributeValueController::class,'edit'])->name('attributeval.edit');
    Route::post('/value/update',[AttributeValueController::class,'update'])->name('attributeval.update');
    Route::get('/value/delete/{id}',[AttributeValueController::class,'delete'])->name('attributeval.delete');
});
*/
Route::group(['prefix'=> 'company', 'middleware'=>['auth.admin:admin']],function(){
    Route::get('/view',[UserController::class,'index'])->name('all.company');
    Route::get('/employee',[UserController::class,'employeelist'])->name('all.employee');
    Route::get('/user/detail/{id}',[UserController::class,'view'])->name('user.view');
    Route::get('/user/delete/{id}',[UserController::class,'delete'])->name('user.delete');
    Route::get('/employee/orderdetail/ajax/{id}',[UserController::class,'employeeOrder'])->name('employee.vieworder');
    //Route::get('/user/getdetail/ajax/{id}',[UserController::class,'view'])->name('user.view');
    Route::get('/employee/orderstatus-change/ajax/{id}/{status}',[UserController::class,'employeeOrderStatusChange'])->name('employee.changeStatus');
    Route::get('/user/approve/{user_id}',[UserController::class,'approve'])->name('admin.users.approve');
    Route::get('/user/unapprove/{user_id}',[UserController::class,'unApprove'])->name('admin.users.unapprove');
});

Route::group(['prefix'=> 'price-request', 'middleware'=>['auth.admin:admin']],function(){
    Route::any('/',[RequestPriceController::class,'index'])->name('companyp.pending');
    Route::get('/add',[RequestPriceController::class,'add'])->name('companyp.add');
    Route::post('/store',[RequestPriceController::class,'store'])->name('companyp.store');
    Route::get('/view/{id}',[RequestPriceController::class,'view'])->name('companyp.view');
    Route::get('/pdf/{id}',[RequestPriceController::class,'downloadPDF'])->name('companyp.pdf');
    Route::get('/ajax/get_images/{id}',[RequestPriceController::class,'get_upload_images']);
});
Route::group(['prefix'=> 'sample-product', 'middleware'=>['auth.admin:admin']],function(){
    Route::get('/view',[ProductController::class,'view'])->name('all.product');
    Route::get('/view_ajax',[ProductController::class,'view_ajax'])->name('prodeuct.getAjaxList');
    
    Route::get('/add',[ProductController::class,'add'])->name('add.product');
    Route::post('/store',[ProductController::class,'store'])->name('product.store');
    Route::get('/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('/update',[ProductController::class,'update'])->name('product.update');
    Route::get('/delete/{id}',[ProductController::class,'delete'])->name('product.delete');

    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');

    Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');
    Route::post('/pdf/update', [ProductController::class, 'pdfUpdate'])->name('update-product-pdf');
    Route::get('/pdf/remove/{id}', [ProductController::class, 'pdfRemove'])->name('remove-product-pdf');
    Route::post('/image/insert', [ProductController::class, 'MultiImageInsert'])->name('insert-product-image');

    Route::post('/ajax/product-upload', [ProductController::class, 'uploadFile'])->name('product.upload');

    //Product Category
    Route::group(['prefix'=> 'category', 'middleware'=>['auth.admin:admin']],function(){
        Route::get('/view',[CategoryController::class,'view'])->name('all.category');
        Route::post('/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('/update',[CategoryController::class,'update'])->name('category.update');
        Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');

        //SubCategoryController
        Route::get('/sub/view',[SubCategoryController::class,'view'])->name('all.subcategory');
        Route::post('/sub/store',[SubCategoryController::class,'store'])->name('subcategory.store');
        Route::get('/sub/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
        Route::post('/sub/update',[SubCategoryController::class,'update'])->name('subcategory.update');
        Route::get('/sub/delete/{id}',[SubCategoryController::class,'delete'])->name('subcategory.delete');
        //Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
        Route::post('/subcategory/ajax/', [SubCategoryController::class, 'GetSubCategory']);
    });
    Route::group(['prefix'=> 'positions', 'middleware'=>['auth.admin:admin']],function(){
        Route::get('/view',[ProductLogoPostionController::class,'view'])->name('all.position');
        Route::post('/store',[ProductLogoPostionController::class,'store'])->name('position.store');
        Route::get('/edit/{id}',[ProductLogoPostionController::class,'edit'])->name('position.edit');
        Route::post('/update',[ProductLogoPostionController::class,'update'])->name('position.update');
        Route::get('/delete/{id}',[ProductLogoPostionController::class,'delete'])->name('position.delete');
    });

    Route::group(['prefix'=> 'brand', 'middleware'=>['auth.admin:admin']],function(){
        Route::get('/view',[BrandController::class,'view'])->name('all.brand');
        Route::post('/store',[BrandController::class,'store'])->name('brand.store');
        Route::get('/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
        Route::post('/update',[BrandController::class,'update'])->name('brand.update');
        Route::get('/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');
    });
    Route::group(['prefix'=> 'attribute', 'middleware'=>['auth.admin:admin']],function(){
        Route::get('/view',[AttributeController::class,'view'])->name('all.attribute');
        Route::post('/store',[AttributeController::class,'store'])->name('attribute.store');
        Route::get('/edit/{id}',[AttributeController::class,'edit'])->name('attribute.edit');
        Route::post('/update',[AttributeController::class,'update'])->name('attribute.update');
        Route::get('/delete/{id}',[AttributeController::class,'delete'])->name('attribute.delete');

        Route::get('/value/view/{attr_id}',[AttributeValueController::class,'view'])->name('all.attributeval');
        Route::post('/value/store/',[AttributeValueController::class,'store'])->name('attributeval.store');
        Route::get('/value/edit/{id}',[AttributeValueController::class,'edit'])->name('attributeval.edit');
        Route::post('/value/update',[AttributeValueController::class,'update'])->name('attributeval.update');
        Route::get('/value/delete/{id}',[AttributeValueController::class,'delete'])->name('attributeval.delete');
    });

});
Route::group(['prefix'=> 'customize-product', 'middleware'=>['auth.admin:admin']],function(){
    Route::any('/view',[CustomizeProductController::class,'view'])->name('all.cproduct');
    Route::get('/add',[CustomizeProductController::class,'add'])->name('add.cproduct');
    Route::post('/store',[CustomizeProductController::class,'store'])->name('cproduct.store');
    Route::get('/edit/{id}',[CustomizeProductController::class,'edit'])->name('cproduct.edit');
    Route::post('/update',[CustomizeProductController::class,'update'])->name('cproduct.update');
    Route::get('/delete/{id}',[CustomizeProductController::class,'delete'])->name('cproduct.delete');

    Route::get('/inactive/{id}', [CustomizeProductController::class, 'ProductInactive'])->name('cproduct.inactive');
    Route::get('/active/{id}', [CustomizeProductController::class, 'ProductActive'])->name('cproduct.active');

    Route::post('/image/update', [CustomizeProductController::class, 'MultiImageUpdate'])->name('update-cproduct-image');
    Route::get('/multiimg/delete/{id}', [CustomizeProductController::class, 'MultiImageDelete'])->name('cproduct.multiimg.delete');
    Route::post('/thambnail/update', [CustomizeProductController::class, 'ThambnailImageUpdate'])->name('update-cproduct-thambnail');
    Route::post('/pdf/update', [CustomizeProductController::class, 'pdfUpdate'])->name('update-cproduct-pdf');
    Route::get('/pdf/remove/{id}', [CustomizeProductController::class, 'pdfRemove'])->name('remove-cproduct-pdf');
    Route::post('/image/insert', [CustomizeProductController::class, 'MultiImageInsert'])->name('insert-cproduct-image');
    Route::post('/ajax/product-upload', [CustomizeProductController::class, 'uploadFile'])->name('cproduct.upload');
});

Route::group(['prefix'=> 'order', 'middleware'=>['auth.admin:admin']],function(){
    Route::any('/list',[OrderController::class,'index'])->name('all.order');
    Route::get('/view/{id}',[OrderController::class,'view'])->name('view.order');
    
    Route::get('/delete/{id}',[OrderController::class,'delete'])->name('order.delete');
    Route::post('/update/tracking',[OrderController::class,'updateTracking'])->name('update.tracking');
    Route::post('/update/status',[OrderController::class,'updateStatus'])->name('order.status.update');
    Route::post('/update/pdf',[OrderController::class,'updatePDF'])->name('update.pdf');

    Route::get('/update/pdf/remove/{id}', [OrderController::class, 'pdfRemove'])->name('remove-order-pdf');
    Route::get('/download-invoice/{id}', [OrderController::class, 'downloadPDF'])->name('admin.download.invoice');
});
Route::group(['prefix'=> 'chat-setting', 'middleware'=>['auth.admin:admin']],function(){
    Route::get('/view',[ChatSettingController::class,'view'])->name('view.chat.setting');
    Route::post('update',[ChatSettingController::class,'update'])->name('update.chat.setting');
});


////--------------------- Company area route-------------------------/////
/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/

Route::group(['prefix'=> 'company', 'middleware'=>['auth:sanctum','approved']],function(){
    Route::any('/',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/product-detail/{id}',[DashboardController::class,'productDetail'])->name('product.detail');
    Route::get('/customize-product-cstatus/{id}',[DashboardController::class,'customizeProductStatus'])->name('cproduct.cstatus');
    Route::any('/my-product',[DashboardController::class,'myProduct'])->name('myproduct');

    Route::get('/company-info',[DashboardController::class,'companyInfo'])->name('companyInfo');
    Route::post('/company-save',[DashboardController::class,'companyInfoSave'])->name('companyInfoSave');
    Route::post('/company-uploads',[DashboardController::class,'companyImgUploads'])->name('companyImgUploads');
    Route::get('/images/delete/{id}',[DashboardController::class,'companyImgDelete']);

    Route::get('/order-hostory',[DashboardController::class,'orderHostory'])->name('orderHostory');
    Route::get('/aska-question',[DashboardController::class,'askAquestion'])->name('askAquestion');
    Route::get('/aska-question/chat/{admin_id}',[DashboardController::class,'askAquestionChat'])->name('askAquestionChat');

    Route::get('/your-employees',[CompanyEmployeeController::class,'yourEmployees'])->name('yourEmployees');
    Route::post('/create-employee',[CompanyEmployeeController::class,'create'])->name('createEmployee');
    Route::match(['get', 'post'], '/edit-employee/{id}',[CompanyEmployeeController::class,'edit'])->name('editEmployee');
    Route::get('/view-employee/{id}',[CompanyEmployeeController::class,'view'])->name('viewEmployee');
    Route::get('/delete-employee/{id}',[CompanyEmployeeController::class,'delete'])->name('deleteEmployee');
    Route::post('/ajax/uploadFile', [CompanyEmployeeController::class, 'uploadFile'])->name('uploadFile');
    Route::post('/ajax/uploadList', [CompanyEmployeeController::class, 'uploadList'])->name('uploadList');
    Route::post('/ajax/employee-order/approve',[CompanyEmployeeController::class,'empOrderApprove'])->name('emp.order.approve');
    Route::get('/ajax/show-employee-popdata/{id}',[CompanyEmployeeController::class,'showpopEmpHtml']);



    Route::get('/ajax/get-employee',[DashboardController::class,'getEmployee'])->name('getEmployee');
    Route::post('/ajax/price-request',[DashboardController::class,'priceRequest'])->name('priceRequest');
    Route::post('/ajax/product-denyed',[DashboardController::class,'productDeny'])->name('productDeny');



    Route::get('/information/{id}',[DashboardController::class,'CompanyInfo'])->name('cproduct.comInfo');


    Route::get('/cart', [CartController::class, 'viewCart'])->name('view.cart');
    Route::get('/cart1', [CartController::class, 'viewCart1'])->name('view.cart1');

    Route::post('/cart/store/{id}', [CartController::class, 'AddToCart'])->name('cart.store');
    Route::get('/cart/delete/{rowId}', [CartController::class, 'deleteToCart'])->name('cart.delete');
    Route::get('/cart/update/{rowId}/{perm}', [CartController::class, 'updateCart'])->name('updateCart');
    Route::get('/cart/updatebulk/{rowId}/{item_qty}', [CartController::class, 'updateCartbulk'])->name('updateCartbulk');


    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/payments', [CheckoutController::class, 'payments'])->name('payments');

    Route::get('/order-details/{id}', [DashboardController::class, 'orderDetails'])->name('order.details');
    Route::get('/download-invoice/{id}', [DashboardController::class, 'downloadInvoicePDF'])->name('download.invoice');
    Route::get('/image-pdf/{id}', [DashboardController::class, 'downloadMultiImagePDF'])->name('download.miltimg.pdf');


    Route::get('/change/product-status/{id}',[DashboardController::class,'changeProductStatus'])->name('changeProductStatus');


});

//Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/approval', function(){
    return view('welcome');
})->name('approval');


Route::get('/', function(){
    
    return  redirect()->route('login');
});

Route::get('/image-download', function(){
    

    $url ='https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-6-1.png';

    $file_arr=explode('/',$url);
    $firstarr=current($file_arr);
    $file_name=end($file_arr);
    if($firstarr=="https:"||$firstarr=="http:"){
        $img = public_path('uploads/products/images/'.$file_name);
        file_put_contents($img, file_get_contents($url));
    }else{
        echo $file_name;
    }
    echo "File downloaded! sadsa";

});
// Add to Cart Store Data



////////////////////////////////////  Employee route  ///////////////////////////////////
Route::group(['prefix'=> 'employee', 'middleware'=>['employee:employee']], function(){
	Route::get('/login', [EmployeeController::class, 'loginForm'])->name('employee-login');
	Route::post('/login',[EmployeeController::class, 'store'])->name('employee.login');

});
Route::get('/employee/logout',[EmployeeController::class,'destroy'])->name('employee.logout');

Route::group(['prefix'=> 'employee', 'middleware'=>['auth.employee:employee']],function(){
    Route::any('/shop',[EmpDashboardController::class,'employeeShop'])->name('emp.shop');
    Route::post('/shop/post',[EmpDashboardController::class,'postdetail'])->name('emp.post');
    Route::get('/edit/profile',[EmpDashboardController::class,'edit'])->name('emp.profile');
    Route::post('/update/profile',[EmpDashboardController::class,'update'])->name('emp.profile.update');
    Route::post('/update/profile-password',[EmpDashboardController::class,'updatePassword'])->name('emp.profile.updatepass');
    Route::get('/shop/detail/{id}',[EmpDashboardController::class,'viewdetail'])->name('emp.detail');
    Route::get('/aska-question',[EmpDashboardController::class,'askAquestion'])->name('emp.askAquestion');
    Route::get('/aska-question/chat/{admin_id}',[EmpDashboardController::class,'askAquestionChat'])->name('emp.askAquestionChat');
    Route::get('/aska-question/chat-company/{com_id}',[EmpDashboardController::class,'askAquestionChatCompany'])->name('emp.askAquestionChat.company');
});

Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to('dev12@infoiconsoftware.com')->send(new \App\Mail\EmployeeProductInformationMail($details));

    dd("Email is Sent.");
});
