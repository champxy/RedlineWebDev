<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AdminSetting;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth\UserRecord;
use Kreait\Firebase\Exception\Auth\UserNotFound;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $database;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Database $database,Request $request)
    {
        $this->database = $database;
    }

    public function findUserByEmail(Request $request)
    {
        $email = $request->email;
        $pwd = $request->password;
        $status_user = 'guest';
        $alluser = $this->database->getReference('Admin')->getValue(); 
        foreach($alluser as $key => $export_user){
            if($export_user!=null){
                if(($email===$export_user['email'])&&($pwd===$export_user['password'])){
                    if($export_user['type']==100){
                        $status_user = 'admin';
                        session(['user_name'=>$export_user['name']]);
                        session(['user_type' => 'admin']);
                        alert('swal', 'success', 'เข้าสู่ระบบสำเร็จ', 'เข้าสู่ระบบ');
                        return(redirect()->route('admin.adminSetting.index'));
                    }else{
                        $status_user = 'user';
                        session(['user_type' => 'user']);
                        return(redirect()->back());
                    }
                }else{
                    $status_user = 'guest';
                }
            }
        }
        return redirect()->back()->with('error', 'Invalid email or password');
    }
}
