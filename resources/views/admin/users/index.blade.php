@extends('adminlte::page')
@section('title','Usuários')
@section('content_header')
    <h1>Meus Usuários
        <a href="{{route('users.create')}}" class="btn btn-sm btn-success">Novo Usuário</a>
    </h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th> ID</th>
                <th> Nome</th>
                <th> Email</th>
                <th> Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th>{{$user->id}}</th>
                    <th>{{$user->name}}</th>
                    <th>{{$user->email}}</th>
                    <th>
                        <a href="{{route('users.edit',['user'=>$user->id])}}" class="btn btn-sm btn-info">Editar</a>

                        @if($loggedId!==intval($user->id))
                            <form class="d-inline" method="POST" action="{{route('users.destroy',['user'=>$user->id])}}"
                                  onsubmit="return confirm('Tem certeza que deseja excluir o usuário?')"
                            >
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        @endif
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection
