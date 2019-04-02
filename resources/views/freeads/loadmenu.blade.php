<div class="categories-box">
	<div class="main_cat">
		<ul class="list-unstyled items-main-categories">
			@foreach ($categories as $category)
				<li>
					<a href="#Mobile Phones &Tablets" class="btn_main_cat"><img class="icon img-cover" src="https://www.khmer24.com/khmer24-reform21/template/img/categories/mobile-phones-tablets.png" /> {{$category->name}}</a>
            @if(count($category->childs))
                @include('freeads.loadsubmenu',['childs' => $category->childs])
            @endif
				</li>
			@endforeach
		</ul>
	</div>
</div>