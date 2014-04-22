@extends('layouts.full')

@section('body')
			<div class="content site-block">
				<h1>Your Profile</h1>
        
				{{ Form::model($user, ['route' => ['profile.update', $user->id], 'method' => 'POST', 'id' => 'update_profile', 'name' => 'update_profile']) }}
					<fieldset>
						<div>
              {{ Form::label('name_first', 'First Name') }}
              {{ Form::text ('name_first', Input::old('name_first'), ['placeholder' => 'First Name', 'required' => 'required', 'autofocus' => 'autofocus', 'class' => 'required']) }}
              
              @foreach($errors->get('name_first') as $message)
                {{ $message }}
              @endforeach
						</div>
						<div>
              {{ Form::label('name_last', 'Last Name') }}
              {{ Form::text ('name_last', Input::old('name_last'), ['placeholder' => 'Last Name', 'required' => 'required', 'class' => 'required']) }}
              
              @foreach($errors->get('name_last') as $message)
                {{ $message }}
              @endforeach
						</div>
						<div>
              {{ Form::label('phone', 'Phone Number') }}
              {{ Form::tel  ('phone', Input::old('phone'), ['placeholder' => 'Phone Number', 'required' => 'required', 'class' => 'required']) }}
              
              @foreach($errors->get('phone') as $message)
                {{ $message }}
              @endforeach
						</div>
					</fieldset>
          
					<fieldset>
						<ul class="info">
							<li>Email Address: <strong>{{ $user->email }}</strong></li>
							<li>Dealership Number: <strong>A12345BH-002 **TODO**</strong></li>
						</ul>
            
						<div id="change_password">
							<label for="is_change">
                {{ Form::checkbox('is_change', null, Input::old('is_change'), ['id' => 'is_change']) }} Change Password?
              </label>
							
              <div>
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'required']) }}
							</div>
							<div>
                {{ Form::label('password_confirm', 'Confirm Password') }}
                {{ Form::password('password_confirm', ['placeholder' => 'Confirm Password', 'equalto' => '#password', 'class' => 'required']) }}
							</div>
						</div>
					</fieldset>
          
					<div class="actions">
            {{ Form::submit('Update', ['class' => 'btn']) }}
						<a href="#" class="cancel">Cancel</a>
					</div>
				{{ Form::close() }}
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function() {
			$('#update_profile').validate();
			
			$('[name="is_change"]').prop('checked', '');
			$('#change_password div').hide();
			$('#change_password div input').attr('disabled', 'disabled');
			
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