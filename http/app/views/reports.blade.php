@extends('layouts.full')

@section('body')
			<div class="content site-block">
				<h1>Reports</h1>
				<ul class="reports">
          @foreach($monthly as $month)
            <li{{ $month['data'] !== null ? ' class="current"' : '' }}><a href="#" title=""><em>{{ $month['name'] }} 2014</em><span class="arw-down">&nbsp;</span></a></li>
          @endforeach
				</ul>
				<ul class="archives">
					<li class="current"><a href="#" title="2014">2014</a></li>
					<li><a href="#" title="2013">2013</a></li>
					<li><a href="#" title="2012">2012</a></li>
					<li><a href="#" title="2011">2011</a></li>
					<li><a href="#" title="2010">2010</a></li>
				</ul>
			</div>
		</div>
@stop