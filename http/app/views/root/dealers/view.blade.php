@extends('layouts.full')

@section('body')
      <div id="dealers" class="content site-block">
				<h1>Dealers {{ HTML::linkAction('root.dealers.new', 'Add Dealer', null, ['class' => 'btn']) }}</h1>
				
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Admin</th>
              <th>Number</th>
              <th>Email</th>
              <th>Phone</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          
          <tbody>
            <?php $n = 1; ?>
            @foreach($dealers as $dealer)
              <tr>
                <td>{{ $n++ }}</td>
                <td>{{ $dealer->name }}</td>
                <td>{{ $dealer->admin->user->email }}</td>
                <td>{{ $dealer->number }}</td>
                <td>{{ $dealer->user->email }}</td>
                <td>{{ $dealer->phone }}</td>
                <td>
                  {{ Form::open(['route' => ['root.dealers.edit', $dealer->id], 'method' => 'get']) }}
                  {{ Form::submit('Edit') }}
                  {{ Form::close() }}
                </td>
                <td>
                  {{ Form::open(['route' => ['root.dealers.delete', $dealer->id], 'method' => 'delete']) }}
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