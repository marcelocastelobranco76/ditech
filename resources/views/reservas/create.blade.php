{{-- \resources\views\reservas\create.blade.php --}}
@extends('layouts.app')

@section('content')

<div class="container">


<h1>Reservar sala</h1>

<!-- se existir algum erro de cadastro, vai aparecer aqui -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'reservas','name' => 'cadastroReserva', 'id' => 'cadastroReserva')) }}

    <div class="form-group">

	{{ Form::label('id', 'Salas disponíveis para reserva') }}
        {!! Form::select('id', $salas, null,['id' => 'sala','class' => 'form-control', 'placeholder' => 'Selecione uma das salas']) !!}

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


		<div style="max-height: 150px;overflow-y: scroll;border:1px">
		  
			<h1>Salas reservadas:</h1>
			<?php 
			$reservas = DB::table('reservas')
       ->join('users', 'users.id', '=', 'reservas.user_id')
       ->join('salas', 'salas.id', '=', 'reservas.sala_id')
       ->select('salas.nome', 'users.name','reservas.user_id','reservas.id', 'reservas.descricao', 'reservas.hora_inicio', 'reservas.hora_fim');
			 $reservas = $reservas->get();
			?>
			 @foreach($reservas as $reserva)
			   <?php $dataReserva =  DateTime::createFromFormat("Y-m-d H:i:s",$reserva->hora_inicio)->format("m/d/Y");?>
  			   <?php $horaInicio =  DateTime::createFromFormat("Y-m-d H:i:s",$reserva->hora_inicio)->format("H:i:s");?>
	   	           <?php $horaFim =  DateTime::createFromFormat("Y-m-d H:i:s",$reserva->hora_fim)->format("H:i:s");?>
				
				<br/>
			  	A sala {{ $reserva->nome}} está reservada para o usuário {{$reserva->name}} para o dia {{$dataReserva}} das {{$horaInicio}} às {{$horaFim}} <br/>	

			 @endforeach
		  
		</div>

</div>

@endsection
