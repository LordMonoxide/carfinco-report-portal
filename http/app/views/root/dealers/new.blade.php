@extends('layouts.full')

@section('body')
      <div class="content site-block">
				<h1>Add Dealer</h1>
        
        {{ Form::open(['route' => 'root.dealers.add', 'method' => 'PUT', 'id' => 'update_profile', 'name' => 'update_profile']) }}
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
						<div>
              {{ Form::label('email', 'Email Address') }}
              {{ Form::email('email', Input::old('email'), ['placeholder' => 'Email Address', 'required' => 'required', 'class' => 'required']) }}
              
              @foreach($errors->get('email') as $message)
                {{ $message }}
              @endforeach
						</div>
						<div>
              {{ Form::label('number', 'Dealership Number') }}
              {{ Form::text ('number', Input::old('number'), ['placeholder' => 'Dealership Number', 'required' => 'required', 'class' => 'required']) }}
              
              @foreach($errors->get('email') as $message)
                {{ $message }}
              @endforeach
						</div>
            
            <div>
              {{ Form::label('admin', 'Admin') }}
              {{ Form::select('admin', $admins, Input::old('admin'), ['required', 'class' => 'required']) }}
              
              @foreach($errors->get('admin') as $message)
                {{ $message }}
              @endforeach
            </div>
            
						<div id="change_password">
							<div>
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['required', 'placeholder' => 'Password', 'class' => 'required']) }}
                
                @foreach($errors->get('password') as $message)
                  {{ $message }}
                @endforeach
							</div>
							<div>
                {{ Form::label('password_confirmation', 'Confirm Password') }}
                {{ Form::password('password_confirmation', ['required', 'placeholder' => 'Confirm Password', 'equalto' => '#password', 'class' => 'required']) }}
                
                @foreach($errors->get('password_confirmation') as $message)
                  {{ $message }}
                @endforeach
							</div>
						</div>
					</fieldset>
          
          <div class="actions">
            {{ Form::submit('Add Dealer', ['class' => 'btn']) }}
            {{ HTML::linkRoute('root.dealers.view', 'Cancel') }}
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