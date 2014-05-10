@extends('layouts.full')

@section('body')
      <div id="admins" class="content site-block">
				<h1>Admins {{ HTML::linkAction('root.admins.new', 'Add Admin', null, ['class' => 'btn']) }}</h1>
				
				<ul class="admins">
          @foreach($admins as $admin)
            <li><a href="{{ URL::action('root.admins.edit', $admin->id) }}" title=""><span>{{ $admin->user->email }}</span></a></li>
          @endforeach
				</ul>
        
				<form class="search">
					<fieldset>
						<label>Search by keyword</label>
						<input type="text" name="" />
						<button type="submit" class="btn">Search</button>
					</fieldset>
				</form>
			</div>
		</div>
@stop