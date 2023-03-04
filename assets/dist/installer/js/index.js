(function() {
	"use strict";

	window.addEventListener(
		"load",
		function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName("needs-validation");

			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener(
					"submit",
					function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add("was-validated");
					},
					false
				);
			});
		},
		false
	);
})();

$("#installform").submit(function(e) {
	e.preventDefault();
	$("#submitID").prop("disabled", true);
	$("#submitID").html("Processing …");
	var actionurl = e.currentTarget.action;
	$.ajax({
		url: actionurl,
		method: "POST",
		cache: false, 
		data: $('#installform').serialize(),
		dataType: "json",
		success: function(data) {
			$("#submitID").prop("disabled", false);
			$("#submitID").html("Continue");
			if (data.success === false) {
				$(".alert").show();
				$("#msg").html(data.msg);
			} else if (data.success === true) {
				$(".alert").hide();
				$("#installform").hide();
				$("#success_install").show();
			}
		},
		error: function(data) {
			$(".alert").show();
			var msg =
				"There is an error in posting your form. Please reload and try again";
			$("#msg").html(msg);
			$("#submitID").prop("disabled", false);
			$("#submitID").html("Continue");
		}
	});
});

