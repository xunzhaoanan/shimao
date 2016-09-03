<?php
/**
 * Author: Kevin
 * Date: 2015/07/20
 * Time: 22:25
 */

namespace common\vendor\phpexcel;

require_once('PHPExcel.php');
require_once('PHPExcel/Autoloader.php');
require_once('PHPExcel/Reader/Excel5.php');

class excel{

    static public function download($data, $fileName = 'data.xsl')
    {
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1');
        $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); $objWriter->save('php://output');
    }

    public static function toArray($file)
    {
        $objPHPExcel = \PHPExcel_IOFactory::load($file);
        return $objPHPExcel->getSheet(0)->toArray(null, true, true, true);
    }

    static public function getExcelData($excelFile= null)
    {
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load($excelFile);
        $sheet=$objPHPExcel->getSheet(0);//获取第一个工作表
        $highestRow=$sheet->getHighestRow();//取得总行数
        $highestColumn=$sheet->getHighestColumn(); //取得总列数

        $data = [];
        for($j=1; $j<= $highestRow; $j++) { //从第1行开始
            $arrResult = '';
            for ($k = 'A'; $k <= $highestColumn; $k++) {
                //读取单元格
                $arrResult .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue() . ',';
            }
            $arrResult = rtrim($arrResult, ",");
            $data[] = explode(",", $arrResult);
        }
        return $data;
    }

}