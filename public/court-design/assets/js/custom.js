/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


/*Display Image When Checkbox in Checked*/
$(document).ready(function(){
    //  $('input[type="checkbox"]').click(function(){
    //     var classname = $(this).attr("class");
    //     if(classname==='custom-checkbox border') {
    //         $('input[class="custom-checkbox border"]').not(this).prop('checked', false);
    //         if ($('input[class="custom-checkbox border"]').is(':checked')) {
    //             var inputValue = $(this).attr("value");
    //             if (inputValue != 'border-titanium') {
    //                 $(".border-titanium").hide();
    //             }
    //             $('.border-box').hide();
    //             $("." + inputValue).show();
    //             var bg = $('#' + inputValue).css('backgroundColor');
    //             $('#colorbig').css('background-color', bg);
    //         } else {
    //             var inputValue = $(this).attr("value");
    //             $("." + inputValue).hide();
    //             // alert(inputValue);

    //             $(".border-titanium").show();
    //             $('#colorbig').css('background-color', '#5a6771');


    //         }
    //     }else if(classname==='custom-checkbox surface'){
    //         $('input[class="custom-checkbox surface"]').not(this).prop('checked', false);
    //         if($('input[class="custom-checkbox surface"]').is(':checked')){
    //             var inputValue = $(this).attr("value");
    //             if(inputValue!=='surface-bright-red'){
    //                 $(".surface-bright-red").hide();
    //             }
    //             $('.surface-box').hide();
        
    //             $("." + inputValue).show();

            
    //             var bg=$('#'+inputValue).css('backgroundColor');


    //             $('#colorbig img').css('background-color',bg);
    //         }else{
    //             var inputValue = $(this).attr("value");
    //             $("." + inputValue).hide();
    //             $(".surface-bright-red").show();
    //             $('#colorbig img').css('background-color','#D0112B');
    //         }
    //     }else{
    //         var inputValue = $(this).attr("value");
    //         $("." + inputValue).toggle();
    //     }

    // });




 $('input[type="checkbox"]').click(function(){
         $('.loadingOverlay').show();
        var classname = $(this).attr("class");
        if(classname==='custom-checkbox border') {
            $('input[class="custom-checkbox border"]').not(this).prop('checked', false);
            if ($('input[class="custom-checkbox border"]').is(':checked')) {
                var inputValue = $(this).attr("value");
                inputValue = inputValue.replace("border", "surface");

                if(inputValue!=='surface-bright-red'){
                    $(".surface-bright-red").hide();
                }
                $('.surface-box').hide();
        
                $("." + inputValue).show();
               
                var bg=$('#'+inputValue).css('backgroundColor');
                
                $('#main_div').css('background-color',bg);

            } else {
                

            }
        }else if(classname==='custom-checkbox surface'){
            $('input[class="custom-checkbox surface"]').not(this).prop('checked', false);
            if($('input[class="custom-checkbox surface"]').is(':checked')){
                var inputValue = $(this).attr("value");
                // alert(inputValue);
                // return false;
                $(".surfacenew").hide();
                $("."+inputValue+"-new").show();

                var bg=$('#'+inputValue).css('backgroundColor');
                $('#colorbig img').css('background-color',bg);
            }else{
                
            }
        }else{
            var inputValue = $(this).attr("value");
            $("." + inputValue).toggle();
        }

          $('.loadingOverlay').fadeOut(1000);

    });

});


   var element = $("#outer_div").html(); // global variable
    var getCanvas; // global variable
    $("#btn-Preview-Image").on('click', function () {
        html2canvas($("#outer_div")[0]).then(function(canvas) {
       // $("#previewImage").append(canvas);
         var imgageData = canvas.toDataURL("image/png");
    // Now browser starts downloading it instead of just showing it
       var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
        var a=$("#btn-Convert-Html2Image").attr("download", "your_court.png").attr("href", newData); 
        a[0].click();
       });
    });



