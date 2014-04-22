@extends('layouts.full')

@section('body')
      <div id="help" class="content site-block">
				<h1>Help</h1>
				<article>
					<h2><em>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio?</em><span class="arw-down">&nbsp;</span></h2>
					<div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.</p>
						<p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem. </p>
					</div>
				</article>
				<article>
					<h2><em>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio?</em><span class="arw-down">&nbsp;</span></h2>
					<div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.</p>
						<p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem. </p>
					</div>
				</article>
				<article>
					<h2><em>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio?</em><span class="arw-down">&nbsp;</span></h2>
					<div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.</p>
						<p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem. </p>
					</div>
				</article>
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function() {
			$('article').each(function() {
				var article = $(this);
				var h2 = article.find('h2');
				var content = h2.next('div');
				content.hide();
				h2.click(function() {
					if ( !h2.hasClass('current') ) {
						h2.addClass('current');
						h2.find('.arw-down').attr('class', 'arw-up');
						content.slideDown();
					} else {
						h2.removeClass('current');
						h2.find('.arw-up').attr('class', 'arw-down');
						content.slideUp();
					}
					
				});
			});
		});
		</script>
@stop