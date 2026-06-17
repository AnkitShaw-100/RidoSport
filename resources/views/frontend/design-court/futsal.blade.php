@extends('frontend.design-court.court-layout.main')
@push('title')
<title>Rido Sports | Futsal Court</title>
@endpush
@push('style') 
<style>
   #colorbig {
      height: 254px;
      padding: 40px 36px;
      text-align: center;
      margin: 0 auto;
   }
   #main_div{
      height: 252px;
      width: 444px;
      background: #879baf
   }
   #outer_div{
      padding: 13px;
      width: 96%;
   }
</style>
@endpush
@section('court-main')
<div class="row">
   <div style="margin-top: 30px;" class="clearfix">
      <h2 class="text-center col-md-6 col-sm-6">Futsal Court</h2>
      <span class="col-md-6 col-sm-6" style="font-size: 30px; padding-top:15px;">Size: 31 X 16 M</span>
   </div>
   <hr class="border" style="margin-bottom: 50px;">
   <div class="col-md-7 col-sm-7">
      <div id="page_court_options">
            <div id="loader" style="display: none; opacity: 1;">
               <img src="{{url('court-design/assets/img/loader.gif')}}" alt="Loader" style="vertical-align: middle; display: block;">
            </div>
            <form class="custom court_options_settings">
               <!--Options-->
               <div class="row">
                  <!--Main Court-->
                  <div class="col-md-4 col-sm-4">
                        <p class="form_title ios-font">Main Court:</p>
                        <div class="row">
                           <select id="color-selector" onchange="toggleColorSection()">
                              <option value="pu-colors">PU Colors</option>
                              <option value="acrylic-colors">Acrylic Colors</option>
                          </select>
                           <div class="col-md-6 col-sm-6">
                              <div class="dropdown">
                                    <div class="dropdown-toggle ios-font" type="button" data-toggle="dropdown">
                                       Surface
                                       <span class="caret"></span></div>
                                    <ul class="dropdown-menu">
                                       <div>
                                          <p style="padding: 5px; bottom: 0; font-size: 20px;">Color Picker</p>
                                       </div>
                                       <hr>
                                       <div class="colors">
                                          <div class="color_section active">
                                                <div class="colors_wrapper default-skin scrollable">
                                                   <div class="scroll-bar vertical"
                                                         style="height: 194px; display: block;">
                                                      <div class="thumb"
                                                            style="top: 0px; height: 51.6269px;"></div>
                                                   </div>
                                                   <div class="viewport" style="height: 194px; width: 213px;">
                                                      <div class="overview" id="pu-surface-colors" style="top: 0px;left: 0px; display:block">
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="volleyballCheckbox"
                                                                     value="fp-basketball-surface">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #0078be; display: inline-block;"
                                                                         id="fp-basketball-surface"></span>
                                                                     <div style="display: inline-block;">Aqua Blue
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceDarkBlueCheckbox"
                                                                     value="surface-pu-feather-green">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #7bb665; display: inline-block;"
                                                                         id="surface-pu-feather-green"></span>
                                                                     <div style="display: inline-block;">Feather Green
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceGreyCheckbox"
                                                                     value="surface-pu-boston-green">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #51814f; display: inline-block;"
                                                                         id="surface-pu-boston-green"></span>
                                                                     <div style="display: inline-block;">Boston Green</div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceEvergreenCheckbox"
                                                                     value="surface-pu-jungle-green">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #284843; display: inline-block;"
                                                                         id="surface-pu-jungle-green"></span>
                                                                     <div style="display: inline-block;">Jungle Green
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </li>
                                                         
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceShamrockGreenCheckbox"
                                                                     value="surface-cloudy-grey-pu">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #879baf; display: inline-block;"
                                                                         id="surface-cloudy-grey-pu"></span>
                                                                     <div style="display: inline-block;">Cloudy Grey</div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfacePearlOrangeCheckbox"
                                                                     value="surface-dessert-grey-pu">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #c8bab1; display: inline-block;"
                                                                         id="surface-dessert-grey-pu"></span>
                                                                     <div style="display: inline-block;">Dessert Grey</div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceGreenCheckbox"
                                                                     value="surface-graphite-grey-pu">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #2d2e49; display:inline-block;"
                                                                         id="surface-graphite-grey-pu"></span>
                                                                     <div style="display: inline-block;">Graphite Grey</div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceEarthCheckbox"
                                                                     value="surface-pastel-blue-pu">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #527183; display: inline-block;"
                                                                         id="surface-pastel-blue-pu"></span>
                                                                     <div style="display: inline-block;">Pastel Blue
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceBrickRedCheckbox"
                                                                     value="surface-storm-blue-pu">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #274357; display: inline-block;"
                                                                         id="surface-storm-blue-pu"></span>
                                                                     <div style="display: inline-block;">Storm Blue</div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceBrickyellowCheckbox"
                                                                     value="surface-brick-red-pu">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color:#a04647 ; display: inline-block;"
                                                                         id="surface-brick-red-pu"></span>
                                                                     <div style="display: inline-block;">Brick Red</div>
                                                                 </div>
                                                             </div>
                                                         </li>
                                                         
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceBrickyellowCheckbox"
                                                                     value="surface-pastel-orange-pu">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #f16b46; display: inline-block;"
                                                                         id="surface-pastel-orange-pu"></span>
                                                                     <div style="display: inline-block;">Pastel Orange</div>
                                                                 </div>
                                                             </div>
                                                         </li>
                                                         
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceBrickyellowCheckbox"
                                                                     value="surface-coffee-brown-pu">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #847366; display: inline-block;"
                                                                         id="surface-coffee-brown-pu"></span>
                                                                     <div style="display: inline-block;">Coffee Brown</div>
                                                                 </div>
                                                             </div>
                                                         </li>
                                                     </div>
 
                                                     <div class="overview" id="acrylic-surface-colors" style="top: 0px;left: 0px; display:none">
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="volleyballCheckbox"
                                                                     value="fp-basketball-surface">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #0078be; display: inline-block;"
                                                                         id="fp-basketball-surface"></span>
                                                                     <div style="display: inline-block;">Ocean Blue
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceDarkBlueCheckbox"
                                                                     value="surface-acrylic-grass-green">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #009246; display: inline-block;"
                                                                         id="surface-acrylic-grass-green"></span>
                                                                     <div style="display: inline-block;">Grass Green
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceGreyCheckbox"
                                                                     value="surface-acrylic-forest-green">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #2c4c32; display: inline-block;"
                                                                         id="surface-acrylic-forest-green"></span>
                                                                     <div style="display: inline-block;">Forest Green</div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceEvergreenCheckbox"
                                                                     value="surface-acrylic-grey">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #606263; display: inline-block;"
                                                                         id="surface-acrylic-grey"></span>
                                                                     <div style="display: inline-block;">Grey
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </li>
                                                         
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceShamrockGreenCheckbox"
                                                                     value="surface-us-blue-acrylic">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #004175; display: inline-block;"
                                                                         id="surface-us-blue-acrylic"></span>
                                                                     <div style="display: inline-block;">US Open Blue</div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfacePearlOrangeCheckbox"
                                                                     value="surface-terra-cotta-acrylic">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #641722; display: inline-block;"
                                                                         id="surface-terra-cotta-acrylic"></span>
                                                                     <div style="display: inline-block;">Terra Cotta Red</div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceGreenCheckbox"
                                                                     value="surface-voilet-acrylic">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #43355d; display:inline-block;"
                                                                         id="surface-voilet-acrylic"></span>
                                                                     <div style="display: inline-block;">Voilet</div>
                                                                 </div>
                                                             </div>
                                                         </li>
 
                                                         <li>
                                                             <div class="Basketball" data-option-id="Basketball">
                                                                 <input style="height: 30px!important; width: 34x!important;"
                                                                     type="checkbox"
                                                                     class="custom-checkbox surface"
                                                                     name="SurfaceEarthCheckbox"
                                                                     value="surface-orange-acrylic">
                                                                 <div class="dropdown">
                                                                     <span class="color-preview dropdown_btn"
                                                                         style="background-color: #f16722; display: inline-block;"
                                                                         id="surface-orange-acrylic"></span>
                                                                     <div style="display: inline-block;">Orange
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </li>
                                                     </div>
                                                   </div>
                                                </div>
                                          </div>
                                       </div>
                                    </ul>
                              </div>
                           </div>

                           <div class="col-md-6 col-md-6">
                              <div class="dropdown">
                                 <div class="dropdown-toggle ios-font" type="button" data-toggle="dropdown">Border
                              <span class="caret"></span>
                           </div>
                           <ul class="dropdown-menu">
                              <!-- <li style="padding: 16px; margin-bottom: -20px;"><p style="font-size: 22px;">Color Picker</p></li> -->
                              <div>
                                 <p style="padding: 5px; bottom: 0; font-size: 20px;">Color Picker</p>
                              </div>
                              <div class="colors">
                                 <div class="color_section active">
                                    <div class="colors_wrapper default-skin scrollable">
                                       <div class="scroll-bar vertical" style="height: 194px; display: block;">
                                          <div class="thumb" style="top: 0px; height: 51.6269px;"></div>
                                       </div>
                                       <div class="viewport" style="height: 194px; width: 213px;">
                                          <div class="overview" id="pu-border-colors" style="top: 0px;left: 0px; display:block">
                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox" class="custom-checkbox border"name="BorderBrightBlueCheckbox"
                                                         value="border-aqua-blue-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn" style="background-color: #0078be; display: inline-block;" id="border-aqua-blue-pu">
                                                         </span>
                                                         <div style="display: inline-block;">Aqua Blue</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderDarkBlueCheckbox"
                                                         value="border-feather-green-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color:#7bb665; display: inline-block;"
                                                             id="border-feather-green-pu"></span>
                                                         <div style="display: inline-block;">Feather Green</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderSteelBlueCheckbox"
                                                         value="border-boston-green-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #51814f; display: inline-block;"
                                                             id="border-boston-green-pu"></span>
                                                         <div style="display: inline-block;">Boston Green
                                                         </div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderEvergreenCheckbox"
                                                         value="border-jungle-green-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #284843; display: inline-block;"
                                                             id="border-jungle-green-pu"></span>
                                                         <div style="display: inline-block;">Jungle Green</div>
                                                     </div>
                                                 </div>
                                             </li>        

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderShamrockGreenCheckbox"
                                                         value="border-cloudy-grey-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #879baf; display: inline-block;"
                                                             id="border-cloudy-grey-pu"></span>
                                                         <div style="display: inline-block;">Cloudy Grey</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderPearlOrangeCheckbox"
                                                         value="border-dessert-grey-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #c8bab1; display: inline-block;"
                                                             id="border-dessert-grey-pu"></span>
                                                         <div style="display: inline-block;">Dessert Grey</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderGreenCheckbox"
                                                         value="border-graphite-grey-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #2d2e49; display: inline-block;"
                                                             id="border-graphite-grey-pu"></span>
                                                         <div style="display: inline-block;">Graphite Grey
                                                         </div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderEarthCheckbox"
                                                         value="border-pastel-blue-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #527183; display: inline-block;"
                                                             id="border-pastel-blue-pu"></span>
                                                         <div style="display: inline-block;">Pastel Blue</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderBrickRedCheckbox"
                                                         value="border-storm-blue-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #274357; display: inline-block;"
                                                             id="border-storm-blue-pu"></span>
                                                         <div style="display: inline-block;">Storm Blue</div>
                                                     </div>
                                                 </div>
                                             </li>
                                             
                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderBrickRedCheckbox"
                                                         value="border-brick-red-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #a04647; display: inline-block;"
                                                             id="border-brick-red-pu"></span>
                                                         <div style="display: inline-block;">Brick Red</div>
                                                     </div>
                                                 </div>
                                             </li> 
                                             
                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderBrickRedCheckbox"
                                                         value="border-pastel-orange-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #f16b46; display: inline-block;"
                                                             id="border-pastel-orange-pu"></span>
                                                         <div style="display: inline-block;">Pastel Orange</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderBrickRedCheckbox"
                                                         value="border-coffee-brown-pu">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #847366; display: inline-block;"
                                                             id="border-coffee-brown-pu"></span>
                                                         <div style="display: inline-block;">Coffee Brown</div>
                                                     </div>
                                                 </div>
                                             </li>
                                         </div>

                                         <div class="overview" id="acrylic-border-colors" style="top: 0px;left: 0px; display:none" >
                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox" class="custom-checkbox border"name="BorderBrightBlueCheckbox"
                                                         value="border-ocean-blue-acrylic">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn" style="background-color: #0078be; display: inline-block;" id="border-ocean-blue-acrylic"></span>
                                                         <div style="display: inline-block;">Ocean Blue</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderDarkBlueCheckbox"
                                                         value="border-grass-green-acrylic">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color:#009246; display: inline-block;"
                                                             id="border-grass-green-acrylic"></span>
                                                         <div style="display: inline-block;">Grass Green</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderSteelBlueCheckbox"
                                                         value="border-forest-green-acrylic">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #2c4c32; display: inline-block;"
                                                             id="border-forest-green-acrylic"></span>
                                                         <div style="display: inline-block;">Forest Green</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderEvergreenCheckbox"
                                                         value="border-grey-acrylic">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #606263; display: inline-block;"
                                                             id="border-grey-acrylic"></span>
                                                         <div style="display: inline-block;">Grey</div>
                                                     </div>
                                                 </div>
                                             </li>        

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderShamrockGreenCheckbox"
                                                         value="border-us-open-blue-acrylic">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #004175; display: inline-block;"
                                                             id="border-us-open-blue-acrylic"></span>
                                                         <div style="display: inline-block;">US Open Blue</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderPearlOrangeCheckbox"
                                                         value="border-terra-cotta-red-acrylic">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #641722; display: inline-block;"
                                                             id="border-terra-cotta-red-acrylic"></span>
                                                         <div style="display: inline-block;">Terra Cotta Red</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderGreenCheckbox"
                                                         value="border-voilet-acrylic">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #43355d; display: inline-block;"
                                                             id="border-voilet-acrylic"></span>
                                                         <div style="display: inline-block;">Voilet</div>
                                                     </div>
                                                 </div>
                                             </li>

                                             <li>
                                                 <div class="Basketball" data-option-id="Basketball">
                                                     <input style="height: 30px!important; width: 34x!important;"
                                                         type="checkbox"
                                                         class="custom-checkbox border"
                                                         name="BorderEarthCheckbox"
                                                         value="border-orange-acrylic">
                                                     <div class="dropdown">
                                                         <span class="color-preview dropdown_btn"
                                                             style="background-color: #f16722; display: inline-block;"
                                                             id="border-orange-acrylic"></span>
                                                         <div style="display: inline-block;">Orange</div>
                                                     </div>
                                                 </div>
                                             </li>
                                         </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </ul>
                        </div>
                     </div>
                  </div>

                  <br>

                  </div>
                  <!--Sports Elements-->


                  
                  <!--Court Elements-->
                  <div class="col-md-4 col-sm-5">
                        <p class="form_title ios-font">Court Elements:</p>
                        <div class="row">

                           <div class="col-md-6 col-sm-6">
                              <div class="settings_sports_colors">


                                    <div>
                                       <div class="Basketball" data-option-id="Basketball">
                                          <input type="checkbox" class="custom-checkbox" name="fp-name-light"
                                                   checked="checked" id="fp-light-input-checkbox">
                                          <div class="dropdown">
                                                <div class="dropdown_btn ios-font">Light</div>
                                          </div>
                                       </div>
                                    </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <div class="dropdown">
                                    <input style="display: inline-block;"  id="chkPassport" type="checkbox" class="custom-checkbox" checked="checked"
                                          name="post-format" id="bp-light-input-checkbox">
                                    <div style="display: inline-block;" class="dropdown-toggle ios-font"
                                       type="button" data-toggle="dropdown">Fence
                                       <span class="caret"></span></div>
                                       <ul class="dropdown-menu">
                                       <!-- <li style="padding: 16px; margin-bottom: -20px;"><p style="font-size: 22px;">Color Picker</p></li> -->

                                       <div class="colors">
                                          <div class="color_section active">
                                                <div class="colors_wrapper default-skin scrollable">

                                                   <div class="viewport" style="height: 194px; width: 213px;">
                                                      <div class="overview" style="top: 0px;left: 0px;">

                                                            <!--===================== Left Fence =====================-->
                                                            <li>
                                                               <div class="Basketball" data-option-id="Basketball">
                                                                  <input style="height: 30px!important; width: 34x!important;"
                                                                           type="checkbox" checked="checked"
                                                                           id="fp-left-fence-input-checkbox"
                                                                           class="custom-checkbox"
                                                                           name="fp-left-fence">
                                                                  <div class="dropdown">

                                                                        <div style="display: inline-block;">Left
                                                                           Fence
                                                                        </div>
                                                                  </div>
                                                               </div>
                                                            </li>
                                                            <!--===================== Top Fence =====================-->
                                                            <li>
                                                               <div class="Basketball" data-option-id="Basketball">
                                                                  <input style="height: 30px!important; width: 34x!important;"
                                                                           type="checkbox" checked="checked"
                                                                           id="fp-top-fence-input-checkbox"
                                                                           class="custom-checkbox"
                                                                           name="fp-top-fence">
                                                      
                                                                  <div class="dropdown">

                                                                        <div style="display: inline-block;">Top
                                                                           fence
                                                                        </div>
                                                                  </div>
                                                               </div>
                                                            </li>

                                                            <!--===================== Right Fence =====================-->
                                                            <li>
                                                               <div class="Basketball" data-option-id="Basketball">
                                                                  <input style="height: 30px!important; width: 34x!important;"
                                                                           type="checkbox" checked="checked"
                                                                           id="fp-right-fence-input-checkbox"
                                                                           class="custom-checkbox"
                                                                           name="fp-right-fence">
                                                                  <div class="dropdown">

                                                                        <div style="display: inline-block;">Right
                                                                           Fence
                                                                        </div>
                                                                  </div>
                                                               </div>
                                                            </li>

                                                            <!--===================== Bottom Fence =====================-->
                                                            <li>
                                                               <div class="Basketball" data-option-id="Basketball">
                                                                  <input style="height: 30px!important; width: 34x!important;"
                                                                           type="checkbox"
                                                                           id="fp-bottom-fence-input-checkbox" checked="checked"
                                                                           class="custom-checkbox"
                                                                           name="fp-bottom-fence">
                                                                  <div class="dropdown">

                                                                        <div style="display: inline-block;">Bottom
                                                                           Fence
                                                                        </div>
                                                                  </div>
                                                               </div>
                                                            </li>


                                                      </div>
                                                   </div>
                                                </div>
                                          </div>
                                       </div>
                                    </ul>
                              </div>
                           </div>


                        </div>

                  </div>

                     <div class="col-md-4 col-md-4">
                     <div class="settings_sports_colors">
                     <p class="form_title ios-font">Sports Elements:</p>
                     <!--Basketball-->
                     <div>
                        <div class="Basketball" data-option-id="Basketball">
                           <!-- <input type="checkbox" class="custom-checkbox" name="basketballCheckbox" value="basketball"> -->
                           <div class="dropdown">
                              <div class="dropdown-toggle dropdown_btn ios-font" type="button" data-toggle="dropdown">Futsal
                                 <span class="caret"></span>
                              </div>
                              <ul class="dropdown-menu">
                                 <div>
                                    <p style="padding-left: 5px; padding-right: 5px; bottom: 0; font-size: 20px;">Color Picker</p>
                                 </div>
                                 <hr style="padding-top: 0px;">
                                 <div class="colors">
                                    <div class="color_section active">
                                       <div class="colors_wrapper default-skin scrollable">
                                          <div class="scroll-bar vertical" style="height: 194px; display: block;">
                                          </div>
                                          <div class="viewport" style="height: 194px; width: 213px;">
                                             <div class="overview" style="height: 194px; display: block; top: 0px;left: 0px;">
                                                <ul class="nav nav-tabs">
                                                   
                                                   <li class=" active ios-font" ><a data-toggle="tab" href="#key">Key</a></li>
                                                      <li class="ios-font" ><a data-toggle="tab" href="#circle">Circle</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                   <!--==================================Circle=========================== -->
                                                   <div id="circle" class="tab-pane fade">
                                                      
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrightBlueKeyCheckbox" value="futsal-bright-blue-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #226fb4; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Aqua Blue (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      
                                                      <!--Steel Blue Color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalDarkBlueKeyCheckbox" value="futsal-dark-blue-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #2d3d4c; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Storm Blue</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Kiwi Color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalGreyKeyCheckbox" value="futsal-grey-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #8894a2; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Cloudy Grey</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Burgundy Color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalEvergreenKeyCheckbox" value="futsal-evergreen-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #364b46; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Jungle Green</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Sand Color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalShamrockGreenKeyCheckbox" value="futsal-shamrock-green-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #3e7a3e; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Boston Green</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Black color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalgreenKeyCheckbox" value="futsal-green-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #6c9f64; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Feather Green</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Purple color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalPurpleKeyCheckbox" value="futsal-purple-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #fe6e49; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Pastel Orange</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Dark Blue color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalEarthKeyCheckbox" value="futsal-earth-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #745445; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Brown</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Grey color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-red-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #9d4841; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Brick Red</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                       
                                       
                                       
                                       <!-- new section start herer -->
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-dark-green-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #11772a; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Dark Green (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-dimgrey-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #746c68; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Dimgrey</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-lime-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #37db11; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Lime (Acrylic)</div>
                                                            </div> 
                                                         </div>
                                                      </li>
                                                      
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-lime-green-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #00bc28; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Lime Green</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-slategrey-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #838690; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Slategrey (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-yellow-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #fdff00; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Yellow (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-blue-voilet-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #785cb4; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Blue voilet (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-cornflowerblue-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #5787ef; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Cornflowerblue</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-dark-red-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #b90003; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Dark Red (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox circle" name="futsalBrickRedKeyCheckbox" value="futsal-brick-dark-blue-circle">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #1100c4; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Dark Blue (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      
                                       
                                          
                                          
                                          <!-- end  -->
                                                      
                                       </div>

                                                   <!--=========================KEY=============================-->
                                                   <div id="key" class="tab-pane fade in active">
                                                      <!--Bright Blue Color-->
                                          <div id="key" class="tab-pane fade in active">
                                                      <!--Bright Blue Color-->
                                                   
                                       
                                       
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrightBlueKeyCheckbox" value="futsal-bright-blue-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #226fb4; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Aqua Blue (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Titanium Color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalDarkBlueKeyCheckbox" value="futsal-dark-blue-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #2d3d4c; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Storm Blue</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Steel Blue Color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalGreyKeyCheckbox" value="futsal-grey-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #8894a2; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Cloudy Grey</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Kiwi Color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalevergreenKeyCheckbox" value="futsal-evergreen-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #364b46; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Jungle Green</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Burgundy Color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalShamrockGreenKeyCheckbox" value="futsal-shamrock-green-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #3e7a3e; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Boston Green</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Sand Color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalGreenKeyCheckbox" value="futsal-green-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #6c9f64; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Feather Green</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Black color-->
                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalPearlOrangeKeyCheckbox" value="futsal-pearl-orange-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #fe6e49; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Pastel Orange</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <!--Purple color-->

                                                         <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalEarthKeyCheckbox" value="futsal-earth-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #745445; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Brown</div>
                                                            </div>
                                                         </div>
                                                      </li>


                                                      <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-red-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #9d4841; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Brick Red</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                          <!-- new section strt here  -->
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-dark-green-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #11772a; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Dark Green (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-dimgrey-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #746c68; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Dimgrey</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-lime-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #37db11; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Lime (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-lime-green-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #00bc28; display: inline-block;"></span>
                                                               <div style="display: inline-block;">LimeGreen</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-slategrey-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #838690; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Slategrey (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-yellow-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #fdff00; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Yellow (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-blue-voilet-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #785cb4; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Blue Voilet (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-cornflowerblue-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #5787ef; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Cornflowerblue</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-dark-red-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #b90003; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Dark Red (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                       
                                          <li>
                                                         <div class="Basketball" data-option-id="Basketball">
                                                            <input style="height: 30px!important; width: 34x!important;" type="checkbox" class="custom-checkbox inner" name="futsalBrickRedKeyCheckbox" value="futsal-brick-dark-blue-key">
                                                            <div class="dropdown">
                                                               <span class="color-preview dropdown_btn" style="background-color: #1100c4; display: inline-block;"></span>
                                                               <div style="display: inline-block;">Dark Blue (Acrylic)</div>
                                                            </div>
                                                         </div>
                                                      </li>
                                          
                                          
                                          
                                          
                                          
                                          <!-- end  -->
                                       
                                       
                                                      
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </ul>
                           </div> &nbsp;&nbsp;&nbsp;
                                 <input type="checkbox" class="custom-checkbox" name="grass"
                                       id="grass">
                              <div class="dropdown">
                                    <div class="dropdown_btn ios-font">Grass</div>
                              </div>
                        </div>
                     </div>
                     </div>
                  </div>

               </div>
            </form>

            <!--=========================================== Start Bottom Area ======================================-->
            <div class="container2">
               <div class="position-img">
                  <div style="margin-right: 850px; margin-top: 60px; left: 0;">
                        <img style="position: absolute; width: 100%; z-index: 1;"
                           src="{{url('court-design\futsal\pu color futsal  border\14.png')}}">
                        <img style="position: absolute; width: 100%; z-index: 2;"
                           src="{{url('court-design\futsal\pu Colors surface _futsal\18.png')}}">

                        <div class="futsal">
                           <div id="default-left-mid-circle">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/1400/36x66_lines_23white_lines_middle_circle.png')}}">
                        </div>

                        <div id="futsal-bright-blue-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/bright-blue-circle.png')}}">
                        </div> 

                        <div id="futsal-dark-blue-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/bright-blue-circleeeeeeee.png')}}">
                        </div> 

                        <div id="futsal-grey-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/grey-circle.png')}}">
                        </div> 

                           <div id="futsal-evergreen-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/jgreen-circle.png')}}">
                        </div> 

                           <div id="futsal-shamrock-green-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/bgreen-circle.png')}}">
                        </div> 

                           <div id="futsal-green-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/fgreen-circle.png')}}">
                        </div> 

                        <div id="futsal-purple-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/pearl-orange-circle.png')}}">
                        </div> 

                        <div id="futsal-earth-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/brown-circle.png')}}">
                        </div> 

                        <div id="futsal-brick-red-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/br-circle.png')}}">
                     
                        </div>
                  
                  
                  
                  <!-- new section start here  -->
                  
                  
                  <div id="futsal-brick-dark-green-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/dark-green-circle.png')}}">
                     
                        </div>
                  
                  
                  <div id="futsal-brick-dimgrey-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/dimgrey-circle.png')}}">
                     
                        </div>
                  
                  <div id="futsal-brick-lime-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/lime-circle.png')}}">
                     
                        </div>
                  
                  <div id="futsal-brick-lime-green-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/lime-green-circle.png')}}">
                     
                        </div>
                  
                  <div id="futsal-brick-slategrey-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/slategrey-circle.png')}}">
                     
                        </div>
                  
                  <div id="futsal-brick-yellow-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/yellow-circle.png')}}">
                     
                        </div>
                  <div id="futsal-brick-blue-voilet-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/blue-voilet-circle.png')}}">
                     
                        </div>
                  <div id="futsal-brick-cornflowerblue-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/cornflowerblue-circle.png')}}">
                     
                        </div>
                  <div id="futsal-brick-dark-red-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/dark-red-circle.png')}}">
                     
                        </div>
                  
                  <div id="futsal-brick-dark-blue-circle-left-court" style="display:none;">
                           <img class="bp-futsal-white-line-middle" style="width:77%;"  src="{{url('court-design/court_images/futsal-court/dark-blue-circle.png')}}">
                     
                        </div>
                  
                  
                  
                  
                  
                  <!-- end  -->


                     </div>

                        <!--XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX PREDESIGN COURT XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-->
                        <!--================= Futsal 2 ====================-->
                        <!--================================Hockey/Futsal================================-->
                        <!--Hockey/Futsal LEFT-->
                        <div class="futsalelecttwo box">
                           <img class="fp-hockey-futsal-left" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_goal_l.png')}}">
                        </div>
                        <!--Hockey/Futsal RIGHT-->
                        <div class="futsalelecttwo box">
                           <img class="fp-hockey-futsal-right" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_goal_r.png')}}">
                        </div>
                        <!--Hockey/Futsal White Line Left-->
                        <div class="futsalelecttwo box">
                           <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_lines_white_lines_goal_l.png')}}">
                        </div>
                        <!--Hockey/Futsal White Line Right-->
                        <div class="futsalelecttwo box">
                           <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_lines_white_lines_goal_r.png')}}">
                        </div>

                        <!--================================Rebounder================================-->
                        <!--Rebounder LEFT-->
                        <div class="futsalelecttwo box">
                           <img class="fp-rebounder-left" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_rebounder_l.png')}}">
                        </div>
                        <!--Rebounder RIGHT-->
                        <div class="futsalelecttwo box">
                           <img class="fp-rebounder-right" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_rebounder_r.png')}}">
                        </div>

                        <!--================================Light================================-->
                        <div class="futsalelecttwo box">
                           <img class="fp-light" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_single_lights.png')}}">
                        </div>

                        <!--================================Fence================================-->
                        <!--Fence LEFT-->
                        <div class="futsalelecttwo box">
                           <img class="fp-fence-left" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_fence_l.png')}}">
                        </div>
                        <!--fence TOP-->
                        <div class="futsalelecttwo box">
                           <img class="fp-fence-top" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_fence_b.png')}}">
                        </div>
                        <!--fence RIGHT-->
                        <div class="futsalelecttwo box">
                           <img class="fp-fence-right" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_fence_r.png')}}">
                        </div>

                        <!--================= Futsal 1 ====================-->
                        <!--================================Hockey/Futsal================================-->
                        <!--Hockey/Futsal LEFT-->
                        <div class="futsalselectone box">
                           <img class="fp-hockey-futsal-left" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_goal_l.png')}}">
                        </div>
                        <!--Hockey/Futsal RIGHT-->
                        <div class="futsalselectone box">
                           <img class="fp-hockey-futsal-right" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_goal_r.png')}}">
                        </div>
                        <!--Hockey/Futsal White Line Left-->
                        <div class="futsalselectone box">
                           <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_lines_white_lines_goal_l.png')}}">
                        </div>
                        <!--Hockey/Futsal White Line Right-->
                        <div class="futsalselectone box">
                           <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_lines_white_lines_goal_r.png')}}">
                        </div>

                        <!--================================Light================================-->
                        <div class="futsalselectone box">
                           <img class="fp-light" style="width: 100%;"
                                 src="{{url('court-design/court_images/1400/50x100_court-elements_single_lights.png')}}">
                        </div>


                        

                        <!--======================================================= End Predesign =========================================================-->


                        <!--XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX BORDER COLOR XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-->

                        <div class="border-aqua-blue box border-box">
                           <img class="fp-basketball-border" style=" width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_232728_border.png')}}">
                        </div>

                        <div class="border-dark-blue box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_darkblue_border.png')}}">
                        </div>

                        <div class="border-grey box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_grey_border.png')}}">
                        </div>

                        <div class="border-evergreen box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_jgreen_border.png')}}">
                        </div>

                        <div class="border-shamrock-green box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_bgreen_border.png')}}">
                        </div>

                        <div class="border-pearl-orange box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_porange_border.png')}}">
                        </div>

                        <div class="border-green box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_fgreen_border.png')}}">
                        </div>

                        <div class="border-earth box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_brown_border.png')}}">
                        </div>

                        <div class="border-brick-red box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_bred_border.png')}}">
                        </div>
               
               <!-- futsal  border serction start here  -->
               
               
               <div class="border-brick-dark-blue box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-dark-blue.png')}}">
                        </div>
               
               <div class="border-brick-dark-green box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-dark-green.png')}}">
                        </div>
               
               <div class="border-brick-dark- box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-dark-blue.png')}}">
                        </div>
               
               <div class="border-brick-dimgrey box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-dimgrey.png')}}">
                        </div>
               
               <div class="border-brick-lime box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-lime.png')}}">
                        </div>
               
               
               <div class="border-brick-lime-green box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-lime-green.png')}}">
                        </div>
               
               <div class="border-brick-slatgrey box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-slatgrey.png')}}">
                        </div>
               
               <div class="border-brick-yellow box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-yellow.png')}}">
                        </div>
               
               <div class="border-brick-blue-voilet box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-blue-voilet.png')}}">
                        </div>
               
               <div class="border-brick-cornflowerblue box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-cornflowerblue.png')}}">
                        </div>
               
               <div class="border-brick-dark-red box border-box">
                           <img class="fp-basketball-border" style="width: 100%; z-index: 1;top: -2px;"
                                 src="{{url('court-design/court_images/1400/border-futsal-dark-red.png')}}">
                        </div>
               
               
               
                     
                     
                  
                        <!-- end  -->
                        <!--XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX SURFACE COLOR XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-->
                        <!--================== Surface Blue<div class="surface-bright-blue box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_232728_surface.png')}}">
                        </div> ==================-->
                        
                        <!-- Surface BLue End -->
                        


                        <div class="surface-bright-blue box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_232728_surface.png')}}">
                        </div>

                     
                        <div class="surface-dark-blue box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_23289_surface.png')}}">
                        </div>
                     
                        <div class="surface-grey box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_23430_surface.png')}}">
                        </div>
                        

                     
                        <div class="surface-evergreen box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_233308_surface.png')}}">
                        </div>
                     

                  
                        <div class="surface-shamrock-green box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_23359_surface.png')}}">
                        </div>
                     
                        <div class="surface-pearl-orange box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_23164_surface.png')}}">
                        </div>
                        
                        <div class="surface-green box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_23357_surface.png')}}">
                        </div>
                     

                     
                        <div class="surface-earth box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_23154_surface.png')}}">
                        </div>
                     
                        <div class="surface-brick-red box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                                 src="{{url('court-design/court_images/1400/50x100_surfaces_231817_surface.png')}}">
                        </div>
               
               <!-- new images add section start here  -->
                        <div class="surface-blue box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                              src="{{url('court-design/court_images/1400/surface_blue.png')}}">
                        </div>
               
               
                  <div class="surface-cornflowerblue box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                              src="{{url('court-design/court_images/1400/surface_cornflowerblue.png')}}">
                        </div>
               
               
                  <div class="surface-dark_red box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                              src="{{url('court-design/court_images/1400/surface_dark_red.png')}}">
                        </div>
               
               
                  <div class="surface-dimgrey box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                              src="{{url('court-design/court_images/1400/surface_dimgrey.png')}}">
                        </div>
               
                  <div class="surface-lime box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                              src="{{url('court-design/court_images/1400/surface_lime.png')}}">
                        </div>
               
                  <div class="surface-lime-green box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                              src="{{url('court-design/court_images/1400/surface_lime_green.png')}}">
                        </div>
               
                  <div class="surface-slategrey box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                              src="{{url('court-design/court_images/1400/surface_slategrey.png')}}">
                        </div>
               
                  <div class="surface-yellow box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                              src="{{url('court-design/court_images/1400/surface_yellow.png')}}">
                        </div>
               
                  <div class="surface-dark-green box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                              src="{{url('court-design/court_images/1400/surface_dark_green.png')}}">
                        </div>
               
               
                  <div class="surface-blue-voilet box surface-box">
                           <img class="fp-basketball-surface" style="width: 100%; z-index: 3;"
                              src="{{url('court-design/court_images/1400/surface_blue_voilet.png')}}">
                        </div>
               
            
               
               
               <!-- end  -->
                     
                  </div>
                  
                  <div id="fp-hockey-futsal-show-element">
                        <img class="fp-hockey-futsal-left" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/50x100_court-elements_goal_l.png')}}">
                        <img class="fp-hockey-futsal-right" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/50x100_court-elements_goal_r.png')}}">

                        <div id="default_left-court">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/50x100_lines_white_lines_goal_l.png')}}">
                        <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/50x100_lines_white_lines_goal_r.png')}}">
                        </div>  

                        <div id="futsal-bright-blue-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/bright-blue-l.png')}}">
                        <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/bright-blue-r.png')}}">
                        </div> 


                        <div id="futsal-dark-blue-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/dark-blue-l.png')}}">
                        <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/dark-blue-r.png')}}">
                        </div> 


                        <div id="futsal-grey-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/grey-l.png')}}">
                        <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/grey-r.png')}}">
                        </div> 

                        <div id="futsal-evergreen-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/evergreen-l.png')}}">
                        <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/evergreen-r.png')}}">
                        </div>

                        <div id="futsal-shamrock-green-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/shamrock-green-l.png')}}">
                        <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/shamrock-green-r.png')}}">
                        </div> 


                        <div id="futsal-green-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/green-l.png')}}">
                        <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/green-r.png')}}">
                        </div> 

                        <div id="futsal-pearl-orange-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/pearl-orange-l.png')}}">
                        <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/pearl-orange-r.png')}}">
                        </div> 

                        <div id="futsal-earth-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/earth-l.png')}}">
                        <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/earth-r.png')}}">
                        </div> 

                           <div id="futsal-brick-red-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-red-l.png')}}">
                        <img class="fp-hockey-futsal-white-line-right" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-red-r.png')}}">
                        </div> 
                  
                  <!-- new section start here  -->
                  
                  <div id="futsal-brick-dark-green-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-dark-green.png')}}">
                     
                        </div> 
                  
                  <div id="futsal-brick-dimgrey-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-dimgrey.png')}}">
                     
                        </div> 
                  
                  <div id="futsal-brick-lime-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-lime.png')}}">
                     
                        </div> 
                  
                  <div id="futsal-brick-lime-green-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-lime-green.png')}}">
                     
                        </div> 
                  
                  <div id="futsal-brick-slategrey-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-slategrey.png')}}">
                     
                        </div> 
                  
                  <div id="futsal-brick-yellow-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-yellow.png')}}">
                     
                        </div> 
                  
                  <div id="futsal-brick-blue-voilet-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-blue-voilet.png')}}">
                     
                        </div> 
                  
                  <div id="futsal-brick-cornflowerblue-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-cornflowerblue.png')}}">
                     
                        </div> 
                  
                  <div id="futsal-brick-dark-red-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-dark-red.png')}}">
                     
                        </div> 
                  
                  <div id="futsal-brick-dark-blue-key-left-court" style="display: none;">
                        <img class="fp-hockey-futsal-white-line-left" style="width: 100%;"
                           src="{{url('court-design/court_images/futsal-court/brick-dark-blue.png')}}">
                     
                        </div> 

                        
                        <!-- end  -->

                  </div>
                  <!--Hockey/Futsal RIGHT-->

                  


                  <!--================================Rebounder================================-->
                  <!--Rebounder LEFT-->
                  <div id="fp-rebounder-show-element">
                        <!--Rebounder LEFT-->
                        <img class="fp-rebounder-left" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/50x100_court-elements_rebounder_l.png')}}">
                        <!--Rebounder RIGHT-->
                        <img class="fp-rebounder-right" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/50x100_court-elements_rebounder_r.png')}}">
                  </div>


                  <!--================================Light================================-->
                  <div id="fp-light-show-element">
                        <img class="fp-light" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/50x100_court-elements_single_lights.png')}}">
                  </div>

                  <!--================================Fence================================-->
                  <!--Fence LEFT-->
                  <div class="molt show-fence">
                        <img class="fp-fence-left" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/50x100_court-elements_fence_l.png')}}">
                  </div>
                  <!--fence TOP-->
                  <div class="molt show-fence">
                        <img class="fp-fence-top" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/50x100_court-elements_fencennnnn.png')}}">
                  </div>
                  <!--fence RIGHT-->
                  <div class="molt show-fence">
                        <img class="fp-fence-right" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/50x100_court-elements_fence_r.png')}}">
                  </div>
                  <!--fence BOTTOM-->
                  <div class="molt show-fence">
                        <img class="fp-fence-bottom" style="width: 100%;"
                           src="{{url('court-design/court_images/1400/52x86_court-elements_fence_bbb.png')}}">
                  </div>
               </div>
            </div>


      </div>
   </div>
   <p class="form_title ios-font" style="margin-left: 185px;">Top View</p><br><br>
   <div class="col-md-5 col-sm-5" >
      <div id="outer_div">
         <div id="main_div">
            <div id="colorbig">
               <div id="default">
                     <img  src="{{url('court-design/court_images/1400/futsal-court2.png')}}" class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;z-index:-1"> <br>
               </div>  

               <div  class="fut" id="futsal-bright-blue-key" style="display: none; position:relative;">
                     <img class="img-responsive"
                     style="background-color:#d0112b;z-index:-1" src="{{url('court-design/court_images/futsal-court/bright-blue.png')}}">
                     
               </div> 


               <div  class="futcir" id="futsal-bright-blue-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width: 374px;background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/bright-blue-rd.png')}}">
               </div> 




               <div class="fut"  id="futsal-dark-blue-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#2d3d4c;" src="{{url('court-design/court_images/futsal-court/dark-blue.png')}}">
               </div> 

               <div  class="futcir" id="futsal-dark-blue-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/steel-blue-rd.png')}}">
               </div> 


               

               <div  class="fut"  id="futsal-grey-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/grey.png')}}">
               </div> 

               <div  class="futcir" id="futsal-grey-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/grey-rd.png')}}">
               </div> 


                  <div  class="fut"  id="futsal-evergreen-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/evergreen.png')}}">
               </div> 

               <div  class="futcir" id="futsal-evergreen-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/evergreen-rd.png')}}">
               </div> 



                  <div  class="fut"  id="futsal-shamrock-green-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/shamrock-green.png')}}">
               </div> 

               <div  class="futcir" id="futsal-shamrock-green-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-green-rd.png')}}">
               </div> 


                  <div  class="fut"  id="futsal-green-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/shamrock-green.png')}}">
               </div> 

               <div  class="futcir" id="futsal-green-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/green-rd.png')}}">
               </div> 


               <div  class="fut"  id="futsal-pearl-orange-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/pearl-orange.png')}}">
               </div> 

               <div  class="futcir" id="futsal-purple-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/pearl-orange-rd.png')}}">
               </div> 


               <div  class="fut"  id="futsal-earth-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/brown.png')}}">
               </div> 

               <div  class="futcir" id="futsal-earth-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/earth-rd.png')}}">
               </div> 

            
               <div  class="fut"  id="futsal-brick-red-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/brick-red.png')}}">
               </div> 
         
         
            
         

                  <!-- key-new section start here  -->
            
               <div  class="fut"  id="futsal-brick-dark-green-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/futsal-dark-green.png')}}">
               </div> 
         
            <div  class="fut"  id="futsal-brick-dimgrey-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/futsal-dimgrey.png')}}">
               </div> 
         
            <div  class="fut"  id="futsal-brick-lime-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/futsal-lime.png')}}">
               </div> 
         
            <div  class="fut"  id="futsal-brick-lime-green-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/futsal-lime-green.png')}}">
               </div> 
         
            <div  class="fut"  id="futsal-brick-slategrey-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/futsal-slategrey.png')}}">
               </div> 
         
            <div  class="fut"  id="futsal-brick-yellow-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/futsal-yellow.png')}}">
               </div> 
         
            <div  class="fut"  id="futsal-brick-blue-voilet-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/futsal-blue-voilet.png')}}">
               </div> 
         
            <div  class="fut"  id="futsal-brick-cornflowerblue-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/futsal-cornflowerblue.png')}}">
               </div> 
         
            <div  class="fut"  id="futsal-brick-dark-red-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/futsal-dark-red.png')}}">
               </div> 
         
            <div  class="fut"  id="futsal-brick-dark-blue-key" style="display: none; position:relative;">
                  <img class="img-responsive"
                     style="margin-bottom: -20px; background-color:#d0112b;" src="{{url('court-design/court_images/futsal-court/futsal-blue.png')}}">
               </div> 
         
         
            
            
            <!-- end  -->

               <div  class="futcir" id="futsal-brick-red-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/brick-red-rd.png')}}">
               </div> 
               
            <!-- circle section strat here  -->
               <div  class="futcir" id="futsal-brick-dark-green-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-dark-green.png')}}">
               </div> 
         
            <div  class="futcir" id="futsal-brick-dimgrey-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-dimgrey.png')}}">
               </div> 
         
            <div  class="futcir" id="futsal-brick-lime-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-lime.png')}}">
               </div> 
         
            <div  class="futcir" id="futsal-brick-lime-green-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-lime-green.png')}}">
               </div> 
         
            <div  class="futcir" id="futsal-brick-slategrey-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-slategrey.png')}}">
               </div> 
         
            <div  class="futcir" id="futsal-brick-yellow-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-yellow.png')}}">
               </div> 
         
            <div  class="futcir" id="futsal-brick-blue-voilet-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-blue-voilet.png')}}">
               </div> 
         
            <div  class="futcir" id="futsal-brick-cornflowerblue-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-cornflowerblue.png')}}">
               </div> 
            <div  class="futcir" id="futsal-brick-dark-red-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-dark-red.png')}}">
               </div> 
            <div  class="futcir" id="futsal-brick-dark-blue-circle" style="display: none;">
                     <img class="img-responsive"
                     style="z-index: 9999;position: absolute;top: 52px;left: 63px;width:374px;" src="{{url('court-design/court_images/futsal-court/shamrock-dark-blue.png')}}">
               </div> 
            
            
            
            
            <!-- end  -->
         
         
               <div class="set">
               <img src="{{url('court-design/assets/watermark.png')}}"    id="watermark" style="position: absolute;top: 27px;left: 10px;width: 100%;display: none;">
               </div>
            </div>
         </div>
         </div>  
      <input id="btn-Preview-Image" class="btn btn-sm btn-primary" style="margin-top: 10px;margin-left: 45%"
               type="button" value="Download"/>
         <canvas id="canvas" width=300 height=300 style="display: none;"></canvas>

      <a style="display:none;" id="btn-Convert-Html2Image" href="#">Download</a>
   </div>
