@include('frontend.design-court.court-layout.header')

<div class="row mb-4">
    <a href="javascript:history.back()">← Go Back</a>

    @yield('court-name_area')
</div>

<hr class="border mb-4">

<div class="row mb-4 header-items">
    <!-- Main Court Section -->
    <div class="col">
        <p class="" style="font-weight:900">Select Main Court Color Type:</p>
    </div>
    <div class="col">
        <input type="radio" id="pu-colors-checkbox" name="color-type" value="pu-colors" onchange="toggleColorSection()">
        <label for="pu-colors-checkbox">PU Colors</label>
    
        <input type="radio" id="acrylic-colors-checkbox" name="color-type" value="acrylic-colors" onchange="toggleColorSection()">
        <label for="acrylic-colors-checkbox">Acrylic Colors</label>
    </div>
    <div class="col">            
        <input id="download" class="btn btn-sm btn-primary mt-2" type="button" value="Download"/>
    </div>
</div>

<div class="row">
    <div id="outer_div" class="text-center" style="width:100%; ">
        <div id="main_div" style="position: relative">
            <div id="colorbig" >
                @yield('court-image')
                
            </div>
            <img src="{{url('court-design/assets/watermark.png')}}" id="watermark" alt="Watermark" 
                     style="position: absolute; top: -35px; left: -55px; transform:translate(-50%,-50%) width: 50%; display: none; background-color: none;">
        </div>
    </div>

    <canvas id="canvas" width="300" height="300" style="display: none;"></canvas>
</div>   

