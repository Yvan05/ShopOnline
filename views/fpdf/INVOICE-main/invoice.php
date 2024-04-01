<?php   
        # Incluyendo librerias necesarias #
	require_once "views/fpdf/INVOICE-main/code128.php";
       
	$pdf = new PDF_Code128('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();

	# Logo de la empresa formato png #
	$pdf->Image('assets/img/logo.png',165,12,35,35,'PNG');

	# Encabezado y datos de la empresa #
	$pdf->SetFont('Arial','B',16);
	$pdf->SetTextColor(32,100,210);
	$pdf->Cell(150,10,utf8_decode(strtoupper("TIENDA ONLINE ShopYL")),0,0,'L');

	$pdf->Ln(9);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(150,9,utf8_decode("RUC: 123456789"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,utf8_decode("Direccion Ensenada,Baja California ,Mexico"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,utf8_decode("Teléfono: 646-123-52-89"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,utf8_decode("Email: developer@ejemplo.com"),0,0,'L');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,7,utf8_decode("Fecha de emisión:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,utf8_decode(date("d/m/Y", strtotime(date('Y-m-d')))." ".date("h:s:A")),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(35,7,utf8_decode(strtoupper("Factura Nro.")),0,0,'C');

	$pdf->Ln(7);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(12,7,utf8_decode("Cajero:"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(134,7,utf8_decode("Developer php jr"),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,7,utf8_decode(strtoupper($pedido->id)),0,0,'C');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(13,7,utf8_decode("Cliente:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,utf8_decode($_SESSION['identity']->nombre." ".$_SESSION['identity']->apellidos),0,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(8,7,utf8_decode("Doc: "),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,utf8_decode("DNI:".$_SESSION['identity']->id),0,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(10,7,utf8_decode("Email:"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(30,7,utf8_decode($_SESSION['identity']->email),0,0);
	$pdf->SetTextColor(39,39,51);

	$pdf->Ln(7);

	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(6,7,utf8_decode("Dir:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(109,7,utf8_decode($pedido->pais.",".$pedido->estado.",".$pedido->municipio.",".$pedido->direccion),0,0);

	$pdf->Ln(9);

	# Tabla de productos #
	$pdf->SetFont('Arial','',8);
	$pdf->SetFillColor(23,83,201);
	$pdf->SetDrawColor(23,83,201);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(90,8,utf8_decode("Descripción"),1,0,'C',true);
	$pdf->Cell(15,8,utf8_decode("Cant."),1,0,'C',true);
	$pdf->Cell(25,8,utf8_decode("Precio"),1,0,'C',true);
	$pdf->Cell(19,8,utf8_decode("Total."),1,0,'C',true);
	$pdf->Cell(32,8,utf8_decode("Desc"),1,0,'C',true);

	$pdf->Ln(8);

	
	$pdf->SetTextColor(39,39,51);
        
         /*----------  Operacion para descuento de productos  ----------*/
         
        
	/*----------  Detalles de la tabla  ----------*/
        while ($producto = $productos->fetch_object()){
        $oferta=$producto->oferta/100;
        $desc=($oferta*$producto->precio)*$producto->unidades;
        //$desc=$producto->precio-$result;
	$pdf->Cell(90,7,utf8_decode($producto->nombre),'L',0,'C');
	$pdf->Cell(15,7,utf8_decode($producto->unidades ),'L',0,'C');
	$pdf->Cell(25,7,utf8_decode($producto->precio." MXN" ),'L',0,'C');
        $stats = Utilities::statsCar();
	$pdf->Cell(19,7,utf8_decode("$".($producto->unidades*$producto->precio). " MXN"),'L',0,'C');
	$pdf->Cell(32,7,utf8_decode("-$".$desc." MXN off"),'LR',0,'C');
	$pdf->Ln(7);
	/*----------  Fin Detalles de la tabla  ----------*/
        }

	
	$pdf->SetFont('Arial','B',9);
	
	# Impuestos & totales #
	$pdf->Cell(100,7,utf8_decode(''),'T',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'T',0,'C');
	$pdf->Cell(32,7,utf8_decode("SUBTOTAL"),'T',0,'C');
	$pdf->Cell(34,7,utf8_decode("+".$pedido->coste." MXN"),'T',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(32,7,utf8_decode("IVA (13%)"),'',0,'C');
	$pdf->Cell(34,7,utf8_decode("+ $0.00 MXN"),'',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');


	$pdf->Cell(32,7,utf8_decode("TOTAL A PAGAR"),'T',0,'C');
	$pdf->Cell(34,7,utf8_decode("$".$pedido->coste." MXN"),'T',0,'C');

	

	

	$pdf->Ln(12);

	$pdf->SetFont('Arial','',9);

	$pdf->SetTextColor(39,39,51);
	$pdf->MultiCell(0,9,utf8_decode("*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar esta factura ***"),0,'C',false);

	$pdf->Ln(9);

	# Codigo de barras #
	$pdf->SetFillColor(39,39,51);
	$pdf->SetDrawColor(23,83,201);
	$pdf->Code128(72,$pdf->GetY(),"COD000001V0001",70,20);
	$pdf->SetXY(12,$pdf->GetY()+21);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,5,utf8_decode("COD000001V0001"),0,'C',false);

	# Nombre del archivo PDF #
	$pdf->Output("I","Factura_Nro_1.pdf",true);
        ?>