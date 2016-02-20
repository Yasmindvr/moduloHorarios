

function Imp(){
	
  var objeto=document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana
}
   

function mostrar()
{
	document.getElementById('oculto2').style.display = 'none';
	document.getElementById('oculto1').style.display = 'block';
	document.getElementById('oculto3').style.display = 'none';
	
}
function mostrar2()
{
	document.getElementById('oculto2').style.display = 'block';
	document.getElementById('oculto1').style.display = 'none';
	document.getElementById('oculto3').style.display = 'none';
}
function mostrar3()
{
	document.getElementById('oculto2').style.display = 'none';
	document.getElementById('oculto1').style.display = 'none';
	document.getElementById('oculto3').style.display = 'block';
}


function SeleccionaSalon() {
    alert ("Debe seleccionar un salon");
   
}
function SeleccionaCarrera() {
    alert ("Debe seleccionar una Carrera");
}

function ocultar()
{
	document.getElementById('oculto').style.display = 'none';
	
}

function ocultarEdificio()
{
	document.getElementById('layer').style.display = 'none';
	
}
function consultaProfesor(tipo, id) {
	var ide= document.getElementById(id).value;
    $.ajax({
        type: "POST",
        url: "reportehorario.php",
        data: {tipo: tipo, ide: ide},	
    success: function(a) {
                $('#impreporte').html(a);
	    }
      });
}
function validaHorario() {
	
	var dia= document.getElementById('dia').value;
	var hora= document.getElementById('hora').value;
	var edificio= document.getElementById('edificio').value;
	var salon= document.getElementById('sal').value;
	var estructura= document.getElementById('estructura').value;
	var carrera= document.getElementById('carrer').value;
	var materia= document.getElementById('materia').value;
	var periodo= document.getElementById('periodo').value;
	var seccion= document.getElementById('secc').value;
	var profesor= document.getElementById('profesor').value;
	var thora= document.getElementById('thora').value;
	var chora= document.getElementById('chora').value;
	var horasS= document.getElementById('horasS').value;
	var horasD= document.getElementById('horasD').value;


    $.ajax({
        type: "POST",
        url: "envioHorario.php",
        data: {dia:dia, hora:hora, edificio:edificio, salon:salon, estructura:estructura,
        carrera:carrera, periodo:periodo, seccion:seccion, thora:thora, profesor:profesor,
        chora:chora, materia:materia, horasS:horasS, horasD:horasD

        },	
    success: function(a) {
                $('#validHorario').html(a);
	    }
      });
}

//funcion para la edicion del edificio y salon
function editar(id) {
    $.ajax({
        type: "POST",
        url: "editando_edificio.php",
        data: {operacion: 'update', ide: id}
    }).done(function (html) {
        $('#editar_edificio').html(html);
    }).false(function () {
        alert('Error al cargar modulo');
    });
}

function editarS(id) {
    $.ajax({
        type: "POST",
        url: "salones.php",
        data: {operacion: 'update', ide: id}
    }).done(function (html) {
        $('#salones').html(html);
    }).false(function () {
        alert('Error al cargar modulo');
    });
}

function editarH(id) {
	$.ajax({
        type: "POST",
        url: "modificar.php",
        data: {ide: id},	
    success: function(a) {
                $('#aqui').html(a);
	    }
      });
}



function tomarDatos(d, h ) {
	var dia=document.getElementById(d).value;
	var hora=document.getElementById(h).value;
     
  
    document.getElementById('DivContenedor').innerHTML = "<span class='input-group-addon'>Día</span><input type='text' id='dia' name='dia_' class='form-control'readonly value='"+dia+"'>";
    document.getElementById('DivContenedor2').innerHTML = "<span class='input-group-addon'>Bloque</span><input type='text' id='hora' name='dia_' class='form-control'readonly value='"+hora+"'>";
   

}


//fin funcion

function nuevoAjax(){ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e){
		try{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E){
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
		}
	}
	return xmlhttp; 
}

// Declaro los selects que componen el documento HTML. Su atributo ID debe figurar aqui.
var listadoSelects = Array("select1", "salon", "materia", "periodo","secc","profesor","horasd","materia1","periodo1","edificioR","salon1","prueba","carreraRep","periodoR","seccionRe");

function buscarEnArray(array, dato){
	// Retorna el indice de la posicion donde se encuentra el elemento en el array o null si no se encuentra
	var x=0;
	while(array[x]){
		if(array[x] == dato){
			return x;	
		} 
		x++;
	}
	return null;
}

