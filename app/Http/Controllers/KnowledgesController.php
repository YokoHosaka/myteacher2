<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Knowledge;
use App\User;

class KnowledgesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    //    メッセージボードの32/49を参照
    // $this->validate($request,[
    //         'field' => 'required|max:10',
    //         'catchcopy' => 'required|max:55',
    //         'description' => 'required|max:255',
    //     ]);
        
    //   $request->user()->knowledges()->create(['field' => $request->field, 'catchcopy' => $request->catchcopy, 'description' => $request->description,
    //     ]);

    //     return view('knowledges.register_confm')->with(['knowledge' => $knowledge]);
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'field' => 'required|max:10',
            'catchcopy' => 'required|max:55',
            'description' => 'required|max:255',
        ]);
        
        $user = \Auth::user();
        $knowledge = new Knowledge(); // モデル（）はインスタンス生成なので、この（）の中には何も入れない
        $knowledge->fill($request->all()); //fill->all()でKnowledge.phpに入っている要素を全て$knowledgeへ持ってくる
        $user->knowledges()->save($knowledge); // ここのknowledges()は$userにbelongToする関係を示す。save($knowledge)で上で定義した$knowledgeを保存
        
        $data = [
            'user' => $user,
            'knowledge' => $knowledge,
        ];
        
        // return redirect('knowledges.knowledge', $data);
        
        return redirect(action('KnowledgesController@show', $knowledge->id));
        // return redirect('/knowdges/' . $knowledge->id);　と書いても良い。/knowledges/はURI。
        // $knowledge->idは数あるKnowledgeインスタンスのうち特定のKnowledgeを表示するページであること。　. で繋いでいるのは、これが変数であるから。
        // /knowdges/1
    }

    /**
     * URI = /knowdges/{id}
     * $id knowledgeのID　ControllerのID
     */
    
    public function show($id)
    {
        $knowledge = Knowledge::find($id); //Knowledgeインスタンスのうち特定のインスタンスであること
        $user = \Auth::user();　//ログインしているUserであるということ
        
        $data = [
            'user' => $user,
            'knowledge' => $knowledge,
        ];

        return view('knowledges.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function register(){ //MyTeacherになる！からKnowledge登録フォーム画面への遷移
        return view('knowledges.register');
    }
 }
