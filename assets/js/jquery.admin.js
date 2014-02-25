jQuery.noConflict();

jQuery(document).ready(function($){

	/* =SMOF Updates
	----------------------------------------------- */
	
	// Checkbox folds
  	var checkcheckbox = function() {
    	var $fold='.f_'+this.id;
		if( $(this).is(':checked') ) {
    		$($fold).slideDown('normal', 'swing');
		}else{
    		$($fold).slideUp('normal', 'swing');
		}
  	}
	
	$('.fld[type=checkbox]').on('click',checkcheckbox);
	$('.fld[type=checkbox]').each( function() {
    	var $fold='.f_'+this.id;
		if( $(this).is(':checked') ) {
    		$($fold).show();
		}else{
    		$($fold).hide();
		}
	});

	// Dropdown folds
  	var checkdropdown = function() {
    	var $fold='.f_'+this.id+'_'+$(this).val();
		if( $($fold).is(':hidden') ) {
    		$('div[class^="f_'+this.id+'_"]').fadeOut();
    		$($fold).slideDown('normal', 'swing');
		}else{
    		$('div[class^="f_'+this.id+'_"]').hide();
    		$($fold).show();
		}
  	}

	$('select.fld').on('change',checkdropdown);
	$('select.fld').trigger('change');

	// Google fonts
  	var checkgooglefont = function() {
    	var fold=$(this).parents('.controls').find('.typography-google, .typography-google-weight');
    	var sampletext=$(this).parents('.controls').find('.sampletext');
		if($(this).val()=='google_font'){
	    	$(fold).slideDown('normal', 'swing');
	    	$(sampletext).slideDown('normal', 'swing');
		}else{
	    	$(fold).fadeOut();
	    	$(sampletext).fadeOut();
		}
  	}

	$('select.of-typography-face').on('change',checkgooglefont);
	$('select.of-typography-face').trigger('change');

	$('.typography-google, .typography-google-weight, .typography-style').each(function(index){
		$('head').append('<link href="http://fonts.googleapis.com/css?family=' + $(this).parents('.controls').find('.typography-google select option:selected').text() +':' + $(this).parents('.controls').find('.typography-google-weight option:selected').text() + $(this).parent().find('.typography-style option:selected').text() + '" rel="stylesheet" class="font'+ index +'" type="text/css" />');
		$(this).parents('.controls').find('.sampletext').css({'font-family':$(this).parents('.controls').find('.typography-google select option:selected').text(),'font-weight':$(this).parents('.controls').find('.typography-google-weight option:selected').text(),'font-style':$(this).parents('.controls').find('.typography-style option:selected').text()});
		$(this).find('select').change(function(){
			$(this).parents('.controls').find('.sampletext').css({'font-family':$(this).parents('.controls').find('.typography-google select option:selected').text(),'font-weight':$(this).parents('.controls').find('.typography-google-weight option:selected').text(),'font-style':$(this).parents('.controls').find('.typography-style option:selected').text()});
			$('head').find('link.font'+index).attr('href','http://fonts.googleapis.com/css?family=' + $(this).parents('.controls').find('.typography-google select option:selected').text() +':' + $(this).parents('.controls').find('.typography-google-weight option:selected').text() + $(this).parent().find('.typography-style option:selected').text());
		});
	});

});