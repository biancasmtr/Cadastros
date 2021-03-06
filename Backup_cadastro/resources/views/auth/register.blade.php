@extends('layouts.app')
@section('content')

<div class="materialContainer">
   <div class="box" >
      <div class="title">{{ __('Cadastrar Usuário') }}</div>
      <div>
         @if($errors->all())
            <div class="alert alert-danger" role="alert" >
               @foreach ($errors->all() as $key => $value)
                  <li style="color:red;">{{$value}}</li>
               @endforeach  
            </div>
         @endif
      </div>
      
      <form method="POST" action="{{ route('register') }}">
         @csrf
         <div>
            @if ($message = Session::get('success'))
               <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>	
                  <strong>{{ $message }}</strong>
               </div>
            @endif
         </div>
         <div class="input">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nome" autofocus>
            @error('name')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
         </div>
         <div class="input">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="E-mail" autocomplete="email">
            @error('email')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
         </div>
         <div class="input">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Senha">
            @error('password')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
         </div>
         <div class="input">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">
         </div>
         <div class="input">
            <select class="select" name="id_empresa">
               <option selected="true" disabled="disabled" value="null">Selecione sua empresa</option>
               @foreach(App\Empresa::all() as $empresa)
                  <option value="{{ $empresa->id_empresa }}">{{ $empresa->razao_social }}</option>
               @endforeach
            </select>
         </div>
         <div div class="box-emp">
            <p class="input">Não encontrou sua empresa? 
               <a class="a" href="/empresas/create">Cadastre Aqui</a>
            </p>
         </div>
         <div class="button login">
            <button class="btn btn-primary" type="submit" class="btn btn-primary">
               {{ __('Register') }}
            </button>
         </div>
         <div class="button login">
            @if (Route::has('login'))
               <button class="btn btn-primary" type="submit" class="btn btn-primary">
                  <a class="a" href="{{ route('login') }}" style="display: block; width: 215px; height: 65px; text-decoration:none;">{{ __('Cancelar') }}</a>
               </button>
            @endif
         </div>
      </form> 
   </div>
</div>      
@endsection

