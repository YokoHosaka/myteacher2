@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <?php $user = Auth::user(); ?>
        <div class="row">
            <aside class="col-xs-4">
                <!--会員ページのメンテナンスへリンクするボタン配置-->
            </aside>
            <div class="col-xs-8">
                {!! link_to_route('knowledges.register', 'MyTeacherになる!', null, ['class' => 'btn btn-lg btn-primary']) !!}
                <!--MyTeacherを探す　knowledge登録する画面へのボタン配置-->
            </div>
            <!--<div class="col-xs-12 text-center" style="margin-top: 16px;">-->
            <!--    {!! link_to_route('fields.index', 'MyTeacherを探す！', null, ['class' => 'btn btn-lg btn-success']) !!}-->
                <!--MyTeacherを探す　分野一覧へリンクするボタン配置-->
            <!--</div>-->
        <div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>MyTeacher</br> 友達の友達∞でみつけよう！</h1>
                {!! link_to_route('signup.get', '今すぐ登録!', null, ['class' => 'btn btn-lg btn-primary']) !!}
                <!--AuthControllerでprotected $redirectTo ='/'; を追加するのを忘れずに-->
                <!--Formやlink_to_routeの使用のためcomposer.jsonで"laravelcollective/html":"5.1.*"を追加して$composer updateする-->
                <!--Config\Appのprovidersとaliasesにインストールしたライブラリが使用できるようにする設定も必要　//追加と記載した箇所-->
                {!! link_to_route('login.get', 'ログイン', null, ['class' => 'btn btn-lg btn-primary']) !!}
       　    </div>
        </div>
    @endif
@endsection
