<?php
class FS_CONFIG {

    // função para explode da url
    function fs_decodifica_url($URL){
        $new_url = explode("&&", urldecode($URL));
        return $new_url;
    }


    //Função de alerta padrão
    function fs_alerta($TEXTO_ALERTA, $tipo = 'sucesso') {
        // 1. Escapa o texto para uso seguro no JavaScript
        $alerta_escapado = addslashes($TEXTO_ALERTA); 
        
        // 2. Define a cor do toast (verde para sucesso, vermelho para erro)
        $cor = ($tipo == 'sucesso') ? '#4CAF50' : '#f44336';
        
        ?>
        <script>
            // Função que cria e exibe o toast
            function exibirToast() {
                // Cria o elemento principal do toast
                var toast = document.createElement('div');
                toast.textContent = '<?php echo $alerta_escapado; ?>';
                
                // Aplica estilos básicos
                toast.style.position = 'fixed';
                toast.style.bottom = '30px';
                toast.style.left = '50%';
                toast.style.transform = 'translateX(-50%)'; // Centraliza o toast
                toast.style.backgroundColor = '<?php echo $cor; ?>';
                toast.style.color = 'white';
                toast.style.padding = '15px 25px';
                toast.style.borderRadius = '5px';
                toast.style.zIndex = '9999'; // Garante que fique acima de outros elementos
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.5s';
                
                // Adiciona o toast ao corpo da página
                document.body.appendChild(toast);

                // 3. Exibe o toast (fade in)
                setTimeout(function() {
                    toast.style.opacity = '1';
                }, 100);

                // 4. Esconde o toast após 4 segundos (4000 milissegundos)
                setTimeout(function() {
                    toast.style.opacity = '0';
                    
                    // Remove o elemento do DOM após a transição de fade out
                    setTimeout(function() {
                        document.body.removeChild(toast);
                    }, 500);
                }, 4000);
            }

            // Chamada imediata da função
            exibirToast();
        </script>
        <?php
    }

} // fim da classe
?>