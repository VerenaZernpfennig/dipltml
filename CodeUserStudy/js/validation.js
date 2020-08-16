$( document ).ready(function() {
	$("#first-page").validate({
		rules: {
			chkAgreement: "required"
		},
		messages: {
			chkAgreement: "Bitte Kästchen markieren!"
		}
	});
});
