<?
	if($DatNameSID){session_name("$DatNameSID");}
	else{$Compania[0]='Clinica San Juan de Dios';}
	session_start();
	include("../Funciones.php");
	$ND=getdate();
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mortalidad</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
body {
	margin-left: 0px;
	margin-right: 0px;
	background-attachment:fixed;
	background-image: url(../Imgs/Fondo.jpg);
	margin-top: 0px;
	margin-bottom: 0px;
}
select{background-color:#FFFFFF;
border-color:#EEEEEE;
border-style:solid;
border-width:thin;
color:#333333;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
}
.Estilo2 {font-weight: bold}

-->
</style>
<script type="text/JavaScript">
<!--
function Valida()
{
document.FORMA.FechaIni.value=''+document.FORMA.fi1.value+'-'+document.FORMA.fi2.value+'-'+document.FORMA.fi3.value+'';
document.FORMA.FechaFin.value=''+document.FORMA.ff1.value+'-'+document.FORMA.ff2.value+'-'+document.FORMA.ff3.value+'';
//alert('Fecha1: '+document.FORMA.FechaIni.value+' Fecha2: '+document.FORMA.FechaFin.value+'');
if(document.FORMA.FechaIni.value=="")
	{
		alert("Debes seleccionar la fecha inicial.");
	}
else{
		if(document.FORMA.FechaFin.value=="")
			{
				alert("Debes seleccionar la fecha final.");
			}
		else{
				if(document.FORMA.FechaIni.value>document.FORMA.FechaFin.value)
					{
						alert("La fecha inicial debe ser menor a la fecha final.");
					}
				else{
						location.href='?DatNameSID=<? echo $DatNameSID?>&FechaIni='+document.FORMA.FechaIni.value+'&FechaFin='+document.FORMA.FechaFin.value+'&pb='+document.FORMA.pb.value+'';
					}
			}
	}
}
//-->
</script>
</head>
<?php
		$FechaIni=$_GET['FechaIni'];
		//echo $FechaIni;
		$FechaFin=$_GET['FechaFin'];
		//echo $FechaFin;
		
        if($FechaIni==NULL){
			if($ND[mon]<10){$C1="0";}else{$C1="";}
			if($ND[mday]<10){$C2="0";}else{$C2="";}			
			$FechaIni="$ND[year]-$C1$ND[mon]-$C2$ND[mday]";
		}
		
		if($FechaFin==NULL){
			if($ND[mon]<10){$C1="0";}else{$C1="";}
			if($ND[mday]<10){$C2="0";}else{$C2="";}
			$FechaFin="$ND[year]-$C1$ND[mon]-$C2$ND[mday]";
		}
		
		$aaaa1=substr("$FechaIni", -10,4);
		$mm1=substr("$FechaIni", -5,2);
		if($mm1<10){$mm1=str_replace("0","","$mm1");}					
		$dd1=substr("$FechaIni", -2);
		if($dd1<10){$dd1=str_replace("0","","$dd1");}
		//echo "$aaaa1,$mm1,$dd1";
		
		$aaaa2=substr("$FechaFin", -10,4);
		$mm2=substr("$FechaFin", -5,2);
		if($mm2<10){$mm2=str_replace("0","","$mm2");}					
		$dd2=substr("$FechaFin", -2);
		if($dd2<10){$dd2=str_replace("0","","$dd2");}
		//echo "$aaaa2,$mm2,$dd2";
		
	   $pb=$_GET['pb'];
	   
	   //echo "El valor de PB es: $pb";
	   
	   switch($pb){
	   	case 0:
			$qp="";
			break;
		case 1:
			$qp="and cmp00003='Vivo'";
			break;
		case 2:
			$qp="and cmp00003='Muerto'";
			break;		
	   }
	   
	   //echo "El valor de QP es: $qp";
	   	
