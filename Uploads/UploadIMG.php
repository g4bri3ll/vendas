<?php

/*Aqui tem que pegar o array primeiro e fazer o for para a contagem e cadastrado no banco de dados, tem que passa por cada um e n�o
 * esta passando, so esta pegando o 1 e esta gravando no banco de dados*/

include_once 'C://xampp//htdocs//projeto-juliana//classes//Foto.php';
include_once 'C://xampp//htdocs//projeto-juliana//DAO//FotoDAO.php';
include_once 'C://xampp//htdocs//projeto-juliana//DAO//ProdutoDAO.php';

class UploadIMG{
		
	function img($foto){
		
		// Colocando a foto do produto
		if (isset ( $foto )) {
		
			date_default_timezone_set ( "Brazil/East" );
			
			$name = $foto['name']; // Atribui uma array com os nomes dos arquivos � vari�vel
			
			$tmp_name = $foto ['tmp_name']; // Atribui uma array com os nomes tempor�rios dos arquivos � vari�vel
			
			$type = $foto["type"]; //tipo da foto
			
			$size = $foto["size"]; //Tamanho da foto
			
			$idProduto = $id; //Recebe o id do produto
			
			for($i = 0; $i < count ( $tmp_name ); $i ++) // passa por todos os arquivos
				{
					
					// Se a foto estiver sido selecionada
					if (!empty($name[$i])) {
					
						// Largura m�xima em pixels
						$largura = 1950;
						// Altura m�xima em pixels
						$altura = 1980;
						// Tamanho m�ximo do arquivo em bytes
						$tamanho = 100000;
					
						// Verifica se o arquivo � uma imagem
						if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $type[$i])){
							$error[1] = "Isso n�o � uma imagem.";
						}
					
						// Pega as dimens�es da imagem
						$dimensoes = getimagesize($tmp_name[$i]);
					
						// Verifica se a largura da imagem � maior que a largura permitida
						if($dimensoes[0] > $largura) {
							$error[2] = "A largura da imagem n�o deve ultrapassar ".$largura." pixels";
						}
					
						// Verifica se a altura da imagem � maior que a altura permitida
						if($dimensoes[1] > $altura) {
							$error[3] = "Altura da imagem n�o deve ultrapassar ".$altura." pixels";
						}
					
						// Verifica se o tamanho da imagem � maior que o tamanho permitido
						if($size[$i] > $tamanho) {
							$error[4] = "A imagem deve ter no m�ximo ".$tamanho." bytes";
						}
					
						// Se n�o houver nenhum erro
						if (empty($error)) {
					
							// Pega extens�o da imagem
							preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $name[$i], $ext);
					
							// Gera um nome �nico para a imagem
							$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
									
							// Caminho de onde ficar� a imagem
							$caminho_imagem = "C://xampp//htdocs//projeto-juliana//img//fotos_lembrancinhas//" . $nome_imagem;
					
							// Faz o upload da imagem para seu respectivo caminho
							move_uploaded_file($tmp_name[$i], $caminho_imagem);
								
								$fotDAO = new FotoDAO();
								$fotDAO->alterarFoto($idProduto, $nome_imagem);
						
						}
					
						// Se houver mensagens de erro, exibe-as
						if (!empty($error)) {
							foreach ($error as $erro) {
								echo $erro . "<br />";
							}//Fechar o foreach
						}//Fecha o if $error
					}//Fecha o if $name 
					
				}//Fecha o for
			
			}//Fecha o if do isset
		
		}//Fecha o function

}//Fecha a classe