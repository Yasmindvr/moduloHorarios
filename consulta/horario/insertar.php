<?php
	extract($_POST);
	echo $materia;
	
	if ($materia=='0') {
		?>
			<script type="text/javascript">alert('debe seleccionar una materia');window.location='../../principal.php';</script>
		<?php
		exit();
	}
	echo "seguimos...";
?>
