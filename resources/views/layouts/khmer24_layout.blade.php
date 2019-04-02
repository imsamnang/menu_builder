
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}">
	<link href="https://fonts.googleapis.com/css?family=Hanuman" rel="stylesheet">
	<title>Select a Category</title>
	<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('assets/js/main.js')}}"></script>
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="https://unpkg.com/ionicons@4.3.0/dist/css/ionicons.min.css">
	<link rel="stylesheet" href="{{asset('assets/css/post.css')}}">
	<script src="{{asset('assets/js/plupload.full.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.chained.js')}}"></script>
	<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>	
	<style type="text/css">
		body {
			min-width: 1090px;
		}
	</style>
	@stack('css')
</head>
<body>

	<header id="header" class="bg-white border-bottom">
		<div class="my-container header-content">
			<nav class="navbar row">
				<a href="https://www.khmer24.com/en/" class="navbar-brand"><img src="https://www.khmer24.com/khmer24-reform21/template/img/khmer24.gif" alt="Khmer24"></a>
				<ul class="nav mr-auto left-nav">
					<li class="nav-item">
						<a class="nav-link disabled btn-change-lang" href="https://www.khmer24.com/km/post.html"><span class="icon khmer-flage"></span></a>
					</li>
				</ul>
				<ul class="nav nav-pills justify-content-end right-nav">
					<li class="nav-item item-wide-screen">
						<a class="nav-link" href="https://www.khmer24.com/en/login">Log in</a>
					</li>
					<li class="nav-item item-wide-screen">
						<sapn class="nav-link disabled pl-0 pr-0">Or</sapn>
					</li>
					<li class="nav-item item-wide-screen">
						<a class="nav-link" href="https://www.khmer24.com/en/register">Register</a>
					</li>
					<li class="nav-item item-small-screen">
						<a class="nav-link" href="https://www.khmer24.com/en/register"><span class="icon icon-user2"></span></a>
					</li>
					<li class="nav-item ml-2">
						<a class="nav-link btn-post btn-warning long-text" href="https://www.khmer24.com/en/post">POST FREE AD</a>
						<a class="nav-link btn-post btn-warning short-text" href="https://www.khmer24.com/en/post">POST</a>
					</li>
				</ul>
			</nav>
			<div id="header-search">
				<form class="form-inline form-mini-search p-0 pb-2 mr-auto" action="https://www.khmer24.com/en/search" method="get">
					<input class="form-control col-12 pr-4 input-keyword" type="search" placeholder="What are you looking for..." aria-label="What are you looking for..." value="" name="q">
					<select name="category" class="form-control select-category">
						<option value="">All Category</option>
						<option value="mobile-phones-tablets" class="main">Phones & Tablets</option>
						<option value="phones-tablets" class="child">Phones, Tablets</option>
						<option value="smart-watches" class="child">Smart Watches</option>
						<option value="phone-accessories" class="child">Phone Accessories</option>
						<option value="phone-numbers" class="child">Phone Numbers</option>
						<option value="computer-and-accessories" class="main">Computers & Accessories</option>
						<option value="computers" class="child">Computers</option>
						<option value="computer-accessories" class="child">Computer accessories</option>
						<option value="softwares" class="child">Softwares</option>
						<option value="electronics-appliances" class="main">Electronics & Appliances</option>
						<option value="consumer-electronics" class="child">Consumer Electronics</option>
						<option value="security-camera" class="child">Security Camera</option>
						<option value="cameras-camcorders" class="child">Cameras, camcorders</option>
						<option value="tvs-videos-and-audios" class="child">TVs, Videos and Audios</option>
						<option value="home-appliances" class="child">Home appliances </option>
						<option value="video-games-consoles-toys" class="child">Video games, consoles, toys </option>
						<option value="cars-and-vehicles" class="main">Cars and Vehicles</option>
						<option value="cars-for-sale" class="child">Cars for Sale</option>
						<option value="bicycles" class="child">Bicycles</option>
						<option value="motorcycles-for-sale" class="child">Motorcycles for Sale</option>
						<option value="vehicles-for-rent" class="child"> Vehicles for Rent</option>
						<option value="car-maintenance-repair" class="child">Car Maintenance & Repair</option>
						<option value="lorries-vans" class="child">Lorries & Vans</option>
						<option value="financing-insurance" class="child">Financing & Insurance</option>
						<option value="car-parts-accessories" class="child">Car Parts & Accessories</option>
						<option value="others-vihicles" class="child">Others</option>
						<option value="property-housing-rentals" class="main">House & Lands</option>
						<option value="house-for-sale" class="child">House for Sale</option>
						<option value="house-for-rent" class="child">House for Rent</option>
						<option value="apartment-for-sale" class="child">Apartment for Sale</option>
						<option value="apartment-for-rent" class="child">Apartment for Rent</option>
						<option value="landed-properties-for-sale" class="child">Land for Sale</option>
						<option value="landed-properties-for-rent" class="child">Landed Properties for Rent</option>
						<option value="commercial-properties-for-sale" class="child">Commercial for Sale</option>
						<option value="commercial-properties-for-rent" class="child">Commercial for Rent</option>
						<option value="room-for-rent" class="child">Room for Rent</option>
						<option value="properties-wanted" class="child">Properties Wanted</option>
						<option value="agent-services" class="child">Agent Services</option>
						<option value="others-properties" class="child">Others</option>
						<option value="jobs" class="main">Jobs</option>
						<option value="jobs-accounting" class="child">Accounting</option>
						<option value="jobs-administration" class="child">Administration</option>
						<option value="jobs-architecture-engineering" class="child">Architecture/Engineering</option>
						<option value="jobs-assistant-secretary" class="child">Assistant/Secretary</option>
						<option value="jobs-audit-taxation" class="child">Audit/Taxation</option>
						<option value="jobs-banking-insurance" class="child">Banking/Insurance</option>
						<option value="jobs-cashier-receptionist" class="child">Cashier/Receptionist</option>
						<option value="jobs-catering-restaurant" class="child">Catering/Restaurant</option>
						<option value="jobs-cleaner-maid" class="child">Cleaner/Maid</option>
						<option value="jobs-consultancy" class="child">Consultancy</option>
						<option value="jobs-customer-service" class="child">Customer Service</option>
						<option value="jobs-design" class="child">Design</option>
						<option value="jobs-education-training" class="child">Education/Training</option>
						<option value="jobs-finance" class="child">Finance</option>
						<option value="jobs-freight-shipping-delivery-warehouse" class="child">Freight/Shipping /Delivery/Warehouse</option>
						<option value="jobs-hotel-hospitality" class="child">Hotel/Hospitality</option>
						<option value="jobs-human-resource" class="child">Human Resource</option>
						<option value="jobs-information-technology" class="child">Information Technology</option>
						<option value="jobs-lawyer-legal-service" class="child">Lawyer/Legal Service</option>
						<option value="jobs-management" class="child">Management</option>
						<option value="jobs-manufacturing" class="child">Manufacturing</option>
						<option value="jobs-marketing" class="child">Marketing</option>
						 <option value="jobs-media-advertising" class="child">Media/Advertising</option>
						<option value="jobs-medical-health-nursing" class="child">Medical/Health/Nursing</option>
						<option value="jobs-merchandising-purchasing" class="child">Merchandising/Purchasing</option>
						<option value="jobs-operations" class="child">Operations</option>
						<option value="jobs-project-management" class="child">Project Management</option>
						<option value="jobs-quality-control" class="child">Quality Control</option>
						<option value="jobs-resort-casino" class="child">Resort/Casino</option>
						<option value="jobs-sales" class="child">Sales</option>
						<option value="jobs-security-driver" class="child">Security/Driver</option>
						<option value="jobs-technician" class="child">Technician</option>
						<option value="jobs-telecommunication" class="child">Telecommunication</option>
						<option value="jobs-translation-interpretation" class="child">Translation/Interpretation</option>
						<option value="jobs-travel-agent-ticket-sales" class="child">Travel Agent/Ticket Sales</option>
						<option value="jobs-others" class="child">Others</option>
						<option value="services" class="main">Services</option>
						<option value="accounting" class="child">Accounting</option>
						<option value="automotive" class="child">Automotive</option>
						<option value="advertising-media" class="child">Advertising & Media</option>
						<option value="bridal-services" class="child">Bridal Services</option>
						<option value="cleaning-maid-services" class="child">Cleaning & Maid Services</option>
						<option value="construction-arch.-interiors" class="child">Construction, Arch. & Interiors</option>
						<option value="education-training" class="child">Education & Training</option>
						<option value="engineering" class="child">Engineering</option>
						<option value="insurance" class="child">Insurance</option>
						<option value="massage-spa" class="child">Massage & Spa</option>
						<option value="hospitality-travel-tourism" class="child">Hospitality, Travel & Tourism</option>
						<option value="health-medical-pharma" class="child">Health, Medical & Pharma</option>
						<option value="it-telecom" class="child">IT & Telecom</option>
						<option value="interior-design-renovation" class="child">Interior Design & Renovation</option>
						<option value="legal" class="child">Legal</option>
						<option value="movers-logistics" class="child">Movers & Logistics</option>
						<option value="plumbing-electrical" class="child">Plumbing & Electrical</option>
						<option value="property-real-estate" class="child">Property & Real Estate</option>
						<option value="science" class="child">Science</option>
						<option value="supply-chain-logistics" class="child">Supply Chain & Logistics</option>
						<option value="printing-publishing" class="child">Printing & Publishing</option>
						<option value="other-services" class="child">Other Services</option>
						<option value="fashion-beauty" class="main">Fashion & Beauty</option>
						<option value="jewellery-watches" class="child">Jewelry, watches </option>
						<option value="clothing-accessories" class="child">Clothing, accessories</option>
						<option value="beauty-healthcare-products" class="child">Beauty & Healthcare</option>
						<option value="books-sports-hobbies" class="main">Books, Sports & Hobbies</option>
						<option value="cds-dvds-vhs" class="child">CDS, DVDS, VHS</option>
						<option value="books" class="child">Books</option>
						<option value="sports-equipment" class="child">Sports Equipment</option>
						<option value="others-buy-sell" class="child">Others</option>
						<option value="furniture-decor" class="main">Furniture & Decor</option>
						<option value="household-items" class="child">Household Items</option>
						<option value="office-furniture" class="child">Office Furniture</option>
						<option value="home-furniture" class="child">Home Furniture</option>
						<option value="kitchenware" class="child">Kitchenware</option>
						<option value="handicrafts-paintings" class="child">Handicrafts Paintings</option>
						<option value="pets" class="main">Pets</option>
						<option value="dogs" class="child">Dogs</option>
						<option value="cats" class="child">Cats</option>
						<option value="birds" class="child">Birds</option>
						<option value="fish" class="child">Fish</option>
						<option value="pet-food" class="child">Pet Food</option>
						<option value="pet-accessories" class="child">Pet Accessories</option>
						<option value="other-pets" class="child">Other</option>
						<option value="foods" class="main">Foods</option>
						<option value="meat" class="child">Meat</option>
						<option value="seafood" class="child">Seafood</option>
						<option value="fruits" class="child">Fruits</option>
						<option value="vegetables" class="child">Vegetables</option>
						<option value="beverages" class="child">Beverages</option>
						<option value="grocery" class="child">Grocery</option>
						<option value="bread-and-bakery" class="child">Bread & Bakery</option>
						<option value="beer-and-wine" class="child">Beer & Wine</option>
						<option value="rice-and-cereal" class="child">Rice & Cereal</option>
						<option value="other-foods" class="child">Other</option>
					</select>
					<button class="btn my-0 my-sm-0" type="submit"><span class="icon ion-ios-search"></span></button>
				</form>
			</div>
		</div>
	</header>

	{{-- post form --}}
		{{-- @include('products.post') --}}
	{{-- end post form --}}
	@yield('content')

	<a href="#totop" id="totop"><i class="icon-up"></i></a>

	{{-- footer --}}
		{{-- @include('products.footer') --}}
	{{-- end footer --}}
	
	<div class="fix-feedback">
	<a href="https://www.khmer24.com/en/feedback" class="btn btn-primary btn-sm">Feedback</a>
	</div>


{{-- 	<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/main.js')}}"></script>
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/plupload.full.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.chained.js')}}"></script>
	<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script> --}}

	@stack('js')
</body>
</html>