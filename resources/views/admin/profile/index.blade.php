@extends('adminlte::page')
@section('title','Meu Perfil')
@section('content_header')
    <h1>Meu Perfil</h1>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5><i class="icon fas fa-ban"></i>Ocorreu um Erro!</h5>
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-info">
                <h5>{{session('warning')}}</h5>
        </div>
    @endif

    <form action="{{route('profile.save',[])}}" class="form-horizontal" method="post">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 control-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror "
                               value="{{$user->name}}"
                               placeholder="Digite seu nome completo"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror "
                               value="{{$user->email}}"
                               placeholder="digite seu email"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label">Nova Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror "
                               placeholder="Digite sua senha"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label">Confirmação da Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Redigite sua senha para confirmação"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Atualizar" class="btn btn-success"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
