<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
  public function add()
  {
    return view('admin.profile.create');
  }
    
    // 以下を追記
  public function create(Request $request)
  {
    // 以下を追記
    // Varidationを行う
    $this->validate($request, Profile::$rules);
    $profile = new Profile;
    $form = $request->all();
   
    // フォームから送信されてきた_tokenを削除する
    unset($form['_token']);
    
    // データベースに保存する
    $profile->fill($form);
    $profile->save();
    // admin/profile/createにリダイレクトする
    return redirect('admin/profile/create');
  }
  
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Profile::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのプロフィールを取得する
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
  public function edit(Request $request)
  {
      // profile Modelからデータを取得する
      $profile = Profile::find(1);
      if (empty($profile)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['profile_form' => $profile]);

  }
  
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // Profile Modelからデータを取得する
      $profile= Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();

      unset($profile_form['_token']);
      unset($profile_form['remove']);
      
      $profile->fill($profile_form)->save();
      
        $history = new ProfileHistory();
        $history->profile_id = $profile->id;
        $history->edited_at = Carbon::now();
        $history->save();
        return redirect('admin/profile/edit');
  }
}


