<?php

namespace App\Http\Controllers;

use App\Models\BannerSlide;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = BannerSlide::orderBy('id')->paginate(2);
        return view('dashboard.banner.index', compact('banners'))
            ->with('i', (request()->input('page', 1) - 1) * 2);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'link' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isShown' => 'required',
            'slideOrder' => 'required',
        ], [
            'title.required' => 'Banner Title is required.',
            'details.required' => 'Banner Description is required.',
            'link.required' => 'Banner Link is required.',
            'photo.required' => 'Banner Image is required.',
            'image.image' => 'Banner Image must be an image.',
            'slideOrder.required' => 'Banner Slide Order is required.'
        ]);
//        dd($request);
        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalName();
        $request->photo = $imageName;

        $image->move(public_path('site/images/slider'), $imageName);
        $banner = new BannerSlide();
        $banner->title = $request->title;
        $banner->details = $request->details;
        $banner->link = $request->link;
        $banner->photo = $imageName;
        $banner->slideOrder = $request->slideOrder;
        if($request->isShown == null){
            $banner->isShown = 0;
        }
        else{
            $banner->isShown = 1;
        }
//        dd($banner);
        $banner->save();

        return redirect()->route('banner.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BannerSlide $banner)
    {
        return view('dashboard.banner.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BannerSlide $banner)
    {
        return view('dashboard.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BannerSlide $banner)
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'link' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isShown' => 'required',
            'slideOrder' => 'required',
        ], [
            'title.required' => 'Banner Title is required.',
            'details.required' => 'Banner Description is required.',
            'link.required' => 'Banner Link is required.',
            'photo.required' => 'Banner Image is required.',
            'image.image' => 'Banner Image must be an image.',
            'slideOrder.required' => 'Banner Slide Order is required.'
        ]);
//        dd($request);
        $banner->title = $request->title;
        $banner->details = $request->details;
        $banner->link = $request->link;
        $banner->slideOrder = $request->slideOrder;
        //$banner->photo = $imageName;
        if($request->isShown == null){
            $banner->isShown = 0;
        }
        else{
            $banner->isShown = 1;
        }
        if($request->photo != null){
            //not empty
            unlink(public_path('site/images/slider') . '/' . $banner->photo);
            $image = $request->file('photo');
            $imageName = time()  . '.' . $request->photo->getClientOriginalName();

            $image->move(public_path('site/images/slider'), $imageName);
            $banner->photo = $imageName;
        }
//        dd($banner, $request);
        $banner->update();
        return redirect()->route('banner.index')
            ->with('success', 'Banner updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BannerSlide $banner)
    {
        unlink(public_path('site/images/slider') . '/' . $banner->photo);
        $banner->delete();

        return redirect()->route('banner.index')
            ->with('success', 'Banner deleted successfully.');
    }

    public function isShown(BannerSlide $banner)
    {
        if($banner->isShown == 0){
            $banner->isShown = 1;
        }
        else{
            $banner->isShown = 0;
        }

        $banner->save();
        return redirect()->route('banner.index')
            ->with('success','Product Active Status Changed successfully');
    }
}
