{{-- \resources\views\salas\create.blade.php --}}

@extends('layouts.app')

@section('content')

        <div class="container">


            <h1>Cadastrar usuário</h1>
	        <p><a href="{{ url('admin/usuarios') }}">Listar usuarios</a>
                <!-- Se existir algum erro de cadastro vai aparecer aqui -->
                {{ HTML::ul($errors->all()) }}

                {{ Form::open(array('url' => 'admin/usuarios' , 'method' => 'POST')) }}

                <div class="form-group">

            	
            	    {{ Form::label('name', 'Nome') }}
                    {{ Form::text('name', Input::old('name'),array('getElementById' => 'name', 'class' => 'form-control', 'placeholder' => 'Informe o nome') ) }}
                  


            	    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Informe o e-mail')) }}
                 
			{{ Form::label('password', 'Senha') }}
                            {{ Form::password('password', array('class' => 'form-control')) }}

                </div>

                {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}

        </div>

@endsection
