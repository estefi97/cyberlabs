<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51HerKsCSXaYsdvMnIUEnmSPDpoDrsizpJcADfjJFatuOcLGvDFhbtg3fK93D6YQrXrPB2RW7hUuUJVIE6YKP4t6l00LIjNym12";

$secretKey="sk_test_51HerKsCSXaYsdvMnXLy6WMtEdkaQIgaHTwNJKq4UYdvEpkOj5eGRI2uqVbkJBD2eESWQb8DCGb9KrB33s7cZdvz0006kCsvgpz";

\Stripe\Stripe::setApiKey($secretKey);
?>