@extends('layouts.app')
@section('content')

   <div class="materialContainer">
      <div class="box" >
         <div class="title" style="margin-bottom: 8%;">{{ __('Cadastrar Empresa') }}</div>
         
         <form method="POST" action="/empresasaction" id="formu" onclick="chamada()">
            {{ csrf_field() }}
            <div class="input">
               <div>
                  @if($errors->all())
                     <div class="alert alert-danger" role="alert" >
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        @foreach ($errors->all() as $key => $value)
                           <li style="color:red;">{{$value}}</li>
                        @endforeach  
                     </div>
                  @endif
               </div>
               <label for="cnpj" style="width: 30%; display: block; float: left;">Digite o CNPJ: </label>
               <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="00.000.000/0000-00" onfocus="javascript: retirarFormatacao(this);" onblur="javascript: formatarCampo(this);" style="width: 50%; display: block; float: left;" > 
               <div class="btn pesquisa">
                  <button class="btn btn-primary" id="pesquisar" type="submit" name="pesqui">Pesquisar</button>
               </div>
            </div>
            <div class="input">
               <input type="text" class="form-control" id="nome" name="razao_social" placeholder="Nome">
            </div>
            <div class="input">
               <input type="text" class="form-control" id="logradouro" name="endereco" placeholder="Endereço" >
            </div>
            <div class="input">
               <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000" >
            </div>
            <div class="button login">
               <button class="btn btn-primary" type="submit">
                  {{ __('Cadastrar') }}
               </button>
            </div>
            <div class="button login">
               @if (Route::has('register'))
                  <button class="btn btn-primary" type="submit" >
                     <a href="{{ route('register') }}" style="display: block; width: 215px; height: 65px; text-decoration:none;">{{ __('Cancelar') }}</a>
                  </button>
               @endif
            </div>
         </form>
      </div>
   </div>
@endsection

<script type="text/javascript">
   function chamada() {
      $(document).ready(function(){
        $('#pesquisar').on('click', function(e) {
            e.preventDefault();
            var cnpj = $('#cnpj').val().replace(/[^0-9]/g, '');
            if(cnpj.length >= 14) {
               $.ajax({
                  url:'https://www.receitaws.com.br/v1/cnpj/' + cnpj,
                  method:'GET',
                  dataType: 'jsonp', 
                  complete: function(xhr){
                     response = xhr.responseJSON;
                     if(response.status == 'OK') {
                        $('#nome').val(response.nome);
                        $('#logradouro').val(response.logradouro);
                        $('#telefone').val(response.telefone);
                     } else {
                        console.log(response.message); 
                     }
                  }
               });
            }
         });
      });
   }  

   function formatarCampo(campoTexto) {
      campoTexto.value = mascaraCnpj(campoTexto.value);
   }

  function retirarFormatacao(campoTexto) {
      campoTexto.value = campoTexto.value.replace(/(\.|\/|\-)/g,"");
   }

  function mascaraCnpj(valor) {
      return valor.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g,"\$1.\$2.\$3\/\$4\-\$5");
   }
</script>

<style scoped>
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
      display: block;
      top: 10px;
      left: 0;
      z-index: 2;
      line-height: 60px;
   }

   .form-control {
      color:darkgray !important;
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
   
   .btn.pesquisa {
      left: 0%;
      background-color: transparent;
      border: 3px solid rgba(0, 0, 0, 0.1);
      font-weight: 900;
      font-size: 18px;
      color: rgba(0, 0, 0, 0.2);
      background-color: #fff;
      margin-top: 2%;
      margin-left: 1%;
   }

   .btn.pesquisa:hover {
      color: #0d0758 !important;
      border-color: #0d0758;
   }

   #pesquisar {
      display: contents;
      color: rgba(0, 0, 0, 0.4);
   }

   #pesquisar:hover {
      color: #0d0758 !important;
      border-color: #0d0758;
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