@extends('layouts.full')

@section('body')
      <div id="dealers" class="content site-block">
				<h1>Dealers {{ HTML::linkAction('admin.dealers.new', 'Add Dealer', null, ['class' => 'btn']) }}</h1>
				
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Number</th>
              <th>Email</th>
              <th>Phone</th>
              <th></th>
            </tr>
          </thead>
          
          <tbody>
            <?php $n = 1; ?>
            @foreach($dealers as $dealer)
              <tr>
                <td>{{ $n++ }}</td>
                <td>{{ $dealer->name }}</td>
                <td>{{ $dealer->number }}</td>
                <td>{{ $dealer->user->email }}</td>
                <td>{{ $dealer->phone }}</td>
                <td>
                  {{ Form::open(['route' => ['admin.dealers.edit', $dealer->id], 'method' => 'get']) }}
                  {{ Form::submit('Edit') }}
                  {{ Form::close() }}
                  {{ Form::open(['route' => ['admin.dealers.delete', $dealer->id], 'method' => 'delete']) }}
                  {{ Form::submit('Delete') }}
                  {{ Form::close() }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
			</div>
		</div>
@stop