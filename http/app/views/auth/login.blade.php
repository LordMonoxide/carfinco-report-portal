@extends('layouts.simple')

@section('body')
			<div class="content site-block">
				<h1>Login to your account</h1>
        
        {{ Form::open(['route' => 'auth.login', 'method' => 'POST', 'id' => 'access_login', 'name' => 'access_login']) }}
					<fieldset>
						<div>
              {{ Form::label('email', 'Email Address') }}
              {{ Form::email('email', Input::old('email'), ['placeholder' => 'Email Address', 'required' => 'required', 'autofocus' => 'autofocus', 'class' => 'required email']) }}
              
              @foreach($errors->get('email') as $message)
                {{ $message }}
              @endforeach
						</div>
						<div>
              {{ Form::label('password', 'Password') }}
              {{ Form::password('password', ['placeholder' => 'Password', 'required' => 'required', 'class' => 'required']) }}
              
              @foreach($errors->get('password') as $message)
                {{ $message }}
              @endforeach
						</div>
					</fieldset>
					
					<div class="actions">
            {{ Form::submit('Login', ['class' => 'btn']) }}
					</div>
        {{ Form::close() }}
				
        <div class="alt-actions site-block">
					<p>Something else &gt;</p>
					<a href="forgot" title="Forgot Password?">Forgot Password?</a>
				</div>
			</div>
		</div>
    
		<script type="text/javascript">
		$(document).ready(function() {
			$('#access_login').validate();			
		});
		</script>
@stop