<div class="row">    
    <div class="col-6">
        <div class="row">
            <u><h4>Surface Colors:-- </h4></u>
        </div>
        <div class="row">
            <!-- PU Surface Colors -->
            <ul class="overview" id="pu-surface-colors" style="display: flex;">
                
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="volleyballCheckbox" value="fp-basketball-surface">
                        <span class="color-preview" style="background-color: #0089b6;" id="fp-basketball-surface"></span>
                        <span>Light Blue</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceDarkBlueCheckbox" value="surface-pu-feather-green">
                        <span class="color-preview" style="background-color: #587f40;" id="surface-pu-feather-green"></span>
                        <span>Feather Green</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceGreyCheckbox" value="surface-pu-boston-green">
                        <span class="color-preview" style="background-color: #325928;" id="surface-pu-boston-green"></span>
                        <span>Boston Green</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceEvergreenCheckbox" value="surface-pu-reseda-green">
                        <span class="color-preview" style="background-color: #6c7c59;" id="surface-pu-reseda-green"></span>
                        <span>Reseda Green</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceShamrockGreenCheckbox" value="surface-cloudy-grey-pu">
                        <span class="color-preview" style="background-color: #7a888e;" id="surface-cloudy-grey-pu"></span>
                        <span>Cloudy Grey</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfacePearlOrangeCheckbox" value="surface-dessert-grey-pu">
                        <span class="color-preview" style="background-color: #928e85;" id="surface-dessert-grey-pu"></span>
                        <span>Dessert Grey</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceGreenCheckbox" value="surface-graphite-grey-pu">
                        <span class="color-preview" style="background-color: #45494e;" id="surface-graphite-grey-pu"></span>
                        <span>Graphite Grey</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceEarthCheckbox" value="surface-aqua-blue-pu">
                        <span class="color-preview" style="background-color: #007cb0;" id="surface-aqua-blue-pu"></span>
                        <span>Aqua Blue</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceBrickRedCheckbox" value="surface-gentian-blue-pu">
                        <span class="color-preview" style="background-color: #004f7c;" id="surface-gentian-blue-pu"></span>
                        <span>Gentian Blue</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceBrickyellowCheckbox" value="surface-brick-red-pu">
                        <span class="color-preview" style="background-color: #a04647;" id="surface-brick-red-pu"></span>
                        <span>Brick Red</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceBrickyellowCheckbox" value="surface-pastel-orange-pu">
                        <span class="color-preview" style="background-color: #d5654d;" id="surface-pastel-orange-pu"></span>
                        <span>Pastel Orange</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceBrickyellowCheckbox" value="surface-coffee-brown-pu">
                        <span class="color-preview" style="background-color: #724a25;" id="surface-coffee-brown-pu"></span>
                        <span>Coffee Brown</span>
                    </div>
                </li>
            </ul>
        
            <!-- Acrylic Surface Colors -->
            <ul class="overview" id="acrylic-surface-colors" style="display: none;">
                
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="volleyballCheckbox" value="fp-basketball-surface">
                        <span class="color-preview" style="background-color: #0078be;" id="fp-basketball-surface"></span>
                        <span>Light Blue</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceDarkBlueCheckbox" value="surface-acrylic-grass-green">
                        <span class="color-preview" style="background-color: #009246;" id="surface-acrylic-grass-green"></span>
                        <span>Grass Green</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceGreyCheckbox" value="surface-acrylic-forest-green">
                        <span class="color-preview" style="background-color: #2c4c32;" id="surface-acrylic-forest-green"></span>
                        <span>Forest Green</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceEvergreenCheckbox" value="surface-acrylic-grey">
                        <span class="color-preview" style="background-color: #606263;" id="surface-acrylic-grey"></span>
                        <span>Grey</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceShamrockGreenCheckbox" value="surface-us-blue-acrylic">
                        <span class="color-preview" style="background-color: #004175;" id="surface-us-blue-acrylic"></span>
                        <span>US Open Blue</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfacePearlOrangeCheckbox" value="surface-terra-cotta-acrylic">
                        <span class="color-preview" style="background-color: #641722;" id="surface-terra-cotta-acrylic"></span>
                        <span>Terra Cotta Red</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceGreenCheckbox" value="surface-voilet-acrylic">
                        <span class="color-preview" style="background-color: #43355d;" id="surface-voilet-acrylic"></span>
                        <span>Voilet</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox surface" name="SurfaceEarthCheckbox" value="surface-orange-acrylic">
                        <span class="color-preview" style="background-color: #f26722;" id="surface-orange-acrylic"></span>
                        <span>Orange</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <u><h4>Border Colors:-- </h4></u>
        </div>   
        <div class="row">
             <!-- PU Border Colors -->
            <ul class="overview" id="pu-border-colors" style="display: flex;">
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="volleyballCheckbox" value="fp-basketball-border">
                        <span class="color-preview" style="background-color: #0089b6;" id="fp-basketball-border"></span>
                        <span>Light Blue</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderDarkBlueCheckbox" value="border-pu-feather-green">
                        <span class="color-preview" style="background-color: #587f40;" id="border-pu-feather-green"></span>
                        <span>Feather Green</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderGreyCheckbox" value="border-pu-boston-green">
                        <span class="color-preview" style="background-color: #325928;" id="border-pu-boston-green"></span>
                        <span>Boston Green</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderEvergreenCheckbox" value="border-pu-reseda-green">
                        <span class="color-preview" style="background-color: #6c7c59;" id="border-pu-reseda-green"></span>
                        <span>Reseda Green</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderShamrockGreenCheckbox" value="border-cloudy-grey-pu">
                        <span class="color-preview" style="background-color: #7a888e;" id="border-cloudy-grey-pu"></span>
                        <span>Cloudy Grey</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderPearlOrangeCheckbox" value="border-dessert-grey-pu">
                        <span class="color-preview" style="background-color: #928e85;" id="border-dessert-grey-pu"></span>
                        <span>Dessert Grey</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderGreenCheckbox" value="border-graphite-grey-pu">
                        <span class="color-preview" style="background-color: #45494e;" id="border-graphite-grey-pu"></span>
                        <span>Graphite Grey</span>
                    </div>
                </li>
                
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderBrickRedCheckbox" value="border-aqua-blue-pu">
                        <span class="color-preview" style="background-color: #007cb0;" id="border-aqua-blue-pu"></span>
                        <span>Aqua Blue</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderEarthCheckbox" value="border-gentian-blue-pu">
                        <span class="color-preview" style="background-color: #004f7c;" id="border-gentian-blue-pu"></span>
                        <span>Gentian Blue</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderBrickyellowCheckbox" value="border-brick-red-pu">
                        <span class="color-preview" style="background-color: #a04647;" id="border-brick-red-pu"></span>
                        <span>Brick Red</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderBrickyellowCheckbox" value="border-pastel-orange-pu">
                        <span class="color-preview" style="background-color: #d5654d;" id="border-pastel-orange-pu"></span>
                        <span>Pastel Orange</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderBrickyellowCheckbox" value="border-coffee-brown-pu">
                        <span class="color-preview" style="background-color: #724a25;" id="border-coffee-brown-pu"></span>
                        <span>Coffee Brown</span>
                    </div>
                </li>
            </ul>
        
            <!-- Acrylic Border Colors -->
            <ul class="overview" id="acrylic-border-colors" style="display: none;">
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="volleyballCheckbox" value="fp-basketball-border">
                        <span class="color-preview" style="background-color: #0078be;" id="fp-basketball-border"></span>
                        <span>Light Blue</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderDarkBlueCheckbox" value="border-acrylic-grass-green">
                        <span class="color-preview" style="background-color: #009246;" id="border-acrylic-grass-green"></span>
                        <span>Grass Green</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderGreyCheckbox" value="border-acrylic-forest-green">
                        <span class="color-preview" style="background-color: #2c4c32;" id="border-acrylic-forest-green"></span>
                        <span>Forest Green</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderEvergreenCheckbox" value="border-acrylic-grey">
                        <span class="color-preview" style="background-color: #606263;" id="border-acrylic-grey"></span>
                        <span>Grey</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderShamrockGreenCheckbox" value="border-us-blue-acrylic">
                        <span class="color-preview" style="background-color: #004175;" id="border-us-blue-acrylic"></span>
                        <span>US Open Blue</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderPearlOrangeCheckbox" value="border-terra-cotta-acrylic">
                        <span class="color-preview" style="background-color: #641722;" id="border-terra-cotta-acrylic"></span>
                        <span>Terra Cotta Red</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderGreenCheckbox" value="border-voilet-acrylic">
                        <span class="color-preview" style="background-color: #43355d;" id="border-voilet-acrylic"></span>
                        <span>Voilet</span>
                    </div>
                </li>
                <li>
                    <div class="Basketball" data-option-id="Basketball">
                        <input type="checkbox" class="custom-checkbox border" name="BorderEarthCheckbox" value="border-orange-acrylic">
                        <span class="color-preview" style="background-color: #f26722;" id="border-orange-acrylic"></span>
                        <span>Orange</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

