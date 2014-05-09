@extends('layouts.full')

@section('body')
      <div id="dealers" class="content site-block">
				<h1>Dealers {{ HTML::linkAction('admin.dealers.new', 'Add Dealer', null, ['class' => 'btn']) }}</h1>
				
				<ul class="reports">
          @foreach($dealers as $dealer)
            <li><a href="{{ URL::action('admin.dealers.edit', $dealer->id) }}" title=""><em>{{ $dealer->name }}</em><span>{{ $dealer->user->email }}<br />{{ $dealer->number }}</span></a></li>
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