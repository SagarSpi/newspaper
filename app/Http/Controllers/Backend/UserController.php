<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $users = User::orderBy('created_at','DESC')
                    ->paginate(9);

        return view('backend.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {   
        try {
            DB::beginTransaction();

            // Default Image
            $uploadedFileUrl = 'https://res.cloudinary.com/demeqriqu/image/upload/v1739026688/Newspaper/Users-image/Default_image/user_default_image.png';
            $public_id = 'Newspaper/Users-image/Default_image/user_default_image';
            
            if ($request->hasFile('image')) {

                $timeStamp = Carbon::now()->format('Y-M');
                $folderName = 'Newspaper/Users-image/'.$timeStamp;
                $imageUniqueName = time();
    
                // Upload with image to cloudinary
                $uploadimage = cloudinary()->upload($request->file('image')->getRealPath(), [
                    'folder' => $folderName,
                    'public_id'=> $imageUniqueName
                ]);

                $uploadedFileUrl = $uploadimage->getSecurePath();
                $public_id = $uploadimage->getPublicId();
            }
    
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'image_url'=>$uploadedFileUrl,
                'image_id'=>$public_id,
                'contacts'=>$request->number,
                'status'=>'active',
                'role'=>'user',
            ]);
            
            DB::commit();
            return redirect()->route('login')->with('success','Users Created Succesfully !');

        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->back()->with('error','Failed To Create Users !'.$err->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('backend.userProfile');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('backend.userEdit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        DB::beginTransaction();

        try {

            $uploadedFileUrl = $user->image_url;
            $public_id = $user->image_id;

            if ($request->hasFile('image')) {

                $storedImageId = $user->image_id;
                $defaultImageId = 'Newspaper/Users-image/Default_image/user_default_image';
    
                if ($storedImageId && $storedImageId !== $defaultImageId) {
                    Cloudinary::destroy($storedImageId);
                }
    
                $timeStamp = Carbon::now()->format('Y-M');
                $folderName = 'Newspaper/Users-image/'.$timeStamp;
                $imageUniqueName = time();
    
                // Upload with image to cloudinary
                $uploadimage = cloudinary()->upload($request->file('image')->getRealPath(), [
                    'folder' => $folderName,
                    'public_id'=> $imageUniqueName
                ]);
    
                $uploadedFileUrl = $uploadimage->getSecurePath();
                $public_id = $uploadimage->getPublicId();
            }
            
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'image_url'=>$uploadedFileUrl,
                'image_id'=>$public_id,
                'contacts'=>$request->number,
                'role'=>$request->role,
                'status'=>$request->status,
            ]);

            DB::commit();
            return redirect()->route('user.list')->with('success',"User Updated Successfully !");

        } catch (\Exception $err) {
            DB::rollBack();
            return redirect()->route('user.edit',$id)->with('error',"Failed To Update User !". $err->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