<style>
   .box {
      position: relative;
      top: 0;
      opacity: 1;
      float: left;
      padding: 60px 50px 40px 50px;
      width: 100%;
      background: #fff;
      border-radius: 10px;
      transform: scale(1);
      -webkit-transform: scale(1);
      -ms-transform: scale(1);
      z-index: 5;
   }
   
   .box.back {
      transform: scale(.95);
      -webkit-transform: scale(.95);
      -ms-transform: scale(.95);
      top: -20px;
      opacity: .8;
      z-index: -1;
   }
   
   .box:before {
      content: "";
      width: 100%;
      border-radius: 10px;
      position: absolute;
      top: -10px;
      background: rgba(255, 255, 255, .6);
      left: 0;
      transform: scale(.95);
      -webkit-transform: scale(.95);
      -ms-transform: scale(.95);
      z-index: -1;
   }
   
   .overbox .title {
      color: #fff;
   }
   
   .overbox .title:before {
      background: #fff;
   }
   
   .title {
      width: 100%;
      float: left;
      line-height: 46px;
      font-size: 28px;
      font-weight: 700;
      letter-spacing: 2px;
      color: #0d0758;
      position: relative;
   }
   
   .title:before {
      content: "";
      width: 5px;
      height: 100%;
      position: absolute;
      top: 0;
      left: -50px;
      background: rgb(33, 235, 157);
   }
   
   .input,
   .input label,
   .input input,
   .input .spin,
   .button,
   .select,
   .button button .button.login button i.fa,
   .material-button .shape:before,
   .material-button .shape:after,
   .button.login button {
      transition: 300ms cubic-bezier(.4, 0, .2, 1);
      -webkit-transition: 300ms cubic-bezier(.4, 0, .2, 1);
      -ms-transition: 300ms cubic-bezier(.4, 0, .2, 1);
   }
   
   .material-button,
   .alt-2,
   .material-button .shape,
   .alt-2 .shape,
   .box {
      transition: 400ms cubic-bezier(.4, 0, .2, 1);
      -webkit-transition: 400ms cubic-bezier(.4, 0, .2, 1);
      -ms-transition: 400ms cubic-bezier(.4, 0, .2, 1);
   }

   .box-emp {
   position: relative;
   top: 0;
   opacity: 1;
   text-align: center;
   float: left;
   padding: 20px;
   width: 100%;
   background: #fff;
   border-radius: 10px;
   transform: scale(1);
   -webkit-transform: scale(1);
   -ms-transform: scale(1);
   z-index: 5;
   margin-top: 5%;
   background: rgba(94, 94, 94, 0.05);
   }
   
   p.input {
      margin-top: 1%;
   }
   
   .input,
   .input label,
   .input input,
   .input .spin,
   .button,
   .select,
   .button button {
      width: 100%;
      float: left;
   }
   
   .inputt {
      height: 70px;
      margin-bottom: 5%;
   }
   
   .input,
   .input input,
   .button,
   .select,
   .button button {
      position: relative;
   }
   
   .input input,
   .select {
      height: 60px;
      top: 10px;
      border: none;
      background: transparent;
   }
   
   .input input,
   .input label,
   .select,
   .button button,
   p.input {
      font-family: 'Roboto', sans-serif;
      font-size: 18px;
      color: rgba(0, 0, 0, 0.8);
      font-weight: 300;
   }
   
   
   .input:before {
      content: "";
      background: rgba(0, 0, 0, 0.1);
      z-index: 3;
   }

   .overbox .input:before {
      background: rgba(255, 255, 255, 0.5);
   }
   
   .input label {
      position: absolute;
      display: block;
      top: 10px;
      left: 0;
      z-index: 2;
      cursor: pointer;
      line-height: 60px;
   }

   .select {
   display: block;
   top: 10px;
   left: 0;
   z-index: 2;
   cursor: pointer;
   line-height: 60px;
   color: rgba(0, 0, 0, 0.6);

   }
   
   .remembercheck {
      width: 100%;
      display: block;
      margin: 0 auto;
      margin-top: 57%;
   }
   
   .button.login {
      width: 48%;
      left: 20%;
   }
   
   .button.login button,
   .button button {
      width: 100%;
      line-height: 64px;
      left: 0%;
      background-color: transparent;
      border: 3px solid rgba(0, 0, 0, 0.1);
      font-weight: 900;
      font-size: 18px;
      color: rgba(0, 0, 0, 0.2);
   }
   
   
   .button button {
      background-color: #fff;
      color: #0d0758;
      border: none;
   }
   
   .button.login {
      display: block;
      float: left;
      position: initial;
      margin-top: 10%;
      margin-right: 1%;
   }
   
   .button.login button.active {
      border: 3px solid transparent;
      color: #fff !important;
   }
   
   .button.login button.active span {
      opacity: 0;
      transform: scale(0);
      -webkit-transform: scale(0);
      -ms-transform: scale(0);
   }
   
   .button.login button.active i.fa {
      opacity: 1;
      transform: scale(1) rotate(-0deg);
      -webkit-transform: scale(1) rotate(-0deg);
      -ms-transform: scale(1) rotate(-0deg);
   }
   
   .button.login button i.fa {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      line-height: 60px;
      transform: scale(0) rotate(-45deg);
      -webkit-transform: scale(0) rotate(-45deg);
      -ms-transform: scale(0) rotate(-45deg);
   }
   
   .button.login button:hover {
      color: #0d0758;
      border-color: #0d0758;
   }
   
   .button {
      overflow: hidden;
      z-index: 2;
   }
   
   .button button {
      cursor: pointer;
      position: relative;
      z-index: 2;
   }
   
   .link {
      text-decoration: none;
   }
   
   .pass-forgot {
      width: 100%;
      float: left;
      text-align: center;
      color: rgba(0, 0, 0, 0.4);
      font-size: 18px;
   }
   
   .click-efect {
      position: absolute;
      top: 0;
      left: 0;
      background: #0d0758;
      border-radius: 50%;
   }
   
   .overbox {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      overflow: inherit;
      border-radius: 10px;
      padding: 60px 50px 40px 50px;
   }
   
   .form-check-label {
      font-size: 16px !important;
   }
   
   .form-check-input input {
      width: 50%;
      background-color: red;
   }
   
   .overbox .title,
   .overbox .button,
   .overbox .input {
      z-index: 111;
      position: relative;
      color: #fff !important;
      display: none;
   }
   
   .overbox .title {
      width: 80%;
   }
   
   .overbox .input {
      margin-top: 20px;
   }
   
   .overbox .input input,
   .overbox .input label,
   {
      color: #fff;
   }
   
   .overbox .material-button,
   .overbox .material-button .shape,
   .overbox .alt-2,
   .overbox .alt-2 .shape {
      display: block;
   }
   
   .material-button,
   .alt-2 {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background: #0d0758;
      position: absolute;
      top: 40px;
      right: -70px;
      cursor: pointer;
      z-index: 100;
      transform: translate(0%, 0%);
      -webkit-transform: translate(0%, 0%);
      -ms-transform: translate(0%, 0%);
   }
     
   .material-button .shape,
   .alt-2 .shape {
      position: absolute;
      top: 0;
      right: 0;
      width: 100%;
      height: 100%;
   }
     
   .material-button .shape:before,
   .alt-2 .shape:before,
   .material-button .shape:after,
   .alt-2 .shape:after {
      content: "";
      background: #fff;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(360deg);
      -webkit-transform: translate(-50%, -50%) rotate(360deg);
      -ms-transform: translate(-50%, -50%) rotate(360deg);
   }
     
   .material-button .shape:before,
   .alt-2 .shape:before {
      width: 25px;
      height: 4px;
   }
   
   .material-button .shape:after,
   .alt-2 .shape:after {
      height: 25px;
      width: 4px;
   }
   
   .material-button.active,
   .alt-2.active {
      top: 50%;
      right: 50%;
      transform: translate(50%, -50%) rotate(0deg);
      -webkit-transform: translate(50%, -50%) rotate(0deg);
      -ms-transform: translate(50%, -50%) rotate(0deg);
   }
     
   body {
      background-color: #000;
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      min-height: 100vh;
      font-family: 'Roboto', sans-serif;
   }
   
   body,
   html {
      overflow: hidden;
   }
   
   .materialContainer {
      width: 100%;
      max-width: 600px;
      position: relative;
      left: 50%;
      transform: translate(-50%, -50%);
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
   }
   
   *,
   *:after,
   *::before {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      text-decoration: none;
      list-style-type: none;
      outline: none;
   }

   select {
   position: relative;
   margin-top: 0%;
   color: #ccc;
   }
    </style>