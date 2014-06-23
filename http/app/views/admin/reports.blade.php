@extends('layouts.full')

@section('body')
      @foreach($dealers as $dealer)
        <div class="content site-block">
          <h1>Reports for {{ $dealer->name }} ({{ $dealer->number }})</h1>
          <ul class="reports">
            @foreach($dealer->reports as $report)
              <li><a href="#" title=""><em>{{ (new \Carbon\Carbon($report->timestamp))->format('F Y') }}</em><span class="arw-down">&nbsp;</span></a></li>
            @endforeach
          </ul>
        </div>
      @endforeach
		</div>
@stop