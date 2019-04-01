@extends('layouts.khmer24_layout')

@section('content')

{{-- google map --}}
	<script type="text/javascript">
		$(document).ready(function () {
			var marker;
			var map;
			var geocoder;
			var map_loading = $('#map_loading').show();
			var x=12.5;
			var y=104.9806145;
			var z=7;
			var is_has_old_map = 0;

			if(is_has_old_map==1) {
				z=15;
			}

			function loadMap() {
				if(x && y) {
	        // Define the latitude and longitude positions
	        latitude = parseFloat(x);
	        longitude = parseFloat(y);
	        latlngPos = new google.maps.LatLng(latitude, longitude);
	        // Set up options for the Google map
	        var myOptions = {
	        	zoom: z,
	        	center: latlngPos,
	        	mapTypeId: google.maps.MapTypeId.ROADMAP,
	        	fullscreenControl: false,
	        	streetViewControl: false
	        };
	        // Define the map
	        map = new google.maps.Map(document.getElementById("map"), myOptions);
	        // geocoder = new google.maps.Geocoder;
	        // for move map
	        google.maps.event.addListener(map,'mouseout',function() {
	        	window.setTimeout(function() {
	        	},100);
	        });
	        // set maker by click
	        google.maps.event.addListener(map, 'dragend', function(e) {
	        	$('#map_lat').val(map.getCenter().lat());
	        	$('#map_lng').val(map.getCenter().lng());
	          });
	            // for move map
	        google.maps.event.addDomListener(window, "resize", function() {
	            // 3 seconds after the center of the map has changed, pan back to the marker
	            window.setTimeout(function() {
	            },100);
	        });
	          map_loading.hide();
	          is_has_old_map = 1;
	      }

	      $('<div/>').addClass('centerMarker').appendTo(map.getDiv())
	         .click(function(){
	         	var that=$(this);
	         	if(!that.data('win')){
	         		that.data('win',new google.maps.InfoWindow({content:'this is the center'}));
	         		that.data('win').bindTo('position',map,'center');
	         	}
	         	that.data('win').open(map);
	         });
	     	}

		 		loadMap();

	      if(is_has_old_map==1) {
	      	google.maps.event.addDomListener(window, 'load', loadMap);
	      }

	      $('#find_location').click(function(e){
	      	e.preventDefault();
	      	map_loading.show();

	      	var pos = {
	      		lat: x,
	      		lng: y
	      	};
	        // Try HTML5 geolocation.
	        if (navigator.geolocation) {
	        	navigator.geolocation.getCurrentPosition(function(position) {
	        		pos = {
	        			lat: position.coords.latitude,
	        			lng: position.coords.longitude
	        		};
	        		map.setCenter(pos);
	        		map.setZoom(12);
	        		map_loading.hide();
	        	}, function() {
	        		map.setCenter(pos);
	        		map.setZoom(12);
	        		map_loading.hide();
	        	});
	        } else {
	          // Browser doesn't support Geolocation
	          map.setCenter(pos);
	          map.setZoom(12);

	          map_loading.hide();
	      	}
	      });
	  });
	</script>

	<script>
	  $(document).ready(function() {
			jQuery.validator.addMethod("phone", function(value, element) {
				if((value.charAt(0)==0 && value.charAt(1)!=0) || value.length==0 ){
					return true;
				}
				return false;
			}, "Invalid phone number.");
	    // Validate
	    $("#form-post").validate({	        
	    	rules:
	    	{
	    		ad_headline:{required:true, maxlength:101},
	    		ad_text:{required:true, maxlength:10000},
	    		name:{required:true, minlength:3, maxlength:50},
	    		'phone-1':{required:true, minlength:9, maxlength:10,number: true,phone:true},
	    		'phone-2':{minlength:9, maxlength:10,number: true,phone:true},
	    		'phone-3':{minlength:9, maxlength:10,number: true,phone:true},
	    		ad_kindof:{required:true},
	    	},
	    	errorClass:"error invalid-feedback",			
	    	highlight: function(label) {
	    		$(label).addClass('error');
	    		$(label).closest('.form-group').removeClass('has-success has-feedback').addClass('has-error has-feedback')
	    		$(label).closest('.form-group').find('label.error').remove();
	    		$(label).closest('.form-group input').after('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><span id="inputError2Status" class="sr-only">(error)</span>');
	    	},

	    	success: function(label,element) {
	    		$(label).removeClass('error');
	    		$(element).removeClass('is-invalid');
	    		$(label).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
	    		$(label).closest('.form-group').find('label.error').remove();
	    		label.after('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span><span id="inputSuccess2Status" class="sr-only">(success)</span>');
	    		label.remove();
	    		$('.has-success').find('.checkbox').css('margin-bottom','0');
	    	},

	    	errorPlacement: function(error, element) {
	    		if(error.text()) {
	    			element.addClass('is-invalid');
	    			element.closest('.form-input').append(error);
	    		}
	    	},  
			// focusInvalid: false,
			invalidHandler: function(form, validator) {
				if (!validator.numberOfInvalids())
					return;

				$('html, body').animate({
					scrollTop: $(validator.errorList[0].element).offset().top
				}, 700);
			},
			submitHandler: function(form) {
					
					$("#form-post input[type='submit']").attr('disabled','disabled').val('Saving...').css({"background-color": "#dedede", "border": "none" });
					
					$.post($("#form-post").attr('action'), $("#form-post").serialize(), function(data) {
						if(data.status == 1 || data.status == '1') {
							if(data.is_logged_in == 1 || data.is_logged_in == '1') {
								window.location = 'https://www.khmer24.com/en/manage-ads.html'; 
							} else {
								$('#account-question').modal('show');
								// $.fancybox('#account-question',{autoSize : true, width: '100%', height:'100%',padding:0, margin:0, modal:true });
		              //  window.location = 'https://www.khmer24.com/en/register.html'; 
		          }
		      }else{
		      	$("#form-post input[type='submit']").removeAttr('disabled').val('Submit').removeAttr('style');
		      	alert(data.info);
		      }
		  },'json');
				}
			});		
		});
	</script>

	<div class="post_form bg-white rounded border my_content">
		<div class="header p-3">
			<h1 class="title">POST FREE AD</h1>
			<div class="step">
				<ul class="list-unstyled">
				<li class="active"><span class="text"><i>1</i> Choose a category</span></li>
				<li class="active"><span class="text"><i>2</i> Fill Description</span></li>
				</ul>
			</div>
		</div>

		<div class="post_form p-3">
			<div class="post_form">
				<form action="#" id="form-post" class="form form-horizontal" method="post" accept-charset="utf-8" novalidate="novalidate">
					<input type="hidden" name="category_id" value="{{$category->id}}">
					<input type="hidden" value="sub_cate_id" name="{{$subcategory->id}}">

					<div class="form-group">
						<label for="title" class="col control-label">Category</label>
						<div class="col-6 cat_path">
							<div class="category-selected">
								<ul class="list-unstyled list-inline">
									<li>{{$category->name}}</li>
									<li>{{$subcategory->name}}</li>
								</ul>
								<a class="btn btn-sm  btn-primary btn_change_cat" href="{{route('product.index')}}">Change</a>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="ad_headline" class="col control-label">Title <span class="red">*</span></label>
						<div class="col col-6 form-input">
						<input id="ad_headline" class="form-control" type="text" name="ad_headline" value="" required="">
						</div>
					</div>

					<div class="form-group input-ad_field">
						<label for="ad_field" class="col-sm-3 control-label">Bedroom</label>
						<div class="form-input col-sm-6 col-lg-3">
							<select id="ad_field" name="ad_field" class="form-control ">
								<option value="" data-value=""></option>
								<option value="1" data-value="1" class="empty1">1</option>
								<option value="2" data-value="2" class="empty1">2</option>
								<option value="3" data-value="3" class="empty1">3</option>
								<option value="4" data-value="4" class="empty1">4</option>
								<option value="5" data-value="5" class="empty1">5</option>
								<option value="6" data-value="6" class="empty1">6</option>
								<option value="more" data-value="more" class="empty1">More+</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="ad_text" class="col control-label">Description <span class="red">*</span></label>
						<div class="col col-8 form-input">
						<textarea name="ad_text" id="ad_text" class="required form-control" rows="10"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="ad_text" class="col control-label">Ad Photos <i class="red">*</i></label>
						<div id="plupload" class="col-8">
							<div class="row plupload_block">
								<div class="pl fleft col-12">
								<span class="drop_file_hear"></span>
									<div id="multi-upload">
									<div id="console"></div>
										<ul class="list-image list-unstyled">
											<li>
												<div id="item-1" class="item">
													<a href="javascript:;" class="btn-browse" id="browse-1">Add Image</a>
												</div>
											</li>
											<li>
												<div id="item-2" class="item">
													<a href="javascript:;" class="btn-browse" id="browse-2">Add Image</a>
												</div>
											</li>
											<li>
												<div id="item-3" class="item">
													<a href="javascript:;" class="btn-browse" id="browse-3">Add Image</a>
												</div>
											</li>
											<li>
												<div id="item-4" class="item">
													<a href="javascript:;" class="btn-browse" id="browse-4">Add Image</a>
												</div>
											</li>
											<li>
												<div id="item-5" class="item">
													<a href="javascript:;" class="btn-browse" id="browse-5">Add Image</a>
												</div>
											</li>
											<li>
												<div id="item-6" class="item">
													<a href="javascript:;" class="btn-browse" id="browse-6">Add Image</a>
												</div>
											</li>
											<li>
												<div id="item-7" class="item">
													<a href="javascript:;" class="btn-browse" id="browse-7">Add Image</a>
												</div>
											</li>
											<li>
												<div id="item-8" class="item">
													<a href="javascript:;" class="btn-browse" id="browse-8">Add Image</a>
												</div>
											</li>
										</ul>
										<div class="drop_box" id="drop-image">
											<span class="image_placeholder"></span>
											<p>Drop your photo hear.</p>
										</div>
										<div class="total_status">
											<span class="current_uploads" id="current_uploads">0</span> of 
											<span class="total">8</span>
										</div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
							<div style="display:none;">
								<input type="hidden" id="count" value="1">
								<input type="hidden" id="csrf" value="91a9cde65070e99aee0bf5c0f01ff0ac">
								<input type="hidden" id="browser" value="">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="col control-label">Name <span class="red">*</span></label>
						<div class="col col-lg-4 form-input">
						<input id="name" class="form-control" type="text" name="name" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="phone" class="col control-label">Phone <span class="red">*</span></label>
						<div class="col col-lg-4 phone">
							<div class="phone-1 form-input">
								<input type="tel" name="phone-1" value="" id="phone-1" class="form-control number" maxlength="10" placeholder="Tel 1">
								<a href="javascript:void(0)" class="add_phone" data-id="add"><i class="icon-plus-full"></i></a>
							</div>
							<div class="phone-2 form-input  d-none">
								<input type="tel" name="phone-2" value="" id="phone-2" class="form-control number" maxlength="10" placeholder="Tel 2">
								<a href="javascript:void(0)" class="delete_phone" data-id="phone-2"><i class="icon-remove"></i></a>
							</div>
							<div class="phone-3 form-input d-none">
								<input type="tel" name="phone-3" value="" id="phone-3" class="form-control number" maxlength="10" placeholder="Tel 3">
								<a href="javascript:void(0)" class="delete_phone" data-id="phone-3"><i class="icon-remove"></i></a>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="col control-label">Email</label>
						<div class="col col-6 form-input">
							<input type="email" name="email" id="email" class="form-control" value="">
						</div>
					</div>

					<div class="locations_box">

						<div class="controls">

							<div class="form-group">
								<label for="province" class="col control-label">City/Province<i class="red">*</i></label>
								<div class="col col-3 form-input">
									<select data-placeholder="Select a province" id="province" name="province" class="form-control map_form" required="">
										<option value="" data-value="">Select a City/Province</option>
										<option data-en-title="Phnom Penh" value="32" data-value="phnom-penh">Phnom Penh</option>
										<option data-en-title="Preah Sihanouk" value="38" data-value="preah-sihanouk">Preah Sihanouk</option>
										<option data-en-title="Kampong Cham" value="20" data-value="kampong-cham">Kampong Cham</option>
										<option data-en-title="Siem Reap" value="37" data-value="siem-reap">Siem Reap</option>
										<option data-en-title="Battambang" value="19" data-value="battambang">Battambang</option>
										<option data-en-title="Kandal" value="25" data-value="kandal">Kandal</option>
										<option data-en-title="Banteay Meanchey" value="18" data-value="banteay-meanchey">Banteay Meanchey</option>
										<option data-en-title="Kampong Chhnang" value="21" data-value="kampong-chhnang">Kampong Chhnang</option>
										<option data-en-title="Kampong Speu" value="22" data-value="kampong-speu">Kampong Speu</option>
										<option data-en-title="Kampong Thom" value="23" data-value="kampong-thom">Kampong Thom</option>
										<option data-en-title="Kampot" value="24" data-value="kampot">Kampot</option>
										<option data-en-title="Kep" value="26" data-value="kep">Kep</option>
										<option data-en-title="Koh Kong" value="27" data-value="koh-kong">Koh Kong</option>
										<option data-en-title="Kratie" value="28" data-value="kratie">Kratie</option>
										<option data-en-title="Mondulkiri" value="29" data-value="mondulkiri">Mondulkiri</option>
										<option data-en-title="Oddar Meanchey" value="30" data-value="oddar-meanchey">Otdar Meanchey</option>
										<option data-en-title="Pailin" value="31" data-value="pailin">Pailin</option>
										<option data-en-title="Preah Vihear" value="33" data-value="preah-vihear">Preah Vihear</option><option data-en-title="Prey Veng" value="34" data-value="prey-veng">Prey Veng</option>
										<option data-en-title="Pursat" value="35" data-value="pursat">Pursat</option>
										<option data-en-title="Ratanakiri" value="36" data-value="ratanakiri">Ratanakiri</option>
										<option data-en-title="Stung Treng" value="39" data-value="stung-treng">Stung Treng</option>
										<option data-en-title="Svay Rieng" value="40" data-value="svay-rieng">Svay Rieng</option>
										<option data-en-title="Takeo" value="41" data-value="takeo">Takeo</option>
										<option data-en-title="Tboung Khmum" value="44" data-value="tboung-khmum">Tboung Khmum</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="district" class="col control-label">Khan/District <i class="red">*</i></label>
								<div class="col col-3 form-input">
								<select data-placeholder="Select a district" id="district" name="district" class="form-control map_form" required="" disabled="">
									<option value="" data-value="">Select a Khan/District</option>
								</select>
								</div>
							</div>

							<div class="form-group">
								<label for="commune" class="col control-label">Sangkat/Commune <i class="red">*</i></label>
								<div class="col col-3 form-input">
									<select data-placeholder="Select a commune" id="commune" name="commune" class="form-control map_form" required="" disabled="">
										<option value="" data-value="">Select a Sangkat/Commune</option>
									</select>
								</div>
							</div>

							<script type="text/javascript">
								$('document').ready(function(){
									$("#district").chained("#province");
									$("#commune").chained("#district");	               						
								});
							</script>

							<div class="form-group">
								<label for="address" class="col control-label">Location Details<i class="red">*</i></label>
								<div class="col col-8 form-input">
								<textarea name="address" id="address" class="form-control" required=""></textarea>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="map_view col-12">
								<div class="map_box hidden" id="ad_map">
									<a id="find_location" href="#">
									<span class="icon icon-my-location"></span> Find My Location</a>
									<span id="map_loading" class="loading" style="display: none;"></span>
								</div>
								<input type="hidden" id="map_lat" name="map_lat" value="">
								<input type="hidden" id="map_lng" name="map_lng" value="">
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col col-8">
							<label class="save_contact">
								<div class="custom-control custom-checkbox ">
									<input type="checkbox" class="custom-control-input" id="save_contact" value="1" name="save_contact">
									<div class="custom-control-label" for="save_contact">Save contact information (<i>Name, Phone, Location, Address</i>) for the next ads.</div>
								</div>
							</label>
						</div>
					</div>

					<div class="form-group submit_box">
						<div class="col-sm-offset-2 col col-3 btn_submit">
							<input type="submit" name="save_ad" value="Submit" class="btn btn-lg btnsavead btn-warning btn-block">
						</div>
					</div>

				</form>

				<div class="posting_rule">
					<span class="rule_title"><i class="icon-warning"></i> Posting Rule</span>
					<ul>
						<li>No posting of same ad or similar ad to multiple categories and inappropriate category</li>
						<li>No posting of false, inaccurate, misleading, defamatory content</li>
						<li>You must honestly and accurately describe the item for which you are posting an ad.</li>
						<li>khmer24.com assumes no responsibility for the accuracy of any advertisements posted on the site</li>
					</ul>
					<div>
						<a target="_blank" href="https://www.khmer24.com/en/posting-rule.html">More rules...</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<input type="hidden" value="https://www.khmer24.com/" id="base_url" />
	<input type="hidden" value="https://www.khmer24.com/khmer24-reform21/template/" id="template_path" />

	<script type="text/javascript">
		$(document).ready(function(){
			var csrf = $('#csrf').val();
			var counter=1;
			var image=[];
			var limit = 8;
			var max_size = 10;
			var base_url = document.getElementById('base_url').value;
			var maxRes = 1000000;
			var multi_uploader = new plupload.Uploader({
				runtimes : 'html5,flash,silverlight,html4',
				browse_button: ["browse-1","browse-2","browse-3","browse-4","browse-5","browse-6","browse-7","browse-8"],
				url: base_url+'upload/do_upload.html',
				max_file_size : max_size+'mb',
				unique_names : true,
				chunk_size: '1mb',
				resize : {width : 1500, height : 1400, quality : 90, crop: false},
				filters : {
					mime_types :[
					{title : "Image files", extensions : "jpg,gif,png,jpeg"}
					],
					check_image_size: 100
				},
				drop_element : 'multi-upload',
				flash_swf_url : 'https://www.khmer24.com/khmer24-reform21/template/plugin/plupload-2.1.8/Moxie.swf',
				silverlight_xap_url : 'https://www.khmer24.com/khmer24-reform21/template/plugin/plupload-2.1.8/Moxie.xap'
			});
			multi_uploader.init();

			multi_uploader.bind('FilesAdded', function(up, files) {

				$('#multi-upload').removeClass('drag-over');
				var i = counter;
				var j = 1;
				plupload.each(files, function(file) {
					if(i>limit) {
						multi_uploader.files.splice(j-1);
					} else {
						for (k = j; k <= limit; k++) { 
							if( image['item-'+k] == undefined || image['item-'+k]=='' ) {
								image['item-'+k] = 'loading';
								$('#item-'+k).append('<div class="loading"></div>');
								$('#item-'+k).find('a.btn-browse').hide();
								break;
							}
						}
					}
					i++;
					j++;
				});
				if(counter>limit) {
					$('#console').append('<div class="error alert alert-danger">Cannot upload more image. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					multi_uploader.stop();
				} else {
					multi_uploader.start();
				}

			});

			multi_uploader.bind('BeforeUpload', function (up, file) {
				up.settings.multipart_params = {'csrf_test_name': csrf}
			});

			multi_uploader.bind('UploadProgress', function(up, file) {
				$('#multi-upload').removeClass('drag-over');
				for (k = 1; k <= limit; k++) { 
					if(image['item-'+k]== undefined || image['item-'+k]=='' || image['item-'+k]=='loading') {
						if($('#item-'+k).find('div.loading').length == 0) {
							$('#item-'+k).append('<div class="loading"></div>');
							$('#item-'+k).find('a.btn-browse').hide();
						}
						if($('#item-'+k).find('div.upload_percent').length != 0) {
							$('#item-'+k).find('div.percent').css( "width", file.percent+'%');
						} else {
							$('#item-'+k).append('<div class="upload_percent"><div class="percent" style="width:'+file.percent+'%"></div></div>');
						}
						break;
					}
				}


			});

			multi_uploader.bind('Error', function(up, err) {
				$('#multi-upload').removeClass('drag-over');
				var f_size = (err.file.origSize/1024)/1024;
				var message = '';
				if(err.message) {
					if(err.file.type != "image/png" && err.file.type != "image/jpg" && err.file.type != "image/jpeg" && err.file.type != "image/gif") {
						message = 'The <strong>'+err.file.name+'</strong> wrong extension.';
					} else {
						message = err.message;
					}
					$('#console').append('<div class="error alert alert-danger">'+message+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
				multi_uploader.refresh();

			});

			multi_uploader.bind('UploadComplete', function(upldr, file) {
				multi_uploader.splice();
				$('.list-image').find('.upload_percent').remove();
				$('.list-image').find('.loading').remove();
				for (k = 1; k <= limit; k++) {
					if(image['item-'+k] == 'loading') {
						image['item-'+k] = '';
					}
					if(image['item-'+k] == undefined || image['item-'+k] == '') {
						$('body').find('div#item-'+k).find('a.btn-browse').show();
					}
				}

				multi_uploader.refresh();

			});

			multi_uploader.bind('FileUploaded', function(upldr, file, object) {
				var myData;
				try {
					myData = eval(object.response);
				} catch(err) {
					myData = eval('(' + object.response + ')');
				}
				if(myData.status=='success') {

					for (k = 1; k <= limit; k++) { 
						if(image['item-'+k]==undefined || image['item-'+k]=='loading' || image['item-'+k]=='') {
							$('#item-'+k).append('<div class="img"><a href="javascript:;" class="delete remove" data-img="'+myData.image+'">Delete</a><a href="javascript:;" class="image_rotate" data-img="'+myData.image+'">Rotate</a><div class="img-view"><img class="img-contain" src="'+base_url+'tmp/'+myData.thumb+'"><input name="pl_file['+k+']" type="hidden" value="'+myData.image+'" style="display:none"></div></div>');
							$('#item-'+k).find('.loading').remove();
							$('#item-'+k).find('.upload_percent').remove();
							image['item-'+k] = myData.image;
							break;
						}
					}

					if(counter>=limit) {
						multi_uploader.disableBrowse(true);
						multi_uploader.stop();
						multi_uploader.splice();
					}
					counter++;
				} else {
					$('#console').append('<div class="error alert alert-danger">'+myData.info+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					multi_uploader.splice();
					for (k = 1; k <= limit; k++) {
						if(image['item-'+k] == undefined || image['item-'+k] == '' ) {
							$('body').find('div#item-'+k).find('a.btn-browse').show();
						}
					}
				}
				$('#multi-upload').removeClass('drag-over');
				$('#current_uploads').html(counter-1);
				multi_uploader.refresh();
			});

			plupload.addFileFilter('check_image_size', function(minRes, file, cb) {

				var self = this, img = new o.Image();

				function finalize(result) {

					var msg = "Please upload image at less "+minRes+"px width and "+minRes+"px height.";
					if(img.width > 6500 || img.height > 6500) {
						msg = "Image <strong>"+img.name+"</strong> too big.";
					}

		            // cleanup
		            img.destroy();
		            img = null;

		            // if rule has been violated in one way or another, trigger an error
		            if (!result) {
		            	self.trigger('Error', {
		            		code : plupload.IMAGE_DIMENSIONS_ERROR,
		            		message : msg,
		            		file : file
		            	});
		            }

		            cb(result);

		        }


		        if(file.type!="image/gif") {         
		        	img.onload = function() {
		            // check if resolution cap is not exceeded
		            finalize((img.width > minRes && img.height > minRes) && (img.width < 6500 && img.height < 6500));
		        };

		        img.onerror = function() {
		        	finalize(false);
		        };

		        img.load(file.getSource());
		    } else {
		    	finalize(1);
		    }
		});

		$('body').on('click','.remove',function(e){
			e.preventDefault();
			var btn = $(this);
			var btn_id = btn.closest('div.item').attr('id');
			var img = $(this).attr('data-img');
			$('#console').html('');
			$('#'+btn_id).find('div.img').remove();
			$('#'+btn_id).find('div.loading').remove();
			$('#'+btn_id).find('div.upload_percent').remove();
			$('#'+btn_id).find('a.btn-browse').show();
			if(img) {
				image[btn_id] = '';
				counter--;
				if(counter<=limit) {
					multi_uploader.disableBrowse(false);
				}
				$.post(base_url+'upload/delete-image.html',{'image':img, 'csrf_test_name':csrf},function(data){
					if(data.csrf) {
						set_csrf(data.csrf);
					}
				});
			}
			for (k = 1; k <= limit; k++) {
				if(image['item-'+k] == undefined || image['item-'+k]=='') {
					$('#item-'+k).find('a.btn-browse').show();
				} else {
					// j++;
				}
			}
			$('#current_uploads').html(counter-1);
			multi_uploader.refresh();
		});

		$('body').on('click','.remove_uploaded',function(e){
			e.preventDefault();
			var btn = $(this);
			var btn_id = btn.closest('div.item').attr('id');
			var img = $(this).attr('data-img');
			var id = btn.attr('data-ad');
			if(img) {
				$('#'+btn_id).find('div.img').remove();
				$('#'+btn_id).find('div.loading').remove();
				$('#'+btn_id).find('div.upload_percent').remove();
				$('#'+btn_id).find('a.btn-browse').show();
				image[btn_id] = '';
				counter--;
				if(counter<=limit) {
					multi_uploader.disableBrowse(false);
				}
				multi_uploader.refresh();
			}
		});

		$('body').on('click','.image_rotate',function(e){
			e.preventDefault();
			var btn = $(this);
			var btn_id = btn.closest('div.item').attr('id');
			var img = $(this).attr('data-img');
			btn.closest('div.item').find('div.img-view').hide();
			btn.closest('div.item').find('a.image_rotate').hide();
			btn.closest('div.item').find('a.remove').hide();
			btn.closest('div.item').append('<div class="loading"></div>');
			$.post(base_url+'upload/image-rotate.html',{'image':img, 'csrf_test_name':csrf},function(data){
				btn.closest('div.item').find('div.img-view').show();
				btn.closest('div.item').find('a.image_rotate').show();
				btn.closest('div.item').find('a.remove').show();
				if(data.status=='success') {
					var d = new Date();
					$('#'+btn_id).find('img').attr('src',data.thumb+"?"+d.getTime());
				} else {
					$('#console').append('<div class="error alert alert-danger">'+data.in+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
				}
				$('#'+btn_id).find('div.loading').remove();
				if(data.csrf) {
					set_csrf(data.csrf);
				}
			},'json');
		});

		$('body').on('click','#console .remove',function(e){
			var msg = $(this);
			msg.closest('div.error').slideUp(function(){
				msg.closest('div.error').remove();
			});
		});

		var timer;
		$('#multi-upload').bind('dragover', function(){
			$(this).addClass('drag-over');
			$('#multi-upload').find('div.error').remove();
		});

		$('#multi-upload').bind('dragleave mouseleave', function(){
			var t = 300;
			clearTimeout(timer);
			timer = setTimeout( function() { removeDragDrop(); },t);
		});

		function removeDragDrop() {
			$('#multi-upload').removeClass('drag-over');
		}

		function set_csrf(csrf) {
			csrf = csrf;
			$('input[name="csrf_test_name"]').val(csrf);
		}   $('#csrf').val(csrf);

		function check_file() {
			$('input.pl_file_uploaded').each(function(index){
				image['item-'+(index+1)] = $(this).val();
			});
			counter = $('input.pl_file_uploaded').length+1;
		}
		check_file();

		$('.btn-close-modal').click(function(e){
			e.preventDefault();
			$('#account-question').modal('hide');
		});

	  $(".number").keypress(function(evt) {
	    if (evt.keyCode != 8) {
	      var theEvent = evt || window.event;
	      var key = theEvent.keyCode || theEvent.which;
	      key = String.fromCharCode(key);
	      var regex = /[0-9]|\./;
	      if (!regex.test(key)) {
	          theEvent.returnValue = false;
	          if (theEvent.preventDefault)
	              theEvent.preventDefault();
	      }
	  	}
	  });

	  $('.phone a').click(function(e) {
	      e.preventDefault();
	      if($(this).attr('data-id') == 'add') {
	          if($( "body" ).find('div.phone-2').hasClass( "d-none" )) {
	              $('.phone-2').removeClass('d-none');
	          } else {
	              $('.phone-3').removeClass('d-none');
	              $('a.add_phone').addClass('d-none');
	          }
	      } else {
	          if ($(this).attr('data-id') == 'phone-2') {
	              if($('input[name="phone-3"]').val()) {
	                  $('input[name="phone-2"]').val($('input[name="phone-3"]').val());
	                  $('input[name="phone-3"]').val('');
	              } else {
	                  if($('input[name="phone-2"]').val()) {
	                      $('input[name="phone-2"]').val('');
	                  } else {
	                      if(!$('input[name="phone-2"]').val()) {
	                          $('.phone-2').addClass('d-none');
	                      }
	                      $('.phone-3').addClass('d-none');
	                      $('a.add_phone').removeClass('d-none');
	                  }
	                  
	              }
	          }

	          if ($(this).attr('data-id') == 'phone-3') {             
	              if($('input[name="phone-3"]').val()) {
	                  $('input[name="phone-3"]').val('');
	              } else {
	                  $('a.add_phone').removeClass('d-none');
	                  $('.phone-3').addClass('d-none');
	                  $('input[name="phone-3"]').val('');
	              }
	          }
	      }
	  });

	  $('.phone input').on('keypress keyup focus change', function() {
	      if ($(this).val()) {
	          var input_name = $(this).attr('name');
	          if (input_name == 'phone-1') {
	              $('.phone-2').removeClass('d-none');
	          }
	          if (input_name == 'phone-2') {
	              $('.phone-3').removeClass('d-none');
	          }
	      }
	  });

		});
	</script>

	<div class="modal fade" id="account-question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="account-question-box">
						<div class="title-head">
							<div class="text">Please! register or login to publish your ad</div>
							<div class="icon">
							<span class="user-photo" style="background: url('https://www.khmer24.com/khmer24-reform21/template/img/default_profile.jpg') no-repeat center; background-size: cover;"></span>
							</div>
							<button class="btn btn-clear btn-close-modal"><span class="icon icon-cross"></span></button>
						</div>
						<div class="detail-box">
							<div>
								<div class="info">Already have an account?</div>
								<a class="btn btn_blue btn-primary btn-md" href="https://www.khmer24.com/en/login">Log in</a>
							</div>
							<div class="devide">
								<span>Or</span>
							</div>
							<div>
								<div class="info">No account yet?</div>
								<a class="btn btn-warning btn-yellow_dark btn-md" href="https://www.khmer24.com/en/register">Register</a>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>

<a href="#totop" id="totop"><i class="icon-up"></i></a>


@endsection
