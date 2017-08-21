<?php
class CExport {
    static private $export="";
    static private $Key="A1,B1,C1,D1,E1,F1,G1,H1,I1,J1,K1,L1,M1,N1,O1,P1,Q1,R1,S1,T1,U1,V1,W1,S1,Y1,Z1";
    static private $Key2="A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,S,Y,Z";
    static function downloadxml($key,$data,$delkey=[]){
//        print_r($data);
//        die;
        if(empty($data)){
            exit("没有数据，无需下载");
        }
//        if(self::$export === ""){
            include_once WEBDIR."/application/libraries/PHPExcel.php";
            self::$export=new \PHPExcel();
//        }
            
        $arr= explode(",", self::$Key);
        $key=array_combine(array_values(array_slice( $arr ,0 , count($key) )) , $key);
        self::$export->getProperties();
//                ->setCreator("优正品")
//                ->setLastModifiedBy("优正品")
//                ->setTitle("优正品文件")
//                ->setSubject("优正品Excel文件")
//                ->setDescription("优正品文件，来自网站系统")
//                ->setKeywords("优正品")
//                ->setCategory("优正品");
        $obj=self::$export->setActiveSheetIndex(0);
        
        foreach($key as $k =>$v){
            $obj-> setCellValue($k,$v);
        }

        $arr= explode(",", self::$Key2);
        $key=array_slice( $arr ,0 , count($key));
        
        foreach ($data as $k1=> $array){
            $obj=self::$export-> setActiveSheetIndex(0);
            $k2=0;
            foreach ($array as $dk=> $vv){
                if( array_search($dk, $delkey) !== FALSE){
                    continue;
                }
               $obj->setCellValue( $key[$k2].($k1+2) ,$vv );
               $k2++;
            }
        }
        $filename =date('YmdHis')."_".md5(json_encode($data)) .".xlsx";
        self::$export->getActiveSheet()->setTitle('Simple');
        self::$export->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = PHPExcel_IOFactory::createWriter(self::$export, 'Excel2007');
        $objWriter->save('php://output');die;
    }
    
    
    
}
