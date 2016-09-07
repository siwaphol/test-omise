<!DOCTYPE html>
<html>
<head>
	<title>Test Omise</title>
</head>
<body>
	<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.omise.co/omise.js"></script>

<h1>Hello</h1>

<form action="checkout.php" method="post" id="checkout">
	<div id="token_errors"></div>

	<input type="hidden" name="omise_token">

	<div>
		Name<br>
		<input type="text" data-omise="holder_name">
	</div>
	<div>
		Number<br>
		<input type="text" data-omise="number">
	</div>
	<div>
		Date<br>
		<input type="text" data-omise="expiration_month" size="4"> /
		<input type="text" data-omise="expiration_year" size="8">
	</div>
	<div>
		Security Code<br>
		<input type="text" data-omise="security_code" size="8">
	</div>

	<input type="submit" id="create_token">
</form>

<script type="text/javascript">
		Omise.setPublicKey("pkey_test_559bd2hzgvktniqwkiw");

		$("#checkout").submit(function () {

			var form = $(this);

  // Disable the submit button to avoid repeated click.
  form.find("input[type=submit]").prop("disabled", true);

  // Serialize the form fields into a valid card object.
  var card = {
  	"name": form.find("[data-omise=holder_name]").val(),
  	"number": form.find("[data-omise=number]").val(),
  	"expiration_month": form.find("[data-omise=expiration_month]").val(),
  	"expiration_year": form.find("[data-omise=expiration_year]").val(),
  	"security_code": form.find("[data-omise=security_code]").val()
  };

  // Send a request to create a token then trigger the callback function once
  // a response is received from Omise.
  //
  // Note that the response could be an error and this needs to be handled within
  // the callback.
  Omise.createToken("card", card, function (statusCode, response) {
  	if (response.object == "error") {
      // Display an error message.
      $("#token_errors").html(response.message);

      // Re-enable the submit button.
      form.find("input[type=submit]").prop("disabled", false);
  } else {
      // Then fill the omise_token.
      form.find("[name=omise_token]").val(response.id);

      // Remove card number from form before submiting to server.
      form.find("[data-omise=number]").val("");
      form.find("[data-omise=security_code]").val("");

      // submit token to server.
      form.get(0).submit();
  };
});

  // Prevent the form from being submitted;
  return false;

});
</script>

</body>
</html>