function cargaContenido(idSelectOrigen){
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."

	if(idSelectOrigen=="select1" ){
		selectActual = null;
		// Buscamos el ultimo select y cambiamos el estado y deshabilito
		selectActual=document.getElementById(listadoSelects[1]);
		selectActual.length = 0;
			
		var nuevaOpcion=document.createElement("option"); 
		    nuevaOpcion.value=0; 
		    nuevaOpcion.innerHTML="No se ha cargado...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
	}

	if(opcionSeleccionada==0){
		var x = posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x]){
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); 
			    nuevaOpcion.value=0; nuevaOpcion.innerHTML="No se ha cargado...";
				selectActual.appendChild(nuevaOpcion);
				selectActual.disabled=true;
				x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1]){
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		ajax.open("GET", "consulta/dinamico/select.php?select="+idSelectDestino+"&salon="+opcionSeleccionada, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1){
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option");
				    nuevaOpcion.value=0; 
				    nuevaOpcion.innerHTML="Cargando...";
					selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4){
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}

function cargaContenidoP(idSelectOrigen){
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."

	if(idSelectOrigen=="select1" ){
		selectActual = null;
		// Buscamos el ultimo select y cambiamos el estado y deshabilito
		selectActual=document.getElementById(listadoSelects[1]);
		selectActual.length = 0;
			
		var nuevaOpcion=document.createElement("option"); 
		    nuevaOpcion.value=0; 
		    nuevaOpcion.innerHTML="No se ha cargado...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
	}

	if(opcionSeleccionada==0){
		var x = posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x]){
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); 
			    nuevaOpcion.value=0; nuevaOpcion.innerHTML="No se ha cargado contenido...";
				selectActual.appendChild(nuevaOpcion);
				selectActual.disabled=true;
				x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1]){
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		ajax.open("GET", "consulta/dinamico/selectreporte.php?select="+idSelectDestino+"&salon="+opcionSeleccionada, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1){
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option");
				    nuevaOpcion.value=0; 
				    nuevaOpcion.innerHTML="Cargando...";
					selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4){
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}
function cargaContenidoProf(idSelectOrigen){
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."

	if(idSelectOrigen=="select1" ){
		selectActual = null;
		// Buscamos el ultimo select y cambiamos el estado y deshabilito
		selectActual=document.getElementById(listadoSelects[1]);
		selectActual.length = 0;
			
		var nuevaOpcion=document.createElement("option"); 
		    nuevaOpcion.value=0; 
		    nuevaOpcion.innerHTML="No se ha cargado...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
	}

	if(opcionSeleccionada==0){
		var x = posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x]){
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); 
			    nuevaOpcion.value=0; nuevaOpcion.innerHTML="No se ha cargado contenido...";
				selectActual.appendChild(nuevaOpcion);
				selectActual.disabled=true;
				x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1]){
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		ajax.open("GET", "consulta/dinamico/selectreporte.php?select="+idSelectDestino+"&salon="+opcionSeleccionada, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1){
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option");
				    nuevaOpcion.value=0; 
				    nuevaOpcion.innerHTML="Cargando...";
					selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4){
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}
function cargaContenidoM(idSelectOrigen){

	
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."

	if(idSelectOrigen=="select1" ){
		selectActual = null;
		// Buscamos el ultimo select y cambiamos el estado y deshabilito
		selectActual=document.getElementById(listadoSelects[1]);
		selectActual.length = 0;
			
		var nuevaOpcion=document.createElement("option"); 
		    nuevaOpcion.value=0; 
		    nuevaOpcion.innerHTML="No se ha cargado...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
	}

	if(opcionSeleccionada==0){
		var x = posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x]){
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); 
			    nuevaOpcion.value=0; nuevaOpcion.innerHTML="No se ha cargado contenido...";
				selectActual.appendChild(nuevaOpcion);
				selectActual.disabled=true;
				x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1]){
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		ajax.open("GET", "consulta/dinamico/selectperiodo.php?select="+idSelectDestino+"&id="+opcionSeleccionada, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1){
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option");
				    nuevaOpcion.value=0; 
				    nuevaOpcion.innerHTML="Cargando...";
					selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4){
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}

function ola(id){
	if(confirm('¿Seguro que desea eliminar el registro?')){
		 $.ajax({
        type: "POST",
        url: "eliminar.php",
        data: {ide: id},	
    success: function(a) {
                $('#aqui2').html(a);
	    }
      });
	}
	
	
}

function cargaContenidoSc(idSelectOrigen){
	var periodo=document.getElementById('periodo').value;
	
	//Obtengo la Carrera
	var carrer=document.getElementById('carrer').value;
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."


	if(opcionSeleccionada==0){
		var x = posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x]){
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); 
			    nuevaOpcion.value=0; nuevaOpcion.innerHTML="No se ha cargado contenido...";
				selectActual.appendChild(nuevaOpcion);
				selectActual.disabled=true;
				x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1]){
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		ajax.open("GET", "consulta/dinamico/selectseccion.php?select="+idSelectDestino+"&id="+periodo+"&carrera="+carrer, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1){
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option");
				    nuevaOpcion.value=0; 
				    nuevaOpcion.innerHTML="Cargando...";
					selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4){
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}


function cargaContenidoPr(idSelectOrigen){
	//Obtengo la Carrera
	var carrer=document.getElementById('carrer').value;
	//Obtengo el codigo de la unidad curricular
	var materia=document.getElementById('materia').value;
	//Obtengo la Seccion
	var secc=document.getElementById('secc').value;
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."


	if(opcionSeleccionada==0){
		var x = posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x]){
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); 
			    nuevaOpcion.value=0; nuevaOpcion.innerHTML="No se ha cargado contenido...";
				selectActual.appendChild(nuevaOpcion);
				selectActual.disabled=true;
				x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1]){
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		ajax.open("GET", "consulta/dinamico/selectprofesor.php?select="+idSelectDestino+"&id="+opcionSeleccionada+"&materia="+materia+"&seccion="+secc, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1){
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option");
				    nuevaOpcion.value=0; 
				    nuevaOpcion.innerHTML="Cargando...";
					selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4){
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}

function cargaContenidoHr(idSelectOrigen){
	var mater=document.getElementById('materia').value;
	var tiposal=document.getElementById('tsalon').value;
	var seccn=document.getElementById('secc').value;
	


	//Obtengo la Carrera
	var carrer=document.getElementById('carrer').value;
	var per=document.getElementById('periodo').value;
	
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."

	if(opcionSeleccionada==0){
		var x = posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x]){
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); 
			    nuevaOpcion.value=0; nuevaOpcion.innerHTML="No se ha cargado contenido...";
				selectActual.appendChild(nuevaOpcion);
				selectActual.disabled=true;
				x++;
		}
	}
// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1]){
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
	// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
	var ajax=nuevoAjax();
	ajax.open("GET", "consulta/dinamico/calculoHoras.php?select="+mater+"&id="+per+"&carrera="+tiposal+"&secc="+seccn, true);
	ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1){
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option");
				    nuevaOpcion.value=0; 
				    nuevaOpcion.innerHTML="Cargando...";
					selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4){
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}

function cargaContenidoPerR(idSelectOrigen){
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."

	if(idSelectOrigen=="select1" ){
		selectActual = null;
		// Buscamos el ultimo select y cambiamos el estado y deshabilito
		selectActual=document.getElementById(listadoSelects[1]);
		selectActual.length = 0;
			
		var nuevaOpcion=document.createElement("option"); 
		    nuevaOpcion.value=0; 
		    nuevaOpcion.innerHTML="No se ha cargado...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
	}

	if(opcionSeleccionada==0){
		var x = posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x]){
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); 
			    nuevaOpcion.value=0; nuevaOpcion.innerHTML="No se ha cargado...";
				selectActual.appendChild(nuevaOpcion);
				selectActual.disabled=true;
				x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1]){
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		ajax.open("GET", "consulta/dinamico/selectperiodoR.php?select="+idSelectDestino+"&salon="+opcionSeleccionada, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1){
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option");
				    nuevaOpcion.value=0; 
				    nuevaOpcion.innerHTML="Cargando...";
					selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4){
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}

function cargaContenidoSeccR(idSelectOrigen){
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."

	if(idSelectOrigen=="select1" ){
		selectActual = null;
		// Buscamos el ultimo select y cambiamos el estado y deshabilito
		selectActual=document.getElementById(listadoSelects[1]);
		selectActual.length = 0;
			
		var nuevaOpcion=document.createElement("option"); 
		    nuevaOpcion.value=0; 
		    nuevaOpcion.innerHTML="No se ha cargado...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
	}

	if(opcionSeleccionada==0){
		var x = posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x]){
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); 
			    nuevaOpcion.value=0; nuevaOpcion.innerHTML="No se ha cargado...";
				selectActual.appendChild(nuevaOpcion);
				selectActual.disabled=true;
				x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1]){
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		ajax.open("GET", "consulta/dinamico/selectseccionR.php?select="+idSelectDestino+"&salon="+opcionSeleccionada, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1){
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option");
				    nuevaOpcion.value=0; 
				    nuevaOpcion.innerHTML="Cargando...";
					selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4){
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}