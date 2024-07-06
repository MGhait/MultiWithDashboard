<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PtoCController extends Controller
{
    public function index(){
        $projects = Project::all();
        $categories = Category::all();

        $pToc = DB::select('SELECT
    `projects`.`title` AS `ProjectName`,
    `categories`.`categoryName` AS `CategoryName`
FROM
    `projectcategory`,
    `projects`,
    `categories`
WHERE
    `projectcategory`.`projectId` = `projects`.`id` AND `projectcategory`.`categoryId` = `categories`.`id`
ORDER BY
    `projects`.`id`;');

        return view('dashboard.projectToCategory.index',compact('projects','categories','pToc'));

    }

    public function store(Request $request){
        $pToCs = DB::select("SELECT * FROM `projectcategory`
         WHERE `projectcategory`.`projectId` = ?
         AND `projectcategory`.`categoryId` = ?;",
            [$request->projectId, $request->categoryId]);

        if(count($pToCs) == 0) {
            ProjectCategory::create($request->all());
        }
        return redirect('dashboard/projecttocategory');

    }
}
