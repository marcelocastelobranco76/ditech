
 
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>Bem-vindo!</p>

                    @if (Auth::user()->is_admin)
                        <p><a href="{{ url('admin/salas') }}"> Listar salas</a>
			<p><a href="{{ url('admin/salas/cadastrar') }}"> Cadastrar salas</a>
                       <hr/>
			 <p>
                            Listar <a href="{{ url('admin/reservas') }}">reservas</a>
                        </p>
			 <p>
                            Listar <a href="{{ url('admin/usuarios') }}">usuários</a>
                        </p>
                    @else
                        <p>
                            Liste  todas as <a href="{{ url('reservas') }}">reservas</a> ou <a href="{{ url('reservar') }}">reserve uma sala</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