@php
    $currentRoute = Route::currentRouteName();
    $formattedRoute = ucwords(str_replace('-', ' ', $currentRoute));
@endphp
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="downloadModalLabel">Enter Details Before Download</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="userDetailsForm" method="post" >
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="userName">Name</label>
                        <input type="text" id="userName" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="userEmail">Email</label>
                        <input type="email" id="userEmail" class="form-control" placeholder="Enter your email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="userPhone">Phone</label>
                        <input type="tel" id="userPhone" class="form-control" placeholder="Enter your phone" required minlength="10" maxlength="12">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="userCity">City</label>
                        <input type="text" id="userCity" class="form-control" placeholder="Enter your city" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="userRequirement">Requirement</label>
                    <textarea id="userRequirement" class="form-control" placeholder="Enter your requirement" required></textarea>
                </div>
                <div class="form-group">
                    <label for="userMessage">Message</label>
                    <textarea id="userMessage" class="form-control" placeholder="Enter any additional message" required></textarea>
                </div>
                <input type="hidden" name="court" value="{{$formattedRoute}}" id="userCourt">
                <div class="g-recaptcha" data-sitekey="6LcUIW8qAAAAAH8nhtqxLXsj93tqWko7ccrD0zCX"></div>
                <div class="form-group" style="display:flex; justify-content:space-around;">
                    <!-- Hidden Download Link -->
                    <a style="display:none;" id="btn-Convert-Html2Image" href="#">Download</a>
                    <button type="button" id="confirm-download" class="btn btn-success">Confirm & Download</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@include('frontend.design-court.court-layout.footer')
