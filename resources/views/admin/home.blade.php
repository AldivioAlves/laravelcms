@extends('adminlte::page')
@section('title','Painel')
@section('content_header')
@section('plugins.Chartjs',true)
<div class="row">
    <div class="col-md-6">
        <h1>Dashboard</h1>
    </div>
    <div class="col-md-6">
        <form method="GET">
            <select name="interval" class="float-md-right" onchange="this.form.submit()">
                <option {{$dateInterval==30?'selected="selected"':''}} value="30">Últimos 30 dias</option>
                <option {{$dateInterval==60?'selected="selected"':''}} value="60">Últimos 2 meses</option>
                <option {{$dateInterval==90?'selected="selected"':''}} value="90">Últimos 3 meses</option>
                <option {{$dateInterval==120?'selected="selected"':''}} value="120">Últimos 6 meses</option>
            </select>
        </form>
    </div>
</div>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h2>{{$visitsCount}}</h2>
                    <p>Acessos</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h2>{{$onlineCount}}</h2>
                    <p>Usuarios online</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-heart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h2>{{$pageCount}}</h2>
                    <p>Páginas</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-sticky-note"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h2>{{$userCount}}</h2>
                    <p>Usuários</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-user"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Páginas mais visitadas
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="pagePie">

                    </canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Sobre o Sistema
                    </h3>
                </div>
                <div class="card-body">
                    ....
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function () { //quando a pagina carregar
            let ctx = document.getElementById('pagePie').getContext('2d');
            window.pagePie = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [
                        {
                            data: {{$pageValues}},
                            backgroundColor: '#0000FF'
                        }
                    ],
                    labels: {!! $pageLabels !!}
                },
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    }
                }
            })
        }
    </script>
@endsection

