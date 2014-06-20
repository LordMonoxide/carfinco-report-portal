@extends('layouts.full')

@section('body')
      <div id="admins" class="content site-block">
				<h1>Admins {{ HTML::linkAction('root.admins.new', 'Add Admin', null, ['class' => 'btn']) }}</h1>
				
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Email</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          
          <tbody>
            <?php $n = 1; ?>
            @foreach($admins as $admin)
              <tr>
                <td>{{ $n++ }}</td>
                <td>{{ $admin->user->email }}</td>
                <td>
                  {{ Form::open(['route' => ['root.admins.edit', $admin->id], 'method' => 'get']) }}
                  {{ Form::submit('Edit') }}
                  {{ Form::close() }}
                </td>
                <td>
                  {{ Form::open(['route' => ['root.admins.delete', $admin->id], 'method' => 'delete']) }}
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