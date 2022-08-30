<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Intl\Currencies;
use App\Helpers\GlobalHelper;
use Spatie\Permission\Models\Role;

use DB;

class UserController extends Controller
{   
    
    public function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $users = $model
            ->select('users.*', 'roles.id AS role_id', 'roles.name AS role_name')
            ->leftJoin('roles', 'users.role', '=', 'roles.id')
            ->paginate(15)
        ;
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {

        $roles = Role::pluck('name','id')->all();
        return view('users.create', [
            'roles' => $roles
        ]);
    }

    public function store(UserRequest $request, User $model)
    {
        if ($request->isMethod('post'))
        {
            if($request->input('password') == $request->input('password_confirmation')) {

                $user = new User;
                $user->name      = ucfirst($request->input('name'));
                $user->email          = $request->input('email');
                $user->password       = Hash::make($request->input('password'));
                $user->status         = $request->input('status');
                $user->profile_photo  = '';
                $user->role           = $request->input('role');
                $user->save();

                $role = Role::where('id', $request->input('role'))->first();
                $user = User::where(['id' => $user->id])->first();
                $user->assignRole($role);

                return redirect()->route('user.index')->withStatus(__('User successfully created.'));
                //return redirect('user/create_firebase_user?e='.$request->input('email').'&p=' .Crypt::encrypt($request->input('password')));
            }else{
                return redirect()->route('user.create')->withError(__('Password does not match'));
            }
        }else{
            return redirect()->route('user.create')->withError(__('Invalid form entry'));
        }
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','id')->all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(UserRequest $request, User $user)
    {
        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            if($user) {
                $user->name           = ucfirst($request->input('name'));
                $user->status         = $request->input('status');
                $user->role           = $request->input('role');
                

                $oldp = $user->password;

                if($request->input('password') != '' && $request->input('password_confirmation') != '') {
                    if($request->input('password') == $request->input('password_confirmation')) {
                        $user->password   = Hash::make($request->input('password'));
                    } else {
                        //return redirect('user/edit/' . Hashids::encode($request->input('id')));
                        return redirect()->route('user.edit', $user)->withError(__('Password does not match'));
                    }
                }

                $user->save();

                DB::table('model_has_roles')->where('model_id',$user->id)->delete();

                $role = Role::where('id', $request->input('role'))->first();
                $user->assignRole($role);
                
                return redirect()->route('user.index')->withStatus(__('User successfully updated.'));             
                
            }
        }

        return redirect()->route('user.edit', $user)->withError(__('Invalid form entry'));
    }

    public function destroy(User $user)
    {
        if($user) {   
            $user->delete();
            return redirect()->route('user.index')->withStatus(__('User deleted'));  
        }
        return redirect()->route('user.index')->withError(__('Unable to delete'));  
    }

    public function update_currency(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user){
            $user->currency_symbol = $request->input('currency');
            $user->save();

            $symbol = Currencies::getSymbol($request->input('currency'));
            $result = ['is_success' => 1, 'currency_symbol' => $symbol]; 
        }else{
            $result = ['is_success' => 0]; 
        }
        return response()->json($result);
    }
}
