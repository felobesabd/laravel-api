<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    use GeneralTrait;

    public function index()
    {
        $categories = Category::selection()->get();
        return $this->returnData('data', $categories, 200);
    }

    public function getOne(Request $request)
    {
        $category = Category::selection()->find($request->id);
        if (!$category) {
            return $this->returnError(404, 'Not found Category By id '.$request->id);
        }
        return $this->returnData('category', $category, 200);
    }

    public function changeStatus(Request $request)
    {
        //validation
        $category = Category::where('id', $request->id) -> update(['active' => $request->active]);
        if (!$category) {
            return $this->returnError(404, 'Not found Category By id '.$request->id);
        }

        return $this->returnSuccessMessage(200, 'Updated successfully');
    }
}
