<!--------accordian script start ------->
$(document).ready(function() {
	 
	//ACCORDION BUTTON ACTION (ON CLICK DO THE FOLLOWING)
	$('.accordionButton').click(function() {
		$('.accordionButton').removeClass('accordion-btn-active');		  
	 	$('.accordionContent').slideUp('normal');
		if($(this).next().is(':hidden') == true) 
		{
			$(this).addClass('accordion-btn-active');
			$(this).next().slideDown('normal');
		 } 		  
	 });
	  
	/*** REMOVE IF MOUSEOVER IS NOT REQUIRED ***/
	//ADDS THE .OVER CLASS FROM THE STYLESHEET ON MOUSEOVER 
	$('.accordionButton').mouseover(function() {
		$(this).addClass('over');
		
	//ON MOUSEOUT REMOVE THE OVER CLASS
	}).mouseout(function() {
		$(this).removeClass('over');										
    });
	
	/*** END REMOVE IF MOUSEOVER IS NOT REQUIRED ***/
	$('.accordionContent').hide();
	$('.accordionContent_default').show();
	
	 //var cid = getParameterByName('ctid');
     //var pid = getParameterByName('pid');
	 //$(".submenu_"+cid).show();
	 //alert('#menu_'+cid);  
	 //$("#menu_"+cid).addClass('accordion-btn-active');
	 //if(pid != '')
	 // {  
	//		pids = $('.sub_'+pid).parent().attr('id'); 
	//		 $("#"+pids).show();   
	//		var ret = pids.split("_");
	//		var str1 = ret[1];			 
	//		 $("#menu_"+str1).addClass('accordion-btn-active');
	 // }
});

<!-------accordian script end --------->