@extends('layout.principal')

@section('conteudo')

@if (count($errors) > 0)
<div class="alert alert-danger">
	@foreach($errors->all() as $error) 
	<ul> 
		<li>{{$error}}</li>
	</ul>
	@endforeach
</div>
@endif


<header>
	



	<div class="carteira-banner">
	<div ><h2 id="tituloCenter">Sistema de Estoque de Carteiras</h2></div><br>

			<form class="center" action="/login" method="post">

				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

				<div class="form-group col-sm-5 col-md-5">
					<label>E-mail</label>
					<input name="email" class="form-control" />
				</div>

				<div class="form-group col-sm-3 col-md-4">
					<label>Senha</label>
					<input type="password" name="password" class="form-control" />
				</div>	

				<div class="form-group col-sm-3 col-md-2 margem">
					<button type="submit" class="btn 
					btn-primary btn-block">Login</button>
				</div>
			</form>
		
	</div>

</header>

@stop
