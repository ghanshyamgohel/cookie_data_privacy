jQuery(document).ready(function($) {
	$('.add-new-js').click(function(){
		var _countRow = 1 + parseInt($('#jsTotRow').val());
		$('#js-external-list').append('<div id="js-row-'+_countRow+'" class="cookie-js-row"><input class="form-control" name="tx_cookiedataprivacy_tools_cookiedataprivacymod1[privacyconfig][fileinclude][js]['+_countRow+'][originalPath]" type="text"><p class="help-block">[PATH]</p></div>');
		$('#jsTotRow').val(_countRow);
	});

	$('.add-new-css').click(function(){
		var _countRow = 1 + parseInt($('#cssTotRow').val());
		$('#css-external-list').append('<div id="css-row-'+_countRow+'" class="cookie-css-row"><input class="form-control" name="tx_cookiedataprivacy_tools_cookiedataprivacymod1[privacyconfig][fileinclude][css]['+_countRow+'][originalPath]" type="text"><p class="help-block">[PATH]</p></div>');
		$('#cssTotRow').val(_countRow);
	});

	$('.delete-js-row').on('click',function(){
		 var _countRow = parseInt($('#jsTotRow').val());
		 
		 if(_countRow > 1){
			 $('#js-row-'+_countRow).remove();
			 $('#jsTotRow').val(parseInt(_countRow)-1);
		 }
	});
	$('.delete-css-row').on('click',function(){
		 var _countRow = parseInt($('#cssTotRow').val());
		 if(_countRow > 1){
			 $('#css-row-'+_countRow).remove();
			 $('#cssTotRow').val(parseInt(_countRow)-1);
		 }
	});

	$('.delete-record').click(function(){
		if (confirm('Are you sure you want to delete record?')) {	
			return true;
		}else{
			return false;
		}
		return false;
	});

    $('.main-accordion').on('click', function() {
        $('.my-custom-accordion-content').hide();
        $('.my-custom-accordion-content').css('visibility','hidden');
        $(this).find('.my-custom-accordion-content').show();
        $(this).find('.my-custom-accordion-content').css('visibility','visible');
    });
});
