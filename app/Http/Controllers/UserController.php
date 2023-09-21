<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User as UserModel;


class UserController extends Controller
{
    /**
     * 登録画面 を表示する
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user./register');
    }
    /**
     * 入力値を受け取る
     *
     * */

     public function register(UserRegisterPost $request){

          // validate済

        // データの取得

        $datum=$request->validated();

        $datum['password'] = Hash::make($datum['password']);

        // return view('user./input',['datum'=>$datum]);

        // 認証
        // if (Auth::attempt($datum) === false) {
        //     return back()
        //           ->withInput() // 入力値の保持
        //           ->withErrors(['auth' => 'emailかパスワードに誤りがあります。',]) // エラーメッセージの出力
        //           ;
        // }

        // return view('user./input',['datum'=>$datum]);

        //usersテーブルへINSERT
        try {
            $r = UserModel::create($datum);
        } catch(\Throwable $e) {
            echo $e->getMessage();
            exit;
        }

        // ユーザー登録成功
        $request->session()->flash('front.user_register_success', true);

        //
        // $request->session()->regenerate();
        // return redirect()->intended('/');

        return redirect('/');
     }
}
// }