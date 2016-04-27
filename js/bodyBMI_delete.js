$(function() {
	$("#btnDelete").click(function() {
		$.each( $('input:checked'), function( index, thing ) {
			$.post( "bodyBMI_insert.php", { "delete" : thing.value},
				function( data ) {
					console.log( data );
			});
		});
		// console.log(selected.toString());
	});
});