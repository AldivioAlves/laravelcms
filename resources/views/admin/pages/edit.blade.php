@extends('adminlte::page')
@section('title','Editar Página')
@section('content_header')
    <h1>Editar Página
    </h1>
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
    <form action="{{route('pages.update',['page'=>$page->id])}}" class="form-horizontal" method="post">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 control-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control @error('tile') is-invalid @enderror "
                               value="{{$page->title}}"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label">Corpo</label>
                    <div class="col-sm-10">
                        <textarea name="body" class="form-control bodyfield"
                                  value="{{$page->body}}"
                        >{{$page->body}}</textarea>
                    </div>
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

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea.bodyfield',
            height:300,
            menubar:false,
            plugins:['link','table','image','autoresize','lists'],
            toolbar:'undo redo | formatselect | bold italic backcolor| alignleft aligncenter alignright alignjustify | table | link image | bullist numlist',
            content_css:[
                '{{asset('css/content.css')}}'
            ],
            images_upload_url:'{{route('imageupload')}}',
            images_upload_credentials:true,
            convert_urls:false
        })
    </script>


@endsection
