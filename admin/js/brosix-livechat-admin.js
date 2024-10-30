(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	var network_id=0;
	var network_name = 'no network';
	var livechat_status = 'off';
	var oldID = $("#chatID").html();
	var oldNetwork = $("#networkName").html();
	
	function CheckChatStatus(){
		 var chat_status_api =0;
	   	var api_key = $('#api-key').text($(this).val());
		if(api_key != null){
	   api_key = api_key[0].value;
		      if($("#chatstatus").prop("checked")==true){
	   if(String(api_key).length == 32){
	   	   $.ajax({
			 type : "post",
			 dataType : "json",
			  async: false,
			 url : myAjax.ajaxurl,
			 data : {action: "brosix_get_data_from_api",security: myAjax.security, api_key : api_key},
			 success: function(data) {
				 chat_status_api=data.chat_status;
			 }
		  });
		   
		   if(chat_status_api ==0){ $('.network-warning').show(); }
		   else{ $('.network-warning').hide(); }
	  		 }
			}
		}
	};
		
	$(document).ready( function() {
		
		   $(".network-switch").on('click', function() {
			   $(".hide-after-reg .col-md-10").hide();
	   $(".hide-after-reg").toggle();
     });
		
   $("#chatstatus").on('click', function() {
      if($("#chatstatus").prop("checked")==true){
		  var chat_status =1;
		  $(".is-live").show().delay(100).fadeOut();
	  }else{
		  var chat_status =0;
		  $(".is-hidden").show().delay(500).fadeOut();
		  $('.network-warning').hide();
	  }
      $.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "update_brosix_chat_status",security: myAjax.security, chat_status : chat_status},
         success: function(response) {
               console.log(response);
         }
      });
	   if (chat_status == 1){
		   $("#chatvisibility").html("Enabled");
		   CheckChatStatus();
	   }else{
		   $("#chatvisibility").html("Disabled");
	   }
	  
   });
		
		   $("#homestatus").on('click', function() {
      if($("#homestatus").prop("checked")==true){
		  var home_status =1;
	  }else{
		  var home_status =0;
	  }
      $.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "update_brosix_home_status",security: myAjax.security, home_status : home_status},
         success: function(response) {
               console.log(response);
         }
      });
   });
		
   $("#api-save").on('click', function() {
	   	var api_key = $('#api-key').text($(this).val());
	   	var chat_id = '';
		var chat_network = '';
	    var chat_status = '';
	   	var valid_key = 2;
	   api_key = api_key[0].value;
	   if(String(api_key).length == 32){
	   $.ajax({
			 type : "post",
			 dataType : "json",
			  async: false,
			 url : myAjax.ajaxurl,
			 data : {action: "brosix_get_data_from_api",security: myAjax.security, api_key : api_key},
		    beforeSend: function() { 
			jQuery('#api-save').css({
        	paddingRight: '36px'
			});
	   		jQuery(".lds-hourglass").show();
			},
			 success: function(data) {
				 chat_id=data.chat_id;
				 chat_network=data.chat_network;
				 chat_status=data.chat_status;
				 valid_key = data.valid_key;
				 console.log(chat_id);
				 console.log(chat_network);
				 console.log(chat_status);
				 console.log(valid_key);
			 }
		  });
			if(valid_key == 1){
		  $.ajax({
			 type : "post",
			 dataType : "json",
			  async: false,
			 url : myAjax.ajaxurl,
			 data : {action: "update_brosix_chat_id",security: myAjax.security, chat_id : chat_id, chat_network : chat_network},
			 success: function() {

			 }
		  });
	$('#api-save').animate({
        paddingRight: '12px'
			});
	   $(".lds-hourglass").fadeOut( 100 );
	$("#chatID").html(chat_id);
	$("#networkName").html(chat_network);
	$(".save-first-time-id").fadeIn( 400 );
	$(".hide-after-reg").hide();
	$(".admin-container").show();
				}else {
					$('#api-save').animate({
      				  paddingRight: '12px'
						});
	  			    $(".lds-hourglass").fadeOut( 100 );
				jQuery(".wrong-api-key").show();
				}
	   }
	   else{
				jQuery(".wrong-api-key").show();
	   }
	   
   });
});
	
	
var TabBlock = {
  s: {
    animLen: 200
  },
  
  init: function() {
    TabBlock.bindUIActions();
    TabBlock.hideInactive();
  },
  
  bindUIActions: function() {
    $('.tabBlock-tabs').on('click', '.tabBlock-tab', function(){
      TabBlock.switchTab($(this));
    });
  },
  
  hideInactive: function() {
    var $tabBlocks = $('.tabBlock');
    
    $tabBlocks.each(function(i) {
      var 
        $tabBlock = $($tabBlocks[i]),
        $panes = $tabBlock.find('.tabBlock-pane'),
        $activeTab = $tabBlock.find('.tabBlock-tab.is-active');
      
      $panes.hide();
      $($panes[$activeTab.index()]).show();
    });
  },
  
  switchTab: function($tab) {
    var $context = $tab.closest('.tabBlock');
    
    if (!$tab.hasClass('is-active')) {
      $tab.siblings().removeClass('is-active');
      $tab.addClass('is-active');
   
      TabBlock.showPane($tab.index(), $context);
    }
   },
  
  showPane: function(i, $context) {
    var $panes = $context.find('.tabBlock-pane');
   
    $panes.slideUp(TabBlock.s.animLen);
    $($panes[i]).slideDown(TabBlock.s.animLen);
  }
};

$(function() {
  TabBlock.init();
});
	

})( jQuery );