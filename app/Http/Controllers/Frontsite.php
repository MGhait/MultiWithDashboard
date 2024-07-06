<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\BannerSlide;

class Frontsite extends Controller
{
    //
    public function index() {
        //$bannerSlides = BannerSlide::all();
        $bannerSlides = BannerSlide::where("isShown", 1)->orderBy("slideOrder", "desc")->get();

        $categories = DB::select("SELECT * FROM categories");

        $projects = DB::select("SELECT p.photo, p.title, p.brief, GROUP_CONCAT(c.categoryName SEPARATOR ' ') AS projectCategories FROM projects p LEFT JOIN projectcategory cp ON p.id = cp.projectId LEFT JOIN categories c ON cp.categoryId = c.id GROUP BY p.id, p.title, p.brief;");

        return view("welcome", [
            "bannerSlides" => $bannerSlides,
            "categories" => $categories,
            "projects" => $projects,
        ]);
    }
}
