<div class="sub_cat">
	<ul class="list-unstyled items-sub-categories">
		@foreach($childs as $child)
			<li>
				<input type="hidden" name="sub_cate_id" value="{{$child->id}}">
				<a href="{{route('post.create',$child->id)}}">&raquo; {{$child->name}}</a>
				@if(count($child->childs))
					@include('freeads.loadsubmenu',['childs' => $child->childs])
				@endif
			</li>
		@endforeach
	</ul>
</div>