@extends('adminlte::page')
@section('title','Páginas')
@section('content_header')
    <h1>Minhas Páginas
        <a href="{{route('pages.create')}}" class="btn btn-sm btn-success">Nova Página</a>
    </h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th width="50"> ID</th>
                <th > Título</th>
                <th width="200"> Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
                <tr>
                    <th >{{$page->id}}</th>
                    <th>{{$page->title}}</th>
                    <th>
                        <a href="#" class="btn btn-sm btn-success" target="_blank">Ver</a>
                        <a href="{{route('pages.edit',['page'=>$page->id])}}" class="btn btn-sm btn-info">Editar</a>
                            <form class="d-inline" method="POST" action="{{route('pages.destroy',['page'=>$page->id])}}"
                                  onsubmit="return confirm('Tem certeza que deseja excluir a página?')"
                            >
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>

                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $pages->links('pagination::bootstrap-4') }}
    </div>
@endsection
