<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Http\Request;


class ApiController extends Controller
{
use api_responseTrait;
    public function categories(){

        $categories=CategoriesResource::collection(Category::all());
            return $this->ApiResponse($categories, 'ok', 200);

    }
    public function category($id){
        $category=Category::find($id);
        if($category) {
            return $this->ApiResponse(new CategoriesResource($category), 'ok', 200);
        }
        else{
            return $this->ApiResponse(null, 'category is not found', 404);
        }
    }
    public function store(CategoryRequest $request){
        $category=Category::create($request->all());
        if($category) {
            return $this->ApiResponse(new CategoriesResource($category), 'category stored successfully', 201);
        }
        else{
            return $this->ApiResponse(null, 'category is not saved', 400);
        }
    }
    public function update(CategoryRequest $request,$id){
        $category=Category::find($id);
        if($category) {
            $category->update($request->all());

            return $this->ApiResponse(new CategoriesResource($category), 'category updated successfully', 200);
        }
        else{
            return $this->ApiResponse(null, 'category is not found', 400);
        }
    }
    public function delete($id){
        $category=Category::find($id);

        if($category) {
            $category->destroy($id);
            return $this->ApiResponse(null, 'category deleted successfully', 200);
        }
        else{
            return $this->ApiResponse(null, 'category is not found', 400);
        }
    }
}
