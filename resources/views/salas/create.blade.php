{{-- \resources\views\salas\create.blade.php --}}

@extends('layouts.app')

@section('content')

        <div class="container">


            <h1>Cadastrar sala</h1>
	        <p><a href="{{ url('admin/salas') }}">Listar salas</a>
                <!-- Se existir algum erro de cadastro vai aparecer aqui -->
                {{ HTML::ul($errors->all()) }}

                {{ Form::open(array('url' => 'admin/salas' , 'method' => 'POST')) }}

                <div class="form-group">

            	
            	    {{ Form::label('nome', 'Nome') }}
                    {{ Form::text('nome', Input::old('nome'),array('getElementById' => 'nome', 'class' => 'form-control', 'placeholder' => 'Informe o nome') ) }}
                  


            	    {{ Form::label('descricao', 'Descrição') }}
                    {{ Form::text('descricao', Input::old('descricao'), array('class' => 'form-control', 'placeholder' => 'Informe a descrição')) }}
                

                </div>

                {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}

        </div>

@endsection
