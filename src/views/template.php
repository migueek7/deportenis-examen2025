<?php
$enlace = new enlacesControllers();
$page = $enlace->enlaces();
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $page["title"] ?></title>
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/icon" href="<?= base_url() ?>/assets/images/favicon.ico" />
	<!-- Plugins CSS -->
	<link href="<?= base_url() ?>/assets/css/plugins/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="base_url() ?>/assets/css/plugins/dataTables.min.css" rel="stylesheet"> -->
	<link href="<?= base_url() ?>/assets/css/plugins/dataTables.bootstrap5.min.css" rel="stylesheet">
	<!-- Styles -->
	<link href="<?= base_url() ?>/assets/css/loading.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">
	<link href="<?= base_url() ?>/assets/css/navbar.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<?php include "components/loading.php"; ?>
	<?php include "modules/header.php"; ?>

	<main class="pt-5">
		<?php
		include $page["modulo"];
		?>
	</main>

	<?php //include "modules/footer.php"; 
	?>

	<!-- Plugins Scripts -->
	<!-- <script src="< base_url() ?>/assets/js/plugins/jquery-3.7.1.min.js" type="text/javascript"></script> -->
	<script src="<?= base_url() ?>/assets/js/plugins/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>/assets/js/plugins/bootstrap.bundle.min.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>/assets/js/plugins/datatables.min.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
	<script src="<?= base_url() ?>/assets/js/plugins/dataTables.buttons.min.js"></script>
	<!-- Scripts -->
	<?php if ($page["title"] == "inicio") : ?>
		<script src="<?= base_url() ?>/assets/js/script.js" type="text/javascript"></script>
	<?php endif; ?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
	<script>
		$("#cargador").fadeOut("slow");
	</script>
</body>

</html>