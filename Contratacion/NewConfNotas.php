		<?	if($DatNameSID){session_name("$DatNameSID");}
			session_start();
			include("Funciones.php");
			include_once("General/Configuracion/Configuracion.php");
			if($Guardar){
				if(!$Edit){			
					$cons="insert into salud.Notas(compania,Nota) values ('$Compania[0]','$Nota')";
					//echo $cons;
				}
				else{
					$cons="update salud.Notas set Nota='$Nota' where compania='$Compania[0]' and Nota='$NotaAnt'";
					//echo $cons;			
				}		
				$res=ExQuery($cons);?>
				<script language="javascript">
				location.href='ConfNotas.php?DatNameSID=<? echo $DatNameSID?>';
				</script><?		
			}
		?>	
		<html>
			<head>
				<?php echo $codificacionMentor; ?>
				<?php echo $autorMentor; ?>
				<?php echo $titleMentor; ?>
				<?php echo $iconMentor; ?>
				<?php echo $shortcutIconMentor; ?>
				<link rel="stylesheet" type="text/css" href="../General/Estilos/estilos.css">
				<script language='javascript' src="/Funciones.js"></script>
				<script language="javascript">
				function validar(){
					if(document.FORMA.Nota.value==""){
						alert("Debe digitar una Nota!!!");return false;
					}
				}
				function evitarSubmit(evento){
					if(document.all){ tecla = evento.keyCode;}
					else{ tecla = evento.which;}
					return(tecla != 13);
				}
				function Pasar(evento,proxCampo){
					if(evento.keyCode == 13){document.getElementById(proxCampo).focus();}
				}
				</script>
			</head>
			
			
			<body <?php echo $backgroundBodyMentor; ?>>
				<?php
					$rutaarchivo[0] = "HISTORIA CL&Iacute;NICA";
					$rutaarchivo[1] = "CONFIGURACI&Oacute;N";
					$rutaarchivo[2] = "NOTAS";					
					$rutaarchivo[3] = "NUEVA";
					
					mostrarRutaNavegacionEstatica($rutaarchivo);
					
				?>
				<div <?php echo $alignDiv2Mentor; ?> class="div2">
					<form name="FORMA" method="post" onSubmit="return validar()">
						<table class="tabla2"  <?php echo $borderTabla2Mentor; echo $bordercolorTabla2Mentor; echo $cellspacingTabla2Mentor; echo $cellpaddingTabla2Mentor; ?>> 	
							<tr>
								<td colspan="2" class="encabezado2Horizontal"> NUEVA NOTA </td>
							</tr>
							<tr>
								<td class="encabezado2HorizontalInvertido" >NOTA</td>
								<td >
									<input type="text" name="Nota" value="<? echo $Nota?>" onKeyDown="xLetra(this)" onKeyUp="xLetra(this);Pasar(event,'Guardar')" onKeyPress="return evitarSubmit(event)" >
								</td>
							</tr>    
							<tr>
								<td colspan="4" style="text-align:center;">
									<input type="submit" name="Guardar" class="boton2Envio" value="Guardar" id="Guardar">
									<input type="button" class="boton2Envio" value="Cancelar" onClick="location.href='ConfNotas.php?DatNameSID=<? echo $DatNameSID?>'">
								</td>
							</tr>
						</table>
						<input type="hidden" name="NotaAnt" value="<? echo $Nota?>">
						<input type="hidden" name="Edit" value="<? echo $Edit?>">
						<input type="hidden" value="DatNameSID" name="<? echo $DatNameSID?>">
					</form> 
				</div>	
			
			
			</body>
	</html>
