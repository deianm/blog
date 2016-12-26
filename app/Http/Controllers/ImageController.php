<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    protected $imageRepository;

    /**
     * ImageController constructor.
     * @param $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->middleware(['auth', 'admin']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function images()
    {
        $images = $this->imageRepository->getAll();
        $image_count = $this->imageRepository->count();
        return view('admin.images', compact('images','image_count'));
    }

    /**
     * @param Request $request
     * @return mixed
     */

    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|max:5000'
        ]);
        $type = $request->input('type', null);
        if ($type != null && $type == 'xrt') {
            return $this->imageRepository->uploadImageToLocal($request);
        } else {
            if ($this->imageRepository->uploadImageToLocal($request))
                return back()->with('success', 'Image Uploaded successfully.');
            return back()->withErrors('Image Upload Error.');
        }
    }

/*
    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        return back()
            ->with('success','Image Uploaded successfully.')
            ->with('path',$imageName);
    }
*/

}