?>
<body>
<form id="FORMA" name="FORMA" method="post" action="">
  <div align="center">
    <table width="200" border="1" cellpadding="5" bordercolor="#EEEEEE" background="../Imgs/Fondo.jpg" bgcolor="#FFFFFF">
      <tr>
        <td colspan="21" nowrap="nowrap"><table width="200" align="left" cellpadding="5">
          <tr>
            <td colspan="2" nowrap="nowrap"><div align="left"><strong>MORTALIDAD</strong></div></td>
            </tr>
          <tr>
            <td height="10" colspan="2" nowrap="nowrap">&nbsp;</td>
            </tr>

          <tr>
            <td nowrap="nowrap" bgcolor="#DDDDDD"><div align="left"><strong>FECHA DE CONSULTA </strong></div></td>
            <td nowrap="nowrap" bgcolor="#DDDDDD"><div align="left" class="Estilo2">
              <div align="left">CONDICI&Oacute;N AL EGRESO </div>
            </div></td>
          </tr>
          <tr>
            <td nowrap="nowrap"><div align="left">DESDE
                <select name="fi1" id="fi1">
                  <?php
				for($i=2010;$i<=2020;$i++)
					{
						echo'<option value="'.$i.'"';
						if($aaaa1==$i)
							{
								echo'selected="selected"';
							}
						echo'>'.$i.'</option>';
					}
				  ?>
                </select>
                <select name="fi2" id="fi2">
                  <option value="01"<?php if("$mm1"=='01'){echo'selected="selected"';}?>>Enero</option>
                  <option value="02"<?php if("$mm1"=='02'){echo'selected="selected"';}?>>Febrero</option>
                  <option value="03"<?php if("$mm1"=='03'){echo'selected="selected"';}?>>Marzo</option>
                  <option value="04"<?php if("$mm1"=='04'){echo'selected="selected"';}?>>Abril</option>
                  <option value="05"<?php if("$mm1"=='05'){echo'selected="selected"';}?>>Mayo</option>
                  <option value="06"<?php if("$mm1"=='06'){echo'selected="selected"';}?>>Junio</option>
                  <option value="07"<?php if("$mm1"=='07'){echo'selected="selected"';}?>>Julio</option>
                  <option value="08"<?php if("$mm1"=='08'){echo'selected="selected"';}?>>Agosto</option>
                  <option value="09"<?php if("$mm1"=='09'){echo'selected="selected"';}?>>Septiembre</option>
                  <option value="10"<?php if("$mm1"=='10'){echo'selected="selected"';}?>>Octubre</option>
                  <option value="11"<?php if("$mm1"=='11'){echo'selected="selected"';}?>>Noviembre</option>
                  <option value="12"<?php if("$mm1"=='12'){echo'selected="selected"';}?>>Diciembre</option>
                </select>
                <select name="fi3" id="fi3">
                  <?php
				for($i=1;$i<=31;$i++)
					{
						if($i<10){$cnb="0";}else{$cnb="";}
						echo'<option value="'.$cnb.$i.'"';
						if($dd1==$i)
							{
								echo'selected="selected"';
							}
						echo'>'.$i.'</option>';
					}
				  ?>
                </select>
</div></td>
            <td nowrap="nowrap"><div align="left">
              <select name="pb" id="pb">
                <option value="0" <?php if($pb==0){echo'selected="selected"';} ?> >TODOS</option>
				<option value="1" <?php if($pb==1){echo'selected="selected"';} ?> >VIVOS</option>
				<option value="2" <?php if($pb==2){echo'selected="selected"';} ?> >MUERTOS</option>
              </select>
            </div></td>
          </tr>
          <tr>
            <td nowrap="nowrap"><div align="left">HASTA
                <select name="ff1" id="ff1">
                  <?php
				for($i=2010;$i<=2020;$i++)
					{
						echo'<option value="'.$i.'"';
						if($aaaa2==$i)
							{
								echo'selected="selected"';
							}
						echo'>'.$i.'</option>';
					}
				  ?>
                </select>
                <select name="ff2" id="ff2">
                  <option value="01"<?php if("$mm2"=='01'){echo'selected="selected"';}?>>Enero</option>
                  <option value="02"<?php if("$mm2"=='02'){echo'selected="selected"';}?>>Febrero</option>
                  <option value="03"<?php if("$mm2"=='03'){echo'selected="selected"';}?>>Marzo</option>
                  <option value="04"<?php if("$mm2"=='04'){echo'selected="selected"';}?>>Abril</option>
                  <option value="05"<?php if("$mm2"=='05'){echo'selected="selected"';}?>>Mayo</option>
                  <option value="06"<?php if("$mm2"=='06'){echo'selected="selected"';}?>>Junio</option>
                  <option value="07"<?php if("$mm2"=='07'){echo'selected="selected"';}?>>Julio</option>
                  <option value="08"<?php if("$mm2"=='08'){echo'selected="selected"';}?>>Agosto</option>
                  <option value="09"<?php if("$mm2"=='09'){echo'selected="selected"';}?>>Septiembre</option>
                  <option value="10"<?php if("$mm2"=='10'){echo'selected="selected"';}?>>Octubre</option>
                  <option value="11"<?php if("$mm2"=='11'){echo'selected="selected"';}?>>Noviembre</option>
                  <option value="12"<?php if("$mm2"=='12'){echo'selected="selected"';}?>>Diciembre</option>
                </select>
                <select name="ff3" id="ff3">
                  <?php
				for($i=1;$i<=31;$i++)
					{
						if($i<10){$cnb="0";}else{$cnb="";}
						echo'<option value="'.$cnb.$i.'"';
						if($dd2==$i)
							{
								echo'selected="selected"';
							}
						echo'>'.$i.'</option>';
					}
				  ?>
                </select>
