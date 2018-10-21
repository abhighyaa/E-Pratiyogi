<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subject;

class CategoryController extends Controller
{
    public function getcategories(Subject $subject)
      {
          $categories = $subject->categories()->get();
          return response()->json($categories);
      }
}
