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
        {!! Form::select('id', $salas, null,['class' => 'form-control', 'placeholder' => 'Selecione uma das salas']) !!}

         {{ Form::label('data', 'Data') }}
         {{ Form::text('data', Input::old('data'),array('getElementById' => 'data', 'class' => 'form-control', 'placeholder' => 'dd/mm/aaa') ) }}
	
	{{ Form::label('hora_inicio', 'Hora início') }}
        <select id="hora_inicio" name="hora_inicio" class="form-control">
  	    <option>Selecione uma hora inicial</option>
	    @for ($i = 8; $i <= 18; $i++)
		@if( $i % 2 == 0 )
		    <option value="{{ $i }}:00">{{ $i }}:00</option>
		@endif
	    @endfor               
	</select>

	
	{{ Form::label('hora_fim', 'Hora fim') }}
	 <select id="hora_fim" name="hora_fim" class="form-control">
  	    <option>Selecione uma hora final</option>
	    @for ($j = 9; $j <= 19; $j++)
	   	 @if( $j % 2 != 0 )	
	    		<option value="{{ $j }}:00">{{ $j }}:00</option>
		 @endif
	    @endfor               
	</select>
        {{ Form::label('descricao', 'Descrição') }}
        {{ Form::text('descricao', Input::old('descricao'), array('class' => 'form-control', 'placeholder' => 'Informe a descrição')) }}
                

    </div>

    

    {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>

@endsection
