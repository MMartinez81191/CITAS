<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require(APPPATH.'/third_party/fpdf/fpdf.php');
 
    //Extendemos la clase PDF_AUTOAJUSTE de la clase fpdf para que herede todas sus variables y funciones
    class PDF_AUTOAJUSTE extends FPDF {
        public function __construct() {
            parent::__construct();
        }

        public function Header(){
        }

        public function Footer(){
            $this->SetFont('Arial','I',8);
            $this->SetXY(80,290);
            $this->Cell(20);
            $this->Cell(50,0, utf8_decode('SISTEMA PBR'),0,0,'L');
            $this->Cell(30);
            $this->Cell(20,0, utf8_decode('Página').$this->PageNo(),0,0,'C');

        }

        var $widths; var $aligns;
        public function SetWidths($w){
            //Set the array of column widths
            $this->widths=$w;
        }

        public function SetAligns($a){
            //Set the array of column alignments
            $this->aligns=$a;
        }

        public function Row($data,$borde){
            //Calculate the height of the row
            $nb=0;
            for($i=0;$i<count($data);$i++)
                $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
            $h=5*$nb;
            //Issue a page break first if needed
            $this->CheckPageBreak($h);
            //Draw the cells of the row
            for($i=0;$i<count($data);$i++) {
                $w=$this->widths[$i];
                $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                //Save the current position
                $x=$this->GetX();
                $y=$this->GetY();
                //Draw the border
                if ($borde == true) {
                    $this->Rect($x,$y,$w,$h);
                }
                //Print the text
                $this->MultiCell($w,5,$data[$i],0,$a);
                //Put the position to the right of the cell
                $this->SetXY($x+$w,$y);
            }
            //Go to the next line
            $this->Ln($h);
        }

        public function CheckPageBreak($h){
            //If the height h would cause an overflow, add a new page immediately
            if($this->GetY()+$h>$this->PageBreakTrigger)
                $this->AddPage($this->CurOrientation);
        }

        public function NbLines($w,$txt){
            //Computes the number of lines a MultiCell of width w will take
            $cw=&$this->CurrentFont['cw'];
            if($w==0)
                $w=$this->w-$this->rMargin-$this->x;
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
            $s=str_replace("\r",'',$txt);
            $nb=strlen($s);
            if($nb>0 and $s[$nb-1]=="\n")
                $nb--;
            $sep=-1;
            $i=0;
            $j=0;
            $l=0;
            $nl=1;
            while($i<$nb){
                $c=$s[$i];
                if($c=="\n"){
                    $i++;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                    continue;
                }
                if($c==' ')
                    $sep=$i;
                $l+=$cw[$c];
                if($l>$wmax){
                    if($sep==-1){
                        if($i==$j)
                            $i++;
                    }
                    else
                        $i=$sep+1;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                }
                else
                    $i++;
            }
            return $nl;
        }

    }
?>