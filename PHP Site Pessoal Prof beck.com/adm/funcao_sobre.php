<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?
include "config.php";
$enviar_imagem = $_POST['enviar_imagem'];
$texto = $_POST['texto'];

if($enviar_imagem == "sim"){

	$sql_alt = mysql_query("SELECT * FROM sobre WHERE id = '1'");
	while($linha = mysql_fetch_array($sql_alt)){
		$foto_db = $linha['foto'];
	}
	
		unlink("../fotos/$foto_db");
	
	$foto = $_FILES['arquivo']['name'];
	
	$foto = str_replace(" ", "_", $foto);
	$foto = str_replace("�", "a", $foto);
	$foto = str_replace("�", "a", $foto);
	$foto = str_replace("�", "a", $foto);
	$foto = str_replace("�", "e", $foto);
	$foto = str_replace("�", "e", $foto);
	$foto = str_replace("�", "e", $foto);
	$foto = str_replace("�", "i", $foto);
	$foto = str_replace("�", "i", $foto);
	$foto = str_replace("�", "o", $foto);
	$foto = str_replace("�", "o", $foto);
	$foto = str_replace("�", "c", $foto);

	$foto = strtolower($foto);
	
	if(!eregi("^image\/(jpeg|png|gif|pjpeg|jpg)$", $_FILES['arquivo']['type'])){
		
		echo "
		<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php?pg=sobre'>
		<script type=\"text/javascript\">
		alert(\"Formato inv�lido\");
		</script>
		";
		
	}else{
		
		if(file_exists("../fotos/$foto")){
			$a = 1;
			while(file_exists("../fotos/[$a]$foto")){
				$a++;
			}
			
			$foto = "[".$a."]".$foto;
			
		}
		
		if(!move_uploaded_file($_FILES['arquivo']['tmp_name'], "../fotos/".$foto)){
			
			echo "
		<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php?pg=sobre'>
		<script type=\"text/javascript\">
		alert(\"Erro ao enviar o arquivo.\");
		</script>
		";
			
		}
	
	}		
		$sql = mysql_query("UPDATE sobre SET foto='$foto', texto='$texto' where id = '1'");
		header("Location: index.php?pg=sobre");
		
}else{
		$sql = mysql_query("UPDATE sobre SET texto='$texto' where id = '1'");
		header("Location: index.php?pg=sobre");

}
	
?>