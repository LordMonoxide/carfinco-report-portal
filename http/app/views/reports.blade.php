@extends('layouts.full')

@section('body')
			<div class="content site-block">
				<h1>Reports for {{ $yearNum }}</h1>
				<ul class="reports">
          @foreach($monthly as $month)
            <li{{ $month['data'] !== null ? ' class="current"' : '' }}><a href="#" title=""><em>{{ $month['name'] }} {{ $yearNum }}</em><span class="arw-down">&nbsp;</span></a></li>
          @endforeach
				</ul>
				<ul class="archives">
          <?php for($i = $yearNow; $i > $yearNow - 5; $i--) {?>
            <li{{ $i == $yearNum ? ' class="current"' : '' }}>{{ HTML::linkAction('reports', $i, $i, ['title' => $i]) }}</li>
          <?php } ?>
				</ul>
			</div>
		</div>
@stop