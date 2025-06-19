<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//All  Cats
Route::get('user/categories', [UserApiController::class, 'getAllCategories']);
// http://127.0.0.1:8000/api/user/categories

//All SubCats
Route::get('user/subcategories', [UserApiController::class, 'getAllSubcategories']);
// http://127.0.0.1:8000/api/user/subcategories

//All Pro
Route::get('user/products', [UserApiController::class, 'getAllProducts']);
// http://127.0.0.1:8000/api/user/products

//All SubCat by Cat
Route::get('user/category/{id}/subcategories', [UserApiController::class, 'getSubcategoriesByCategory']);
// http://127.0.0.1:8000/api/user/category/1/subcategories

//Product by Cat
Route::get('user/category/{id}/products', [UserApiController::class, 'getProductsByCategory']);
// http://127.0.0.1:8000/api/user/category/1/products

//Product by Cat & SubCat
Route::get('user/products/{category_id}/{subcategory_id}', [UserApiController::class, 'getProductsByCategoryAndSubcategory']);
// http://127.0.0.1:8000/api/user/products/1/2

//Search Product
Route::get('user/products/search', [UserApiController::class, 'searchProducts']);
// http://127.0.0.1:8000/api/user/products/search?q=milk