</div></td>
            <td nowrap="nowrap"><div align="right">
              <input name="FechaIni" type="hidden" id="FechaIni" />
              <input name="FechaFin" type="hidden" id="FechaFin" />
            </div></td>
          </tr>
          
          <tr>
            <td height="10" colspan="2" nowrap="nowrap">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" nowrap="nowrap"><div align="left">
              <input name="Enviar" type="button" id="Enviar" onclick="Valida()" value="Consultar" />
            </div></td>
            </tr>
          <tr>
            <td height="10" colspan="2" nowrap="nowrap">&nbsp;</td>
          </tr>
        </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p>        </td>
      </tr>
      
      <tr>
        <td nowrap="nowrap" bgcolor="#EEEEEE">&nbsp;</td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>ID HISTORIA  </strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>USUARIO</strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>CARGO</strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>FECHA CONSULTA  </strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>C&Eacute;DULA</strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>&Aacute;MBITO </strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>PABELL&Oacute;N </strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong># SERVICIO </strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>ESTADO AL INGRESO  </strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><p><strong>INTERVENCIONES REALIZADAS</strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>DIAGN&Oacute;STICO </strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>CONDICI&Oacute;N EGRESO  </strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>TRAT. FARMACOL&Oacute;GICO </strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>COMPLICACIONES  </strong></td>
        <td nowrap="nowrap" bgcolor="#EEEEEE"><strong>RESULTADOS M&Eacute;DICOS  </strong></td>
		<td nowrap="nowrap" bgcolor="#EEEEEE"><strong>ESTADO M&Eacute;DICO EGRESO   </strong></td>
		<td nowrap="nowrap" bgcolor="#EEEEEE"><strong>OTROS DIAGN&Oacute;STICOS    </strong></td>
		<td nowrap="nowrap" bgcolor="#EEEEEE"><strong>TRAT. FARMACOL&Oacute;GICO DE EGRESO</strong></td>
		<td nowrap="nowrap" bgcolor="#EEEEEE"><strong>INCAPACIDAD</strong></td>
		<td nowrap="nowrap" bgcolor="#EEEEEE"><strong>RECOMENDACIONES</strong></td>
      </tr>
	   <tr>
	    <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
	    <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	   <?php
 $cons="select
	id_historia,
	usuario,
	cargo,
	fecha,
	cedula,
	ambito,
	unidadhosp,
	numservicio,
	cmp00004,
	cmp00005,
	dx1,
	cmp00003,
	cmp00006,
	cmp00007,
	cmp00008,
	cmp00009,
	cmp00011,
	cmp00012,
	cmp00013,
	cmp00014
from
	histoclinicafrms.tbl00029
where
	compania='$Compania[0]'
	and fecha >= '$FechaIni' and fecha <= '$FechaFin'
	$qp
order by
	fecha";
//echo $cons;
$res=ExQuery($cons);
$ln=1;
while($fila=ExFetch($res)){
$fila[8]=str_replace('"',"-","$fila[8]");
echo'<tr>
		<td height="10">'.$ln.'</td>
        <td height="10">'.$fila[0].'</td>
        <td height="10">'.$fila[1].'</td>
        <td height="10">'.$fila[2].'</td>
        <td height="10">'.$fila[3].'</td>
        <td height="10">'.$fila[4].'</td>
        <td height="10">'.$fila[5].'</td>
        <td height="10">'.$fila[6].'</td>
        <td height="10">'.$fila[7].'</td>
        <td height="10"><div align="center"><a href="javascript:alert('."'".$fila[8]."'".')">VER ESTADO</a></div></td>
        <td height="10"><div align="center"><a href="javascript:alert('."'".$fila[9]."'".')">VER INTERVENCIONES</a></div></td>
        <td height="10">';
		$consdx="select diagnostico from  salud.cie where codigo='$fila[10]'";
		$resdx=ExQuery($consdx);
		while($filadx=ExFetch($resdx)){
		echo'<div align="center"><a href="javascript:alert('."'".$filadx[0]."'".')">';
		}
		echo "$fila[10]".'</a></div></td>
        <td height="10">'.$fila[11].'</td>
        <td height="10"><div align="center"><a href="javascript:alert('."'".$fila[12]."'".')">VER TRATAMIENTO</a></div></td>
        <td height="10"><div align="center"><a href="javascript:alert('."'".$fila[13]."'".')">VER</a></div></td>
        <td height="10"><div align="center"><a href="javascript:alert('."'".$fila[14]."'".')">VER RESULTADOS</a></div></td>
        <td height="10"><div align="center"><a href="javascript:alert('."'".$fila[15]."'".')">VER ESTADO</a></div></td>
        <td height="10"><div align="center"><a href="javascript:alert('."'".$fila[16]."'".')">VER</a></div></td>
        <td height="10"><div align="center"><a href="javascript:alert('."'".$fila[17]."'".')">VER TRATAMIENTO</a></div></td>
        <td height="10">'.$fila[18].'</td>
        <td height="10"><div align="center"><a href="javascript:alert('."'".$fila[19]."'".')">VER</a></div></td>
      </tr>';
	  $ln++;
	  }
	  ?>
      <tr>
	    <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
	    <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