// ==================================================Basketball Page=======================================================
// /*Display Basketball Image By Default When Refresh*/
$(function() {
    $('input[name=name-basketball]').on('click init-post-format', function() {
        $('#bp-basketball-show-element').toggle($('#bp-basketball-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});


// /*Display Light Image By Default When Refresh*/
$(function() {
    $('input[name=name-light]').on('click init-post-format', function() {
        $('#bp-light-show-element').toggle($('#bp-light-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});


// /*Display Rebounder Image By Default When Refresh*/
$(function() {
    $('input[name=name-rebounder]').on('click init-post-format', function() {
        $('#bp-rebounder-show-element').toggle($('#bp-rebounder-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

// ======================= Fence ===============================
// /*Display Fence Image By Default When Refresh*/
// LEFT
$(function() {
    $('input[name=bp-left-fence]').on('click init-post-format', function() {
        $('#bp-left-fence-show-element').toggle($('#bp-left-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

// TOP
$(function() {
    $('input[name=bp-top-fence]').on('click init-post-format', function() {
        $('#bp-top-fence-show-element').toggle($('#bp-top-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

// Right
$(function() {
    $('input[name=bp-right-fence]').on('click init-post-format', function() {
        $('#bp-right-fence-show-element').toggle($('#bp-right-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

//BOTTOM
$(function() {
    $('input[name=bp-bottom-fence]').on('click init-post-format', function() {
        $('#bp-bottom-fence-show-element').toggle($('#bp-bottom-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});


// ==================================================Multisport Page=======================================================
// /*Display Basketball */
//TOP
$(function() {
    $('input[name=mp-name-basketball]').on('click init-post-format', function() {
        $('#mp-basketball-show-element').toggle($('#mp-basketball-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

// /*Display Racquet Sports */
//TOP
$(function() {
    $('input[name=mp-name-racquet-sports]').on('click init-post-format', function() {
        $('#mp-racquet-sports-show-element').toggle($('#mp-racquet-sports-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

//Display Rebounder 
$(function() {
    $('input[name=mp-name-rebounder]').on('click init-post-format', function() {
        $('#mp-rebounder-show-element').toggle($('#mp-rebounder-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

//Display Light
$(function() {
    $('input[name=mp-name-light]').on('click init-post-format', function() {
        $('#mp-light-show-element').toggle($('#mp-light-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

// ======================= Fence ===============================
// /*Display Fence Image By Default When Refresh*/
// LEFT
$(function() {
    $('input[name=mp-left-fence]').on('click init-post-format', function() {
        $('#mp-left-fence-show-element').toggle($('#mp-left-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

// TOP
$(function() {
    $('input[name=mp-top-fence]').on('click init-post-format', function() {
        $('#mp-top-fence-show-element').toggle($('#mp-top-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

// Right
$(function() {
    $('input[name=mp-right-fence]').on('click init-post-format', function() {
        $('#mp-right-fence-show-element').toggle($('#mp-right-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

//BOTTOM
$(function() {
    $('input[name=mp-bottom-fence]').on('click init-post-format', function() {
        $('#mp-bottom-fence-show-element').toggle($('#mp-bottom-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});




// ==================================================Futsal Page=======================================================
// Hockey
$(function() {
    $('input[name=fp-name-hockey-futsal]').on('click init-post-format', function() {
        $('#fp-hockey-futsal-show-element').toggle($('#fp-hockey-futsal-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

//Light
$(function() {
    $('input[name=fp-name-light]').on('click init-post-format', function() {
        $('#fp-light-show-element').toggle($('#fp-light-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

// Rebounder
$(function() {
    $('input[name=fp-name-rebounder]').on('click init-post-format', function() {
        $('#fp-rebounder-show-element').toggle($('#fp-rebounder-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

//=====================================================================================================
//Fence Left
$(function() {
    $('input[name=fp-left-fence]').on('click init-post-format', function() {
        $('#fp-left-fence-show-element').toggle($('#fp-left-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

//Fence Top
$(function() {
    $('input[name=fp-top-fence]').on('click init-post-format', function() {
        $('#fp-top-fence-show-element').toggle($('#fp-top-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

//Fence Right
$(function() {
    $('input[name=fp-right-fence]').on('click init-post-format', function() {
        $('#fp-right-fence-show-element').toggle($('#fp-right-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

//Fence Bottom
$(function() {
    $('input[name=fp-bottom-fence]').on('click init-post-format', function() {
        $('#fp-bottom-fence-show-element').toggle($('#fp-bottom-fence-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});


// ==================================================Badminton Page=======================================================
// Hockey
$(function() {
    $('input[name=bmp-name-hockey-futsal]').on('click init-post-format', function() {
        $('#bmp-hockey-futsal-show-element').toggle($('#bmp-hockey-futsal-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

// Rebounder
$(function() {
    $('input[name=bmp-name-rebounder]').on('click init-post-format', function() {
        $('#bmp-rebounder-show-element').toggle($('#bmp-rebounder-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});


// Light
$(function() {
    $('input[name=bmp-name-light]').on('click init-post-format', function() {
        $('#bmp-light-show-element').toggle($('#bmp-light-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});


// ==================================================Volleyball Page=======================================================
// Light
$(function() {
    $('input[name=vp-name-light]').on('click init-post-format', function() {
        $('#vp-light-show-element').toggle($('#vp-light-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});

//Volleyball
$(function() {
    $('input[name=vp-name-volleyball]').on('click init-post-format', function() {
        $('#vp-volleyball-show-element').toggle($('#vp-volleyball-input-checkbox').prop('checked'));
    }).trigger('init-post-format');
});




$(document).ready(function() {
    $("input[name$='cars']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#Cars" + test).show();
    });
});
