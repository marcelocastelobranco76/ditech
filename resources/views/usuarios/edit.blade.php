{{-- \resources\views\usuarios\edit.blade.php --}}

@extends('layouts.app')

@section('content')

            <div class="container">

                <h1>Editar usuários</h1>

                    <!-- Se existir algum erro de ediçao vai aparecer aqui -->                    
                    {{ HTML::ul($errors->all()) }}

                    {{ Form::model($usuario, array('url' => array('/admin/usuarios', $usuario[0]->id), 'method' => 'PATCH')) }}

                        <div class="form-group">

                    
                    	   {{ Form::label('name', 'Nome') }}
                           {{ Form::text('name', $usuario[0]->name, array('class' => 'form-control')) }}
                    	
                    	   {{ Form::label('email', 'E-mail') }}
                           {{ Form::text('email', $usuario[0]->email, array('class' => 'form-control')) }}
				
			  {{ Form::label('password', 'Senha') }}
                          {{ Form::password('password', array('class' => 'form-control')) }}
                    
                        </div>

                    {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}

                </div>

@endsection
