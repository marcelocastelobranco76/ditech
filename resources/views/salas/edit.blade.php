{{-- \resources\views\salas\edit.blade.php --}}

@extends('layouts.app')

@section('content')

            <div class="container">

                <h1>Editar salas</h1>

                    <!-- Se existir algum erro de ediçao vai aparecer aqui -->                    
                    {{ HTML::ul($errors->all()) }}

                    {{ Form::model($sala, array('url' => array('/admin/salas', $sala[0]->id), 'method' => 'PATCH')) }}

                        <div class="form-group">

                    
                    	   {{ Form::label('nome', 'Nome') }}
                           {{ Form::text('nome', $sala[0]->nome, array('class' => 'form-control')) }}
                    	
                    	   {{ Form::label('descricao', 'Descrição') }}
                           {{ Form::text('descricao', $sala[0]->descricao, array('class' => 'form-control')) }}

                    
                        </div>

                    {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}

                </div>

@endsection