</div>
@endsection
@push('script')
   <script>
      $(document).ready(function () {
         $(".group1").colorbox({rel: 'group1'});
      });
   </script>
   <script type="text/javascript">
      $('input[name="grass"]').click(function(){
         if($('input[name="grass"]').is(':checked')){
            $('.surface-box').hide();
            $('.border-box').hide();
            $('.fut').hide();
            $('#fp-hockey-futsal-show-element').hide();
            $('.border-shamrock-green').show();
            $('.surface-shamrock-green').show();
            $('#futsal-shamrock-green-circle-left-court').show();
            $('#futsal-shamrock-green-key').show();
            $('#futsal-shamrock-green-circle').show();
            $('#futsal-shamrock-green-circle img').css('background-color','rgb(62, 122, 62)');
            $('.surface').each(function() {
            $(this).prop("disabled", true);
            });

            $('.border').each(function() {
               $(this).prop("disabled", true);
            });
            

            $('.inner').each(function() {
               $(this).prop("disabled", true);
            });
      
         }else{
            location.reload();
         }
      });
   </script>  
   <script>
      $(function () {
         $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
               $(".show-fence").hide();
               $(".show-fence").show();
            } else {
               $(".show-fence").show();
               $(".show-fence").hide();
            }
         });
      });
   </script>
    <script>
      function toggleColorSection() {
          // Get the selected option value
          const selectedValue = document.getElementById("color-selector").value;

          // Hide both PU and Acrylic sections (surface and border)
          document.getElementById("pu-surface-colors").style.display = 'none';
          document.getElementById("pu-border-colors").style.display = 'none';
          document.getElementById("acrylic-surface-colors").style.display = 'none';
          document.getElementById("acrylic-border-colors").style.display = 'none';

          // Show the corresponding sections based on the selected value
          if (selectedValue === 'pu-colors') {
              document.getElementById("pu-surface-colors").style.display = 'block';
              document.getElementById("pu-border-colors").style.display = 'block';

          } else if (selectedValue === 'acrylic-colors') {
              document.getElementById("acrylic-surface-colors").style.display = 'block';
              document.getElementById("acrylic-border-colors").style.display = 'block';
          }
      }
  </script>
@endpush