<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se foi enviado um arquivo de imagem
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == UPLOAD_ERR_OK) {
        $extensoes_permitidas = array('jpg', 'jpeg', 'png', 'bmp');
        $extensao = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
        
        // Verifica se a extensão do arquivo está na lista de extensões permitidas
        if (in_array(strtolower($extensao), $extensoes_permitidas)) {
            // Cria o diretório "uploads" se ele não existir
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }
            
            // Move o arquivo para o diretório desejado
            move_uploaded_file($_FILES["imagem"]["tmp_name"], 'uploads/' . $_FILES["imagem"]["name"]);
            // Exibe a imagem
            echo '<img src="uploads/' . $_FILES["imagem"]["name"] . '" alt="Imagem enviada">';
        } else {
            echo "Apenas arquivos com extensões JPG, JPEG, PNG ou BMP são permitidos para imagens.";
        }
    }

    // Verifica se foi enviado um arquivo PDF
    if (isset($_FILES["pdf"]) && $_FILES["pdf"]["error"] == UPLOAD_ERR_OK) {
        // Cria o diretório "uploads" se ele não existir
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }
        
        // Move o arquivo para o diretório desejado
        move_uploaded_file($_FILES["pdf"]["tmp_name"], 'uploads/' . $_FILES["pdf"]["name"]);
        // Cria um link para o arquivo PDF
        echo '<a href="uploads/' . $_FILES["pdf"]["name"] . '">Download do PDF</a>';
    }
}
?>