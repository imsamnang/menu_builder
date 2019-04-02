@extends('layouts.khmer24_layout')

@push('css')
	
@endpush

@section('content')
	@include('freeads.sidebar')
@endsection

@push('js')
	<script>
		$(document).ready(function(e) {
			function do_setMaxH() {
				if($(document).width()>=720) {
					$('.sub_cat ul').css('max-height', $('.main_cat ul').height());
				} else {
					$('.sub_cat ul').removeAttr('style');
				}
			}
			do_setMaxH();
			$(window).resize(function() {
				do_setMaxH();
			})			
	   	$('body').on('click mouseover', '.btn_main_cat', function(event){
				event.preventDefault();
				$('.main_cat li').removeClass('active');
				$(this).parent().addClass('active');
			});

	    });
	</script>
@endpush