<?php
// Incluir a biblioteca FPDF
require('fpdf.php');  // Verifique o caminho para o arquivo 'fpdf.php'

// Criar uma nova instância do FPDF
$pdf = new FPDF();
$pdf->AddPage();  // Adiciona uma página ao PDF

// Definir a fonte
$pdf->SetFont('Arial', 'B', 12);

// Adicionar conteúdo no PDF
$pdf->Cell(0, 10, 'Relatório de Denúncia', 0, 1, 'C');

// Gerar o PDF e forçar o download
$pdf->Output('D', 'relatorio_denuncia.pdf');
?>
