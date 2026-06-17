@extends('frontend.layout.main1')
@push('title')
<title>{{$blogTitle}}</title>
@endpush
@push('meta')
	meta things goes here 
@endpush
@push('gtag')
	gtag things goes here
@endpush
@push('pixel_tag')
	
@endpush
@section('main-section1')


<div class="blog-details-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="row">
					<div class="col-lg-12">
						<div class="blog-details-thumb">
							<img src="url('images\products\2.jpg')" alt="thumb"> blog image dynamic
						</div>
						<div class="blog-details-content">
							<div class="meta-blog">
								<span class="mate-text">{{Author name or written by suggest which one to use as  label}}</span>
								<span><i class="fas fa-calendar-alt"></i>{{ posting date as this show -> 05 January, 2024}}</span>
							</div>
							<h4 class="blog-details-title">title dynamic-> Solution This Business For is Marketing Blog</h4>
                            // description  start dynamic
							<p class="blog-details-desc">Alternative innovation to ethical network environmental whiteboard pursue compelling results for methods empowerment. Dramatically architect go forward opportunities before user-centric Credibly implement exceptional.Continually fashion orthogonal leadership skills whereas wireless metrics. Uniquely syndicate exce opportunities with interdependent users. Globally enhance fully tested meta-services rather than solutions. Proactively integrate client-integrate go forward architectures and turnkey meta Interactively harness integrated ROI whereas frictionless products. </p>

							
                            <p class="blog-details-desc">Continually fashion orthogonal leadership skills whereas wireless metrics. Uniquely syndicate exce opportunities with interdependent users. Globally enhance fully tested meta-services rather than solutions. Proactively integrate client-integrate go forward architectures and turnkey meta Interactively harness integrated ROI whereas frictionless products.Continually fashion orthogonal leadership skills whereas wireless metrics. Uniquely syndicate exce opportunities with interdependent users. Globally enhance fully tested meta-services rather than solutions. Proactively integrate client-integrate go forward architectures and turnkey meta Interactively harness integrated ROI whereas frictionless products. </p>
						</div>
						
	                    
					</div>
				</div>
			</div>
			<div class="col-lg-4">
		    	<div class="row">
					<div class="col-lg-12">
						
                        <div class="widget-sidber">
							<div class="widget-sidber-content">
								<h4>Main Services</h4>
							</div>
							<div class="widget-category">
								<ul> list will show dynamic
									<li><a href="#"><img src="assets/images/inner/category-icon.png" alt="">Synthetic Track <i class="bi bi-arrow-right"></i></a></li>
									<li><a href="#"><img src="assets/images/inner/category-icon.png" alt="">Tennis court<i class="bi bi-arrow-right"></i></a></li>
									<li><a href="#"><img src="assets/images/inner/category-icon.png" alt="">badminton court<i class="bi bi-arrow-right"></i></a></li>
									<li><a href="#"><img src="assets/images/inner/category-icon.png" alt="">football court<i class="bi bi-arrow-right"></i></a></li>
									<li><a href="#"><img src="assets/images/inner/category-icon.png" alt="">hockeey<i class="bi bi-arrow-right"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="widget-sidber">
							<div class="widget-sidber-content">
								<h4>Popular Post</h4>
							</div>
                            post list will show dynamically 
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
						
					</div>
				</div>
		    </div>
		</div>
	</div>
</div>


@endsection