@extends('frontend.layout.main1')
@push('title')
<title>Desan International | Blog-Detail</title>
@endpush
@section('main-section1')

<!--==================================================-->
<!-- Start solutek blog details-->
<!--==================================================-->

<div class="blog-details-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="row">
					<div class="col-lg-12">
						<div class="blog-details-thumb">
							<img src="url('images\products\2.jpg')" alt="thumb">
						</div>
						<div class="blog-details-content">
							<div class="meta-blog">
								<span class="mate-text">By Author</span>
								<span><i class="fas fa-calendar-alt"></i>05 January, 2024</span>
								<span><img src="assets/images/inner/category-icon.png" alt="">IT Solutions</span>
							</div>
							<h4 class="blog-details-title">Solution This Business For is Marketing Blog</h4>

							<p class="blog-details-desc">Alternative innovation to ethical network environmental whiteboard pursue compelling results for methods empowerment. Dramatically architect go forward opportunities before user-centric Credibly implement exceptional</p>	

							<p class="blog-details-desc">Continually fashion orthogonal leadership skills whereas wireless metrics. Uniquely syndicate exce opportunities with interdependent users. Globally enhance fully tested meta-services rather than solutions. Proactively integrate client-integrate go forward architectures and turnkey meta Interactively harness integrated ROI whereas frictionless products. </p>

							
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-lg-4">
		    	<div class="row">
					<div class="col-lg-12">
						{{-- <div class="widget-sidber">
						   <div class="widget_search">
						     <form action="#" method="get">
						    	<input type="text" name="s" value="" placeholder="Search Here" title="Search for:">
						    	<button type="submit" class="icons">
						    		<i class="fa fa-search"></i>
						    	</button>
						     </form>
				    	   </div>
				    	</div> --}}
                        <div class="widget-sidber">
							<div class="widget-sidber-content">
								<h4>Main Services</h4>
							</div>
							<div class="widget-category">
								<ul>
									<li><a href="#"><img src="assets/images/inner/category-icon.png" alt="">App Development<i class="bi bi-arrow-right"></i></a></li>
									<li><a href="#"><img src="assets/images/inner/category-icon.png" alt="">IT Solution<i class="bi bi-arrow-right"></i></a></li>
									<li><a href="#"><img src="assets/images/inner/category-icon.png" alt="">Digital Marketing<i class="bi bi-arrow-right"></i></a></li>
									<li><a href="#"><img src="assets/images/inner/category-icon.png" alt="">Web Design<i class="bi bi-arrow-right"></i></a></li>
									<li><a href="#"><img src="assets/images/inner/category-icon.png" alt="">Web Development<i class="bi bi-arrow-right"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="widget-sidber">
							<div class="widget-sidber-content">
								<h4>Popular Post</h4>
							</div>
							<div class="sidber-widget-recent-post">
								<div class="recent-widget-thumb">
									<img src="assets/images/inner/recent-post.png" alt="img">
								</div>
								<div class="recent-widget-content">
									<a href='/blog-details'>Regional Manager limited time
										</a>	
									<p> feb, 26 2024</p>							
								</div>
							</div>							
							<div class="sidber-widget-recent-post">
								<div class="recent-widget-thumb">
									<img src="assets/images/inner/recent-post2.png" alt="img">
								</div>
								<div class="recent-widget-content">
									<a href='/blog-details'>The Complete App Development</a>	
									<p> June, 15 2024</p>							
								</div>
							</div>							
							<div class="sidber-widget-recent-post">
								<div class="recent-widget-thumb">
									<img src="assets/images/inner/recent-post3.png" alt="img">
								</div>
								<div class="recent-widget-content">
									<a href='/blog-details'>Easy and Most Powerful Server</a>	
									<p> april, 10 2024</p>							
								</div>
							</div>
						</div>							
						{{-- <div class="widget-sidber">
							<div class="widget-sidber-content">
								<h4>Tags</h4>
							</div>	
							<div class="widget-catefories-tags">
                                <a href="#">Cyber Security</a>
                                <a href="#">Learning</a>
                                <a href="#">Software</a>
                                <a href="#">Development</a>
                                <a href="#">Marketing</a>
                                <a href="#">Technology</a>
                            </div>											
						</div> --}}
					</div>
				</div>
		    </div>
		</div>
	</div>
</div>


@endsection