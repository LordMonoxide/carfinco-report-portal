@extends('layouts.full')

@section('body')
      @foreach($admins as $admin)
        <div class="content site-block">
          <h1>Reports for {{ $admin->user->email }}</h1>
          @foreach($admin->dealers as $dealer)
            <div class="context site-block">
              <h3>Reports for {{ $dealer->name }} ({{$dealer->number }})</h1>
              <ul class="reports">
                @foreach($dealer->reports as $report)
                  <li><a href="#" title=""><em>{{ (new \Carbon\Carbon($report->timestamp))->format('F Y') }}</em><span class="arw-down">&nbsp;</span></a></li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
      @endforeach
		</div>
@stop