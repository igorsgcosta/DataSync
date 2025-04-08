<?php
if (!extension_loaded('zip')) {
    die("Erro: A extensão ZIP não está habilitada no PHP. Habilite-a no arquivo php.ini.");
} else {
    echo "Extensão ZIP está habilitada!";
}
?>
