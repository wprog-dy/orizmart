<form action="<?= $action; ?>" method="post" name="payuForm" style='display: none;' >
	<input type="hidden" name="key" value="<?= MERCHANT_KEY ?>" />
	<input type="hidden" name="hash" value="<?= $hash ?>"/>
	<input type="hidden" name="txnid" value="<?= $txnid ?>" />
	<input name="amount" type="number" value="<?= $totalCost; ?>" />
	<input type="text" name="firstname" value="<?= $firstName; ?>" />
	<input type="email" name="email"  value="<?= $email; ?>" />
	<input type="text" name="phone" value="<?= $mobile; ?>" />
	<textarea name="productinfo"><?= $productinfo; ?></textarea>
	<input type="text" name="surl" value="<?= $success_url; ?>" />
	<input type="text" name="furl" value="<?=  $fail_url; ?>"/>
	<input type="text" name="service_provider" value="payu_paisa"/>
	<input type="text" name="lastname" value="<?= $lastName ?>" />
</form>
<script type="text/javascript">
var payuForm = document.forms.payuForm;
payuForm.submit();
</script>