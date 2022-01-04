<?php
    /**
     * Created by PhpStorm.
     * User: yuran
     * Date: 2018/10/13
     * Time: 10:04
     */
namespace App\Admin\Extensions;
use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;

class PondExporter extends AbstractExporter
{
    protected $head = [];
    protected $body = [];
    public function setAttr($head, $body){
        $this->head = $head;
        $this->body = $body;
    }

    public function export()
    {
        //Define the file name as the date and spell uniqid()
        $fileName = date('YmdHis') . '-' . uniqid();

        Excel::create($fileName, function($excel) {
            $excel->sheet('sheet1', function($sheet) {
                //  This logic is to extract the fields that need to be exported from the table data
                $head = $this->head;
                $body = $this->body;
                //init column
                $title_array = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q',
                    'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH'];

                $rows = collect([$head]); //Write title
                $sheet->rows($rows);
                collect( $this->getData() )->map( function ($item,$k)use($body,$sheet,$title_array ) {
                    foreach ($body as $i=>$keyName){
                        if($keyName == 'url') { //Determine the picture column, if it is, put the picture
                            $objDrawing = new App\Admin\Extensions\PHPExcel_Worksheet_Drawing;
                            $v = public_path('/upload/'). array_get($item, $keyName); //Mosaic picture address
                            $objDrawing->setPath( $v );
                            $sp = $title_array[$i];
                            $objDrawing->setCoordinates( $sp . ($k+2) );
                            $sheet->setHeight($k+2, 65); //Set height
                            $sheet->setWidth(array( $sp =>12));  //Set width
                            $objDrawing->setHeight(80);
                            $objDrawing->setOffsetX(1);
                            $objDrawing->setRotation(1);
                            $objDrawing->setWorksheet($sheet);
                        } else { //Otherwise place text data
                            $v = array_get($item, $keyName);
                            $sheet->cell($title_array[$i] . ($k+2), function ($cell) use ($v) {
                                $cell->setValue($v);
                            });
                        }
                    }
                });
            });
        })->export('xls');
    }

}