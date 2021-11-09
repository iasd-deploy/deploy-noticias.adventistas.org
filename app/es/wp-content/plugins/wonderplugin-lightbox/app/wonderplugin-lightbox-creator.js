(function($){
	$(document).ready(function() {
		
		// select image for custom images
		$('.wonderplugin-select-mediaimage').click(function() {
								
			var textId = $(this).data("textid");
							
			var media_uploader = wp.media.frames.file_frame = wp.media({
				title: "Select Image",
				library : { type : "image" },
				button: {
					text: "Select Image"
				},
				multiple: false
			});
			
			media_uploader.on("select", function(event) {
				
				var selection = media_uploader.state().get("selection");
				var attachment = selection.first().toJSON();
				if (attachment.type == "image")
				{	
					$( "#" + textId ).val( attachment.url );
				}
			});
			
			media_uploader.open();
		});
		
		var applyShownavigation = function() {
			if( $("#shownavigation").is(':checked') ) 
			{
				$('.shownavigation-options').removeClass('wonderplugin-disabled');
			}
			else
			{
				$('.shownavigation-options').addClass('wonderplugin-disabled');
			}
		};

		$("#shownavigation").click(function() {
			applyShownavigation();
		});

		var applyNavarrowspos = function() {
			if ( $("#navarrowspos").val() == 'inside' )
			{
				$('.navarrowspos-options').removeClass('wonderplugin-disabled');
			}
			else
			{
				$('.navarrowspos-options').addClass('wonderplugin-disabled');
			}
		};

		$("#navarrowspos").change(function() {
			applyNavarrowspos();
		});

		var applyShowsocial = function() {
			if( $("#showsocial").is(':checked') ) 
			{
				$('.showsocial-options').removeClass('wonderplugin-disabled');
			}
			else
			{
				$('.showsocial-options').addClass('wonderplugin-disabled');
			}
		};

		$("#showsocial").click(function() {
			applyShowsocial();
		});

		$('.wonderplugin-tab-buttons-horizontal').each(function() {
			
			$(this).find('li').each(function(index) {
				
				$(this).click(function(){
										
					if ( $(this).hasClass('wonderplugin-tab-button-horizontal-selected') )
						return;
					
					// switch button
					$(this).parent().find('li').removeClass('wonderplugin-tab-button-horizontal-selected');
					$(this).addClass('wonderplugin-tab-button-horizontal-selected');
					
					// switch panel
					var panelsID = $(this).parent().data('panelsid');	
					$('#' + panelsID).children('li').removeClass('wonderplugin-tab-horizontal-selected');
					$('#' + panelsID).children('li').eq(index).addClass('wonderplugin-tab-horizontal-selected');
					
				});
			});
		});
		
		var resetLightboxOptions = function() {
			
			var defaultOptions = {
					'autoslide' : 	false,
					'slideinterval' : 5000,
					'showtimer' : true,
					'timerposition' : "bottom",
					'timerheight' : 2,
					'timercolor' : "#dc572e",
					'timeropacity' : 1,
					'navarrowspos' : 'inside',
					'closepos': 'outside',
					'enteranimation': '',
					'exitanimation': '',
					'showplaybutton' :	false,
					'alwaysshownavarrows' : false,
					'bordersize' : 8,
					'showtitleprefix' : false,
					'responsive' : true,
					'fullscreenmode' : false,
					'closeonoverlay'	: true,
					'videohidecontrols'	: false,
					'titlestyle'	: 'bottom',
					'imagepercentage' : 75,
					'enabletouchswipe'	: true,
					'autoplay' : true,
					'html5player' : true,
					'overlaybgcolor' : '#000',
					'overlayopacity' : 0.8,
					'defaultvideovolume' : 1,
					'bgcolor' : '#FFF',
					'borderradius' : 0,
					'thumbwidth' : 96,
					'thumbheight' : 72,
					'thumbtopmargin' : 12,
					'thumbbottommargin' : 12,
					'barheight' : 64,
					'showtitle' : true,
					'titleprefix' : '%NUM / %TOTAL',
					'titlebottomcss' : 'color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;',
					'showdescription' : true,
					'descriptionbottomcss' : 'color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;',
					'titleinsidecss' : "color:#fff; font-size:16px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left;",
					'descriptioninsidecss' : "color:#fff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;",
					'titleoutsidecss' : "color:#fff; font-size:18px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:center; margin: 8px;",
					'descriptionoutsidecss' : "color:#fff; font-size:14px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:center; margin:8px; padding: 0px;",
					'advancedoptions' : '',
					'customcss': '',
					'customjavascript': '',
					'videobgcolor' : '#000',
					'html5videoposter' : '',
					'responsivebarheight' : false,
					'smallscreenheight' : 415,
					'barheightonsmallheight' : 64,
					'notkeepratioonsmallheight' : false,
					'showsocial' :	false,
					'socialposition' :	'position:absolute;top:100%;right:0;',
					'socialpositionsmallscreen' : 'position:absolute;top:100%;right:0;left:0;',
					'socialdirection' : 'horizontal',
					'socialbuttonsize' : 32,
					'socialbuttonfontsize' : 18,
					'socialrotateeffect' :	true,
					'showfacebook' : true,
					'showtwitter' : true,
					'showpinterest' : true,
					'bordertopmargin' : 48,
					'shownavigation' : true,
					'navbgcolor' : "rgba(0,0,0,0.2)",
					'shownavcontrol' : true,
					'hidenavdefault' : false,
					'hidenavigationonmobile' : false,
					'hidenavigationonipad' : false
			};
			
			for (var key in defaultOptions)
			{
				if( typeof(defaultOptions[key]) === "boolean")
				{
					$("#" + key).attr("checked", defaultOptions[key]);
				}
				else
				{
					$("#" + key).val(defaultOptions[key]);
				}
			}
			
			applyShownavigation();
			applyNavarrowspos();
			applyShowsocial();
		};
		
		$('#reset-lightbox-options').click(function() {
			
			$("<div></div>").html('Are you sure to reset all lightbox options to their default value? <p>If you select Yes, please click the Save Changes button to save the reset options.</p>').dialog({
		        title: 'Wonder Lightbox',
		        resizable: false,
		        modal: true,
		        buttons: {
		            "Yes": function() 
		            {
		                $(this).dialog("close");
		                resetLightboxOptions();		            
		            }, 
		            "No": function() {
		            	$(this).dialog("close");
		            }, 
		            "Cancel": function() {
		            	$(this).dialog("close");
		            }
		        }
		    });
			
			return false;
		});
		
	});
})(jQuery);