<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AskQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admin = Admin::where('id',1)->first();   
            
        if (!is_file(public_path($admin->profile_photo_path) )) {
            $admin->profile_photo_path = 'frontend/assets/img/user.png';
        }

        // $query = DB::table('chats')->select('datetime', 'user_id')->distinct()->where('admin_id', $admin->id)->orderBy('datetime', 'DESC')->get();
        $query = DB::select(DB::raw("SELECT DISTINCT user_id, id FROM chats WHERE admin_id = :admin_id ORDER BY chats.id DESC"), array(
            'admin_id' => $admin->id,
        ));

        $user_ids = array_column($query, 'user_id');
        $user_ids = array_unique($user_ids);
        //print_r($user_ids);die;
        $chats = [];
        if(!empty($user_ids)){
            foreach ($user_ids as $key => $user_id) {
                //print_r($user_id);
                $user = User::find($user_id);
                //print_r($user);die;
                if($user){
                    if (!is_file(public_path($user->profile_photo_path))) {
                        $user->profile_photo_path = 'frontend/assets/img/user.png';
                    }
                }

                $chats[$key]['user'] = $user;
            }
        }

        return view('admin.question.chat', compact('chats', 'admin'));
    }

    public function messages(Request $request,  $user_id)
    {
        $admin = Auth::user();
        $user = User::find($user_id);

        if (!is_file(public_path($admin->profile_photo_path) )) {
            $admin->profile_photo_path = 'frontend/assets/img/user.png';
        }

        if (!is_file(public_path($user->profile_photo_path) )) {
            $user->profile_photo_path = 'frontend/assets/img/user.png';
        }

        $chats = Chat::where('user_id', '=', $user->id)->where('admin_id', '=', $admin->id)->orderBy('id', 'ASC')->get();

        return response()->json([
            'chats' => $chats,
            'user' => $user,
            'admin' => $admin
        ]);
    }
}
