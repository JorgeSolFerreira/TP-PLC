<?php
	$dbh = new PDO('mysql:host=localhost;dbname=gamu', 'root', 'root');

	$qstring = "SELECT * FROM audicao ORDER BY audicao_data LIMIT 5";
	$audicoes = $dbh->query($qstring);

	while($aud = $audicoes->fetch()){
		$qstring = "SELECT COUNT(*) AS o, COUNT(DISTINCT atuacao_id) AS a FROM atuacao_obra 
					WHERE atuacao_id IN (
						SELECT atuacao_id FROM atuacao
						WHERE atuacao_audicao='".$aud['audicao_id']."'
					)";
		$nums = $dbh->query($qstring)->fetch();

		echo "<tr><th>";
		echo "<a href='pages/audicoes/consultar_audicao.html?id=".$aud['audicao_id']."' style='color:#666666;'>Audição dia ".$aud['audicao_data']." às ".$aud['audicao_hora'].", com o título <i>\"".$aud['audicao_titulo']." - ".$aud['audicao_subtitulo']."\"</i>, onde será(ão) apresentada(s) ".$nums['o']." obra(s) musical(is) ao longo de ".$nums['a']." atuação(ões)</a>";
		echo "</th></tr>";
	}

?>