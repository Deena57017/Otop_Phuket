<?php

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

Route::get('', 'Product\\ProductCustomerController@homepage');                                                      /* Route หน้าแรกของเว็บไซต์ */
Route::get('home', 'Product\\ProductCustomerController@homepage');                                                  /* Route หน้าแรกของเว็บไซต์ */
Route::get('product/{product_id}', 'Product\\ProductCustomerController@show');
Route::get('product/category/{category_name}', 'Product\\ProductCustomerController@productByCategory');
Route::get('product/district/{district_name}', 'Product\\ProductCustomerController@productByDistrict');
Route::post('search', 'Product\\ProductCustomerController@search');
/* Route แสดงรายละเอียดสินค้านั้นๆ */

Auth::routes();

Route::group(['middleware' => ['auth', 'is_admin']], function() {
    /* Route เพิ่มหมวดหมู่ลงในระบบ ฝั่งผู้ดูแลระบบ */
    Route::get('category', 'Category\\CategoryController@index');
    Route::post('category/add', 'Category\\CategoryController@addCategory');
    Route::get('category/edit/{category_id}', 'Category\\CategoryController@editCategory');
    Route::post('category/update', 'Category\\CategoryController@updateCategory');
    Route::post('category/delete/{category_id}', 'Category\\CategoryController@deleteCategory');

    /* Route เพิ่มหมวดหมู่ย่อยลงในระบบ ฝั่งผู้ดูแลระบบ */
    Route::get('subcategory', 'Category\\SubCategoryController@index');
    Route::post('subcategory/add', 'Category\\SubCategoryController@addSubCategory');
    Route::get('subcategory/edit/{subcategory_id}', 'Category\\SubCategoryController@editSubCategory');
    Route::post('subcategory/update', 'Category\\SubCategoryController@updateSubCategory');
    Route::post('subcategory/delete/{subcategory_id}', 'Category\\SubCategoryController@deleteSubCategory');

    /* Route เพิ่มอำเภอในระบบ ฝั่งผู้ดูแลระบบ */
    Route::get('district', 'District\\DistrictController@index');
    Route::post('district/add', 'District\\DistrictController@addDistrict');
    Route::get('district/edit/{district_id}', 'District\\DistrictController@editDistrict');
    Route::post('district/update', 'District\\DistrictController@updateDistrict');
    Route::post('district/delete/{district_id}', 'District\\DistrictController@deleteDistrict');

    /* Route เพิ่มตำบลในระบบ ฝั่งผู้ดูแลระบบ */
    Route::get('subdistrict', 'District\\SubDistrictController@index');
    Route::post('subdistrict/add', 'District\\SubDistrictController@addSubDistrict');
    Route::get('subdistrict/edit/{subdistrict_id}', 'District\\SubDistrictController@editSubDistrict');
    Route::post('subdistrict/update', 'District\\SubDistrictController@updateSubDistrict');
    Route::post('subdistrict/delete/{subdistrict_id}', 'District\\SubDistrictController@deleteSubDistrict');

    /* Route เพิ่มสินค้า ฝั่งผู้ดูแลระบบ */
    Route::get('product', 'Product\\ProductAdminController@index');                                                  /* Route แสดงหน้าเพิ่มสินค้า ฝั่งผู้ดูแลระบบ */
    Route::post('product/add', 'Product\\ProductAdminController@addProduct');
    Route::get('product/edit/{product_id}', 'Product\\ProductAdminController@editProduct');
    Route::post('product/update', 'Product\\ProductAdminController@updateProduct');
    Route::post('product/delete/{product_id}', 'Product\\ProductAdminController@deleteProduct');

    Route::get('order/statistic', 'Chart\\ChartController@orderChartByYear');
    Route::post('order/statistic', 'Chart\\ChartController@orderChartByYear');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('cart', 'Cart\\CartController@index');
    Route::post('cart/add', 'Cart\\CartController@addToCart');
    Route::post('cart/manage', 'Cart\\CartController@manageCartOptionByAction');
    Route::get('checkout', 'Order\\OrderController@checkout');
    Route::get('checkout/{payment_id}', 'Order\\OrderController@checkoutByPaymentId');
    Route::post('payment', 'Payment\\PaypalController@payment');
    Route::get('payment/status/{payId}', 'Payment\\PaypalController@successPaypalCallback');
    Route::post('user/detail/update', 'User\\UserCustomerController@updateUserDetail');
    Route::get('order', 'Order\\OrderController@index');
});
