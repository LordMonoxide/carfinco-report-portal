@extends('layouts.full')

@section('body')
      <div class="content site-block">
				<h1>Add Admin</h1>
        
        {{ Form::open(['route' => 'root.admins.add', 'method' => 'PUT', 'id' => 'update_profile', 'name' => 'update_profile']) }}
					<fieldset>
					<fieldset>
						<div>
              {{ Form::label('email', 'Email Address') }}
              {{ Form::email('email', Input::old('email'), ['placeholder' => 'Email Address', 'required' => 'required', 'class' => 'required']) }}
              
              @foreach($errors->get('email') as $message)
                {{ $message }}
              @endforeach
						</div>
						<div id="change_password">
							<div>
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'required']) }}
                
                @foreach($errors->get('password') as $message)
                  {{ $message }}
                @endforeach
							</div>
							<div>
                {{ Form::label('password_confirmation', 'Confirm Password') }}
                {{ Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'equalto' => '#password', 'class' => 'required']) }}
                
                @foreach($errors->get('password_confirmation') as $message)
                  {{ $message }}
                @endforeach
							</div>
						</div>
					</fieldset>
          
          <div class="actions">
            {{ Form::submit('Add Admin', ['class' => 'btn']) }}
            {{ HTML::linkRoute('root.admins.view', 'Cancel') }}
					</div>
				{{ Form::close() }}
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function() {
			$('#update_profile').validate();
			
			$('[name="is_change"]').prop('checked', '');
			//$('#change_password div').hide();
			//$('#change_password div input').attr('disabled', 'disabled');
			
			$('[name="is_change"]').click(function() {
				console.log( $(this).prop('checked')  )
				if ( $(this).prop('checked') == true ) {
					$('#change_password div').slideDown();
					$('#change_password div input').removeAttr('disabled');
				} else {
					$('#change_password div').slideUp();
					$('#change_password div input').attr('disabled', 'disabled');
				}
			});
		});
		</script>
@stop