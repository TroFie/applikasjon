$(document).ready(function(){

		// når bruker trykker på liker knappen
		$('.like-btn').on('click', function(){
  			var melding_id = $(this).data('id');
			$clicked_btn = $(this);


				// for liker button, man kan enten like eller unlike. ikke dislike 
			if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
				action = 'like';
			} else if ($clicked_btn.hasClass('fa-thumbs-up')) {
				action = 'unlike';
			}

						if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
				action = 'dislike';
			} else if ($clicked_btn.hasClass('fa-thumbs-down')) {
				action = 'undislike';
			}

			$.ajax({
				url: 'index.php',
				type: 'post',
				data: {
					'action': action,
					'melding_id': melding_id
				},
				success: function(data){
					

					if (action == 'like') {
						$clicked_btn.removeClass('fa-thumbs-o-up');
						$clicked_btn.addClass('fa-thumbs-up');
					} else if (action == 'unlike'){
						$clicked_btn.removeClass('fa-thumbs-up');
						$clicked_btn.addClass('fa-thumbs-o-up');
					}
				
		}
			
	});

});

});