public function imprimir_reporte_citas()
	{
		
		if($this->seguridad() == TRUE)
		{
			//Datos necesarios para crear PDF
	        $fecha_actual=date("d/m/Y");
	        $hora = date("h:m:s a");
	        $this->load->library('fpdf_manager');
	        $pdf = new fpdf_manager('P','mm',array(80,550));
	        $pdf->SetMargins(1,1,1,1);
	        
	        $Nombre_archivo = 'Reporte de Citas.pdf';
            $pdf->SetTitle("Corte de Caja");
	        $pdf->AddPage();
	        $pdf->setY(3);
	        /*Encabezado*/
	        $pdf->Image(base_url().'images/logo.jpg',60,3,20);
	        $pdf->SetFont('Arial','B',12);
	        //$pdf->Cell(90,6,'',0,0);
	        
	        $pdf->Cell(0,6,'CORTE DE CAJA',0,0,'L');
	        $pdf->ln();
	        $pdf->ln();
	        $pdf->SetFont('Arial','B',9);
	        $pdf->Cell(0,6,'Fecha:'.$fecha_actual,0,0,'L');
	        $pdf->Ln();
	        $pdf->Cell(0,5,"Realizado Por:".$this->session->userdata('nombre'),0,0,'L');
	        $pdf->Ln();
	        $pdf->Ln();


			$operacion = $this->uri->segment(3);
			$total_corte = 0;

			switch ($operacion) {
				case '1':
					$dia = $this->uri->segment(4);
					$DATA_BALANCE = $this->Corte_model->get_balance_general($dia);
					$DATA_CITAS = $this->Corte_model->get_citas_dia($dia);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_dia_membresia($dia);
					$DATA_GASTO = $this->Corte_model->get_gasto_dia($dia);
					$DATA_DEVOLUCION = $this->Corte_model->get_devolucion_dia($dia);
					$DATA_CARNET = $this->Corte_model->get_venta_carnets_dia($dia);
					break;
				case '2':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_mes($mes,$anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_mes_membresia($mes,$anio);
					$informacion_cita = 'EL MES '.$mes. ' DEL AÑO '.$anio;
					break;
				case '3':
					$anio = $this->uri->segment(4);
					$DATA_CITAS = $this->Corte_model->get_citas_anio($anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_anio_membresia($anio);
					$informacion_cita = 'EL AÑO '.$anio;
					break;
				case '4':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_pendientes($mes,$anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_pendientes_membresia($mes,$anio);
					$informacion_cita = 'EL MES '.$mes. ' DEL AÑO '.$anio;
					break;
				default:
					$DATA_CITAS = FALSE;
					break;
			}

			
	        
	        if($DATA_CITAS != FALSE)
	        {
	        	
	        	$pdf->SetFillColor(175,175,175);
	        	$pdf->Cell(0,5,'INGRESOS CONSULTAS',0,1,'C');


	        	$pdf->Cell(10,5,'Cant',1,0,'C',1);
		        $pdf->Cell(28,5,'Concepto',1,0,'C',1);
		        $pdf->Cell(20,5,'Costo',1,0,'C',1);
		        $pdf->Cell(20,5,'Importe',1,1,'C',1);

	        	foreach($DATA_BALANCE->result() as $row)
	        	{
	        		
	        		/*$total_consultas = 

			        $pdf->SetFont('Arial','',9);
			        $pdf->Cell(27,5,$row->descripcion,1,0,'C',0);
			        if($row->descripcion == "Total gastos" OR $row->descripcion == "Total devoluciones")
			        {
			        	$pdf->Cell(19,5,$row->numero,1,0,'C',0);
			        	$pdf->Cell(0,5,number_format(($row->total * -1),2,'.', ','),1,1,'C');
			        	$total_corte = $total_corte - $row->total;
			        }
			        else
			        {
			        	if($row->descripcion == "Venta de carnets")
			        	{
			        		$pdf->Cell(19,5,$row->numero,1,0,'C',0);
			        	}
			        	else
			        	{
			        		$pdf->Cell(19,5,$row->numero_pacientes,1,0,'C',0);
			        	}
			        	
			        	$pdf->Cell(24,5,number_format($row->total,2,'.', ','),1,1,'C',0);
			        	$total_corte = $row->total + $total_corte;

			        }
			        */
			        



	        		/*$pdf->SetFont('Arial','B',9);
	        		$pdf->Cell(0,5,$row->descripcion,1,1,'L',1);
	        		
        			$pdf->SetFont('Arial','',7);

			        $pdf->Cell(28,5,'Numero:',1,0,'C',1,0);
			        
			        if($row->numero_pacientes == "0")
			        {
			        	$pdf->Cell(0,5,$row->numero,1,1,'L');
			        }
			        else
			        {
			        	$pdf->Cell(0,5,$row->numero_pacientes,1,1,'L');
			        }
			        
			        if($row->descripcion == "Total gastos" OR $row->descripcion == "Total devoluciones")
			        {
			        	$pdf->Cell(28,5,'Importe:',1,0,'C',1,0);
				        $pdf->Cell(0,5,number_format(($row->total * -1),2,'.', ','),1,1,'L');

				        $total_corte = $total_corte - $row->total;
			        }
			        else
			        {
			        	$pdf->Cell(28,5,'Costo:',1,0,'C',1,0);
				        $pdf->Cell(0,5,number_format($row->costo,2,'.', ','),1,1,'L');

				        $pdf->Cell(28,5,'Importe:',1,0,'C',1,0);
				        $pdf->Cell(0,5,number_format($row->total,2,'.', ','),1,1,'L');

				        $total_corte = $row->total + $total_corte;
			        }*/
	        	}

	        	$pdf->SetFillColor(155,155,155); 
	        	$pdf->SetFont('Arial','B',10);
		        $pdf->Cell(46,5,'Total:',1,0,'C',1,0);
		        $pdf->Cell(0,5,'$'.number_format($total_corte,2,'.', ','),1,0,'C');
	        }

	        $pdf->ln();
	        $pdf->ln();
        	

	        if($DATA_MEMBRESIA != FALSE)
	        {
	        	$pdf->Cell(0,5,'DETALLE MEMBRESIAS',0,1,'C');

	        	$pdf->SetFillColor(175,175,175); 
	        	$pdf->SetFont('Arial','B',9);
	        	
		        $pdf->Cell(22,5,'Folio',1,0,'C',1);
		        $pdf->Cell(24,5,'Consulta',1,0,'C',1);
		        $pdf->Cell(24,5,'Importe',1,0,'C',1);
		        
		        $pdf->Ln();
		        $total_corte = 0;
	        	foreach($DATA_MEMBRESIA->result() as $row)
	        	{
	        		$total_corte = $row->costo_consulta + $total_corte;
        			$pdf->SetFont('Arial','',7);
			        $pdf->Cell(22,5,$row->numero_membresia,1,0,'C');
			        $pdf->Cell(24,5,$row->numero_cita,1,0,'C');
			        $pdf->Cell(24,5,'$'.number_format($row->costo_consulta,2,'.', ','),1,0,'C');
			        $pdf->Ln();

	        	}

	        	$pdf->SetFillColor(155,155,155); 
	        	$pdf->SetFont('Arial','B',10);
		        $pdf->Cell(46,5,'Total:',1,0,'R');
		        $pdf->Cell(24,5,'$'.number_format($total_corte,2,'.', ','),1,0,'C');
	        }

			$pdf->Output($Nombre_archivo, 'I');
		}else{
			redirect(base_url());
		}
		/*if($this->seguridad() == TRUE)
		{
			//Datos necesarios para crear PDF
	        $fecha_actual=date("d/m/Y");
	        $hora = date("h:m:s a");
	        $this->load->library('fpdf_manager');
	        $pdf = new fpdf_manager();
	        
	        
	        $Nombre_archivo = 'Reporte de Citas.pdf';
            $pdf->SetTitle("Corte de Caja");
	        $pdf->AddPage();
	        /*Encabezado*
	        $pdf->Image(base_url().'images/logo.jpg',10,8,20);
	        $pdf->SetFont('Arial','B',12);
	        //$pdf->Cell(90,6,'',0,0);
	        $pdf->Cell(0,6,'REPORTE DE CITAS',0,0,'C');
	        $pdf->SetFont('Arial','I',7);
	        $pdf->Cell(0,6,'Fecha de realizacion:'.$fecha_actual,0,0,'R');
	        $pdf->Ln();


	        $pdf->SetFont('Arial','B',11);
	        $pdf->Cell(90,6,"",0,0);
	        $pdf->Cell(97,6,"",0,0,'C');
	        $pdf->Cell(90,6,"",0,0,'R');
	        $pdf->Ln();
	        $pdf->Ln();

	        
	        $pdf->Cell(30,5,"Realizado Por:",0,0,'L');
	        $pdf->SetFont('Arial','',12);
	        $pdf->Cell(222,5,$this->session->userdata('nombre'),0,0,'L');
	        $pdf->Ln();

	        $pdf->SetFont('Arial','',8);
	        $pdf->Cell(65,5,'',0,0,'R');
	        $pdf->Cell(25,5,"",0,0,'L');
	        $pdf->Ln();
	        $pdf->Ln();


			$operacion = $this->uri->segment(3);
			$total_corte = 0;

			switch ($operacion) {
				case '1':
					$dia = $this->uri->segment(4);
					$DATA_CITAS = $this->Corte_model->get_citas_dia($dia);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_dia_membresia($dia);
					$informacion_cita = 'EL DIA '.$dia;
					break;
				case '2':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_mes($mes,$anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_mes_membresia($mes,$anio);
					$informacion_cita = 'EL MES '.$mes. ' DEL AÑO '.$anio;
					break;
				case '3':
					$anio = $this->uri->segment(4);
					$DATA_CITAS = $this->Corte_model->get_citas_anio($anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_anio_membresia($anio);
					$informacion_cita = 'EL AÑO '.$anio;
					break;
				case '4':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_pendientes($mes,$anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_pendientes_membresia($mes,$anio);
					$informacion_cita = 'EL MES '.$mes. ' DEL AÑO '.$anio;
					break;
				default:
					$DATA_CITAS = FALSE;
					break;
			}
	        

	        $pdf->SetFont('Arial','B',12);
	        $pdf->Cell(0,5,utf8_decode('LISTADO DE CITAS REGISTRADAS '.$informacion_cita),0,0,'L');
	        $pdf->Ln();
	        $pdf->SetFont('Arial','',8);
	        $pdf->Ln();

	        
	        if($DATA_CITAS != FALSE)
	        {
	        	
	        	$pdf->SetFillColor(175,175,175); 
	        	$pdf->SetFont('Arial','B',10);
	        	$pdf->Cell(15,5,'',0,0,'C',0,0);
		        $pdf->Cell(40,5,'Pacientes',1,0,'C',1);
		        $pdf->Cell(40,5,'Tipo Cita',1,0,'C',1);
		        $pdf->Cell(40,5,'Costo',1,0,'C',1);
		        $pdf->Cell(40,5,'Total',1,0,'C',1);
		        $pdf->Ln();
		        
	        	foreach($DATA_CITAS->result() as $row)
	        	{
	        		$total_corte = $row->total + $total_corte;
        			$pdf->SetFont('Arial','',7);
			        $pdf->Cell(15,5,'',0,0,'C',0,0);
			        $pdf->Cell(40,5,$row->pacientes,1,0,'C');
			        $pdf->Cell(40,5,$row->tipo_cita,1,0,'L');
			        $pdf->Cell(40,5,'$'.number_format($row->costo,2,'.', ','),1,0,'C');
			        $pdf->Cell(40,5,'$'.number_format($row->total,2,'.', ','),1,0,'C');

			        $pdf->Ln();

			        if($pdf->getY() > 250)
			        {
			        	$pdf->Ln();
				        $pdf->SetY(-30);
				        $pdf->Cell(0,3,$pdf->PageNo(),0,0,'C');
			        	$this->encabezado_pdf($pdf,$fecha_actual);
			        }

	        		
	        	}

	        	$pdf->SetFillColor(155,155,155); 
	        	$pdf->SetFont('Arial','B',10);
		        $pdf->Cell(15,5,'',0,0,'C',0,0);
		        $pdf->Cell(120,5,'Total:',1,0,'R');
		        $pdf->Cell(40,5,'$'.number_format($total_corte,2,'.', ','),1,0,'C');
	        }
	        $pdf->Ln();
	        $pdf->Ln();
	        $pdf->SetFont('Arial','B',12);
	        $pdf->Cell(0,5,utf8_decode('DETALLE MEMBRESIAS REGISTRADAS '.$informacion_cita),0,0,'L');
	        $pdf->SetFont('Arial','',8);
	        $pdf->Ln();
	        $pdf->Ln();


	        if($DATA_MEMBRESIA != FALSE)
	        {
	        	
	        	$pdf->SetFillColor(175,175,175); 
	        	$pdf->SetFont('Arial','B',10);
	        	$pdf->Cell(35,5,'',0,0,'C',0,0);
		        $pdf->Cell(40,5,'Folio Membresia',1,0,'C',1);
		        $pdf->Cell(40,5,'Numero Consulta',1,0,'C',1);
		        $pdf->Cell(40,5,'Importe',1,0,'C',1);
		        
		        $pdf->Ln();
		        $total_corte = 0;
	        	foreach($DATA_MEMBRESIA->result() as $row)
	        	{
	        		$total_corte = $row->costo_consulta + $total_corte;
        			$pdf->SetFont('Arial','',7);
			        $pdf->Cell(35,5,'',0,0,'C',0,0);
			        $pdf->Cell(40,5,$row->numero_membresia,1,0,'C');
			        $pdf->Cell(40,5,$row->numero_cita,1,0,'L');
			        $pdf->Cell(40,5,'$'.number_format($row->costo_consulta,2,'.', ','),1,0,'C');
			        

			        $pdf->Ln();

			        if($pdf->getY() > 250)
			        {
			        	$pdf->Ln();
				        $pdf->SetY(-30);
				        $pdf->Cell(0,3,$pdf->PageNo(),0,0,'C');
			        	$this->encabezado_pdf($pdf,$fecha_actual);
			        }

	        		
	        	}

	        	$pdf->SetFillColor(155,155,155); 
	        	$pdf->SetFont('Arial','B',10);
		        $pdf->Cell(35,5,'',0,0,'C',0,0);
		        $pdf->Cell(80,5,'Total:',1,0,'R');
		        $pdf->Cell(40,5,'$'.number_format($total_corte,2,'.', ','),1,0,'C');
	        }

	        $pdf->Ln();
	        $pdf->SetY(-30);
	        $pdf->Cell(0,3,$pdf->PageNo(),0,0,'C');

			$pdf->Output($Nombre_archivo, 'I');
		}else{
			redirect(base_url());
		}*/
	}