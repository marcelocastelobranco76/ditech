{{-- \resources\views\reservas\create.blade.php --}}
@extends('layouts.app')

@section('content')

<div class="container">


<h1>Reservar sala</h1>

<!-- se existir algum erro de cadastro, vai aparecer aqui -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'reservas')) }}

    <div class="form-group">

	{{ Form::label('id', 'Salas disponíveis para reserva') }}
        {!! Form::select('id', $salas, null, ['class' => 'form-control']) !!}

         {{ Form::label('data', 'Data') }}
         {{ Form::text('data', Input::old('data'),array('getElementById' => 'data', 'class' => 'form-control', 'placeholder' => 'dd/mm/aaa') ) }}
	
	{{ Form::label('hora_inicio', 'Hora início') }}
        {{ Form::select('hora_inicio', 
	array('12:00' => '12:00', 
       '14:00' => '14:00',
       '16:00' => '16:00',
       '18:00' => '18:00',  		
       '20:00' => '20:00',
       '22:00' => '22:00'		
	), null, array('class' => 'form-control'))}}

	
	{{ Form::label('hora_fim', 'Hora fim') }}
	{{Form::select('hora_fim', array('13:00' => '13:00', 
       '15:00' => '15:00',
       '17:00' => '17:00',
       '19:00' => '19:00',  		
       '21:00' => '21:00',
       '23:00' => '23:00'), null, array('class' => 'form-control'))}}

        {{ Form::label('descricao', 'Descrição') }}
        {{ Form::text('descricao', Input::old('descricao'), array('class' => 'form-control', 'placeholder' => 'Informe a descrição')) }}
                

    </div>

    

    {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>

@endsection
