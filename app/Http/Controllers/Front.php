<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imagen;

use Spatie;

class Front extends Controller
{
    public function index(){
    	return view('firma');
    }

    public function add(Request $request,$referencia_id){
        if($request->file('imagen'))
        {
            $imagen = new Imagen();
            $file = $request->file('imagen');
            $name = $request->referencia."_".microtime().'.'.$file->getClientOriginalExtension();
            $name=str_replace(" ","_",$name);
            $path = public_path().'/imagenes/uploads/';
            $file->move($path,$name);
            //$imagen->nombre=$file->name;
            $imagen->ruta=$name;
            $imagen->save();
            if($request->ajax())
            {
                return response()->json(["error"=>FALSE]);
            }else{
                return redirect()->route(URL::previuos());
            }
        }
    }

    /**
     * Toma la nueva imagen codificada en base64 y el nombre temporal
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function load(Request $request){
        if($request->data)
        {
            $imagen = new Imagen();
            $path = public_path().'/img/';

            //obtengo nombre de la imagen
            $file = 'png';
            //genero nombre unico para la imagen agregando la fecha
            $name = 'usu_'.time().'.'.$file;
            //creo un archivo temporal vacio con el nuevo nombre en la carpeta que iene permisos de escritura
            $ifp = fopen($path.$name, "wb"); 
            //separo la cadena data por la coma
            $data = explode(',', $request->data);
            //escribo en el nuevo archivo el contenido despues de la coma
            //docodificando el base64
            fwrite($ifp, base64_decode($data[1])); 
            //cierro el archivo
            fclose($ifp); 
            $imagen->ruta=$name;
            $imagen->save();
        }
        if($request->ajax())
        {
            return response()->json(["error"=>FALSE]);
        }else{
            return redirect()->route(URL::previuos());
        }
    }


    public function test(){
        $file =  public_path().'/uploads/cuentas.pdf';
        
        $destino =  public_path().'/uploads/img.png';


        $pdf = new Spatie\PdfToImage\Pdf($file);
        $pdf->saveImage($destino);
    }

    public function pdf(){

        $file =  public_path().'/uploads/cuentas.pdf';
        
        $sign =  public_path().'/img/usu_1523390746.png';

        // Create new Landscape PDF
        $pdf = new \setasign\Fpdi\Fpdi('l');
        // Reference the PDF you want to use (use relative path)
        $pagecount = $pdf->setSourceFile( $file );
        // Import the first page from the PDF and add to dynamic PDF
        $tpl = $pdf->importPage(1);
        $pdf->AddPage();
        // Use the imported page as the template
        $pdf->useTemplate($tpl);
        // Set the default font to use
        $pdf->SetFont('Helvetica');
        // adding a Cell using:
        // $pdf->Cell( $width, $height, $text, $border, $fill, $align);

        $pdf->Image($sign, 130, 0, 100, 33);
        

        $pdf->SetFontSize('14');
        $pdf->SetXY(185,20);
        $pdf->Cell(100, 40, 'Jaime Santana', 0, 0);
        // ci
        $pdf->SetFontSize('14');
        $pdf->SetXY(185,30);
        $pdf->Cell(100, 40, '1600392359', 0, 0);

        // render PDF to browser
        $pdf->Output();
    }
}
