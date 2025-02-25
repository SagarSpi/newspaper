<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Jobs\SendMailJob;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{   

    public function searchData(Request $request) 
    {

        $query = User::query()->latest();

        // Jodi name thake, tahole search query add korbo
        if (!empty($request->name)) {
            $query->where('name','like',"%{$request->name}%");
        }

        // Jodi email thake, tahole search query add korbo
        if (!empty($request->email)) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        // Jodi contact thake, tahole search query add korbo
        if (!empty($request->contact)) {
            $query->whereRaw('CAST(contacts AS CHAR) LIKE ?', ["%{$request->contact}%"]);
        }

        // Jodi role thake, tahole search query add korbo
        if (!empty($request->role)) {
            $query->where('role', 'like', "%{$request->role}%");
        }

        if (!empty($request->date_filter)) {
            $date = $request->date_filter;
            switch ($date) {
                case 'today':
                    $query->whereDate('created_at',Carbon::today());
                    break;
                case 'yesterday':
                    $query->whereDate('created_at',Carbon::yesterday());
                    break;
                case 'this_week':
                    $query->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
                    break;
                case 'last_week':
                    $query->whereBetween('created_at',[Carbon::now()->subWeek(),Carbon::now()]);
                    break;
                case 'this_month':
                    $query->whereMonth('created_at',Carbon::now()->month);
                    break;
                case 'last_month':
                    $query->whereMonth('created_at',Carbon::now()->subMonth()->month);
                    break;
                case 'this_year':
                    $query->whereYear('created_at',Carbon::now()->year);
                    break;
                case 'last_year':
                    $query->whereYear('created_at',Carbon::now()->subYear()->year());
                    break;
            }
        }

        $users = $query->paginate(9);

        if ($users->isEmpty()) {
            return redirect()->back()->with('error', 'No Users found.');
        }

        return view('users.users',compact('users'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   

        $users = User::orderBy('created_at','DESC')
                    ->paginate(9);

        return view('users.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register.register');
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

            dispatch(new SendMailJob((object)$request->all()));


            return redirect()->route('login')->with('success','Users Created Succesfully !');

        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->back()->with('error','Failed To Create Users !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id);
        $articles = $user->articles()->latest()->paginate(8);

       return view('users.userProfile',compact('user', 'articles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.userEdit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        try {
            DB::beginTransaction();

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
