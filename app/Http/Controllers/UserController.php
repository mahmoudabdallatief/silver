<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()
     {

     $this->middleware('auth');
     $this->middleware('permission:all-users', ['only' => ['index']]);
     $this->middleware('permission:add-user', ['only' => ['create']]);
     $this->middleware('permission:edit-user', ['only' => ['edit']]);
     
     
     }
     public function home()
     {
        $users=  User::where('id','<>',Auth::user()->id)->orderBy('id','desc')->get();
         return view('users.index' ,compact('users'));
     }
    public function index()
    {
        $users=  User::where('id','<>',Auth::user()->id)->orderBy('id','desc')->get();
        return view('users.index' ,compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name_' . app()->getLocale(),'name_en')->all();
//dd( app()->getLocale());
return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->roles_name);
        $validator = Validator::make($request->all() ,[
            'name_en' => ['required', 'string','regex:/^[a-zA-Z0-9\s.,?!\'"]+$/', 'min:12',  'max:255'],
            'name_ar' => ['required', 'string','regex:/^[\x{0600}-\x{06FF}\s]+$/u' ,'min:12', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'same:confirm-password'],
            'roles_name' => 'required',
            

            ]);
            if ($validator->fails()) {
                return redirect()->route('users.create')->withErrors($validator)->withInput();
            }
          
          $user =  User::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles_name' => $request->roles_name,
    
            ]);
            foreach ($request->roles_name as $roleName) {
                $role = Role::where('name_en', $roleName)->first();
                if ($role) {
                    $user->assignRole($role);
                }
            }
            return redirect()->route('users.index')
            ->with('Add',__('mycustom.successadduser'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $user = User::findOrFail($id);

            $roles = Role::pluck('name_' . app()->getLocale(),'name_en')->all();

            $userRole = $user->roles->all();

            return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
   
    $validator = Validator::make($request->all(), [
        'name_en' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s.,?!\'"]+$/', 'min:12', 'max:255'],
        'name_ar' => ['required', 'string', 'regex:/^[\x{0600}-\x{06FF}\s]+$/u', 'min:12', 'max:255'],
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => ['nullable', 'string', 'min:8', 'same:confirm-password'],
        // Use 'confirmed' rule for password confirmation
        'roles_name' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
  
    if(!empty($request->password)){
        $password = Hash::make($request->password);
        User::where('id',$id)->update([
             'password'=> $password
        ]);
    }

    User::where('id',$id)->update([
        'name_ar' => $request->name_ar,
        'name_en' => $request->name_en,
        'email' => $request->email,
        'roles_name'=>$request->roles_name
    ]);

    DB::table('model_has_roles')->where('model_id',$id)->delete();
    $user = User::findOrFail($id);

    foreach ($request->roles_name as $roleName) {
        $role = Role::where('name_en', $roleName)->first();
        if ($role) {
            $user->assignRole($role);
        }
    }

    return redirect()->route('users.index')
        ->with('edit',__('mycustom.successupdateuser'));
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
return redirect()->route('users.index')->with('delete',__('mycustom.successdeleteuser'));
    }

    public function chat()
{
   $loggedInUserId = Auth::user()->id;
   $users = User::where('id', '!=', $loggedInUserId)->get();
  // dd($users);
   return view('chat',compact('users'));
}
}
