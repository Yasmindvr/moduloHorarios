
	</div>
</div>

<!-- Fin contenido -->

<div id="popUp" class="infoZone" onClick="popUpClose()">
	<div></div>

	<span class="cerrar" title="Cerrar">X</span>

	<span class="fa-stack fa-2x" style="position: absolute; bottom: 0.2em; right: 0.2em;">
		<i class="fa fa-circle-o fa-fw fa-stack-2x"></i>
		<i></i>	
	</span>
</div>

<i id="loading" class="fa fa-refresh fa-spin fa-3x fa-fw infoZone" title="Cargando.."></i>


<!-- Bibliotecas plantilla -->

<script src="/SIGPA/css/template/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/SIGPA/css/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/SIGPA/css/template/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script src="/SIGPA/css/template/dist/js/sb-admin-2.js"></script>
<script src="/SIGPA/css/template/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/SIGPA/css/template/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script src="/SIGPA/css/template/bower_components/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/SIGPA/css/template/bower_components/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
<script src="/SIGPA/lib/sigpa.js"></script>

<script>
	$(document).ready(loading(false));
	formularios();
</script>

</body>



<!-- Fin bibliotecas plantilla -->

</html>