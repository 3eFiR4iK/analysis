<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JournalEvent as event;

class JournalExportController extends Controller
{
    public function export(){
        $i=1;
        $word = new \PhpOffice\PhpWord\PhpWord();
        $word->setDefaultFontName('Times New Roman');
        $word->setDefaultFontSize(14);
        
        
        $fontStyle = array('bold'=>true);
        $listStyle = array('listType'=>\PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED);
        
        $section = $word->addSection();
        
        $events = event::with('categories')->orderBy('category_id')->get();
        
        $lastID= -1;
        $section->addText('4. ТЕХНИЧЕСКАЯ ДЕЯТЕЛЬНОСТЬ',$fontStyle);    
        foreach($events as $e){
            $id = $e->category_id;
            if($lastID != $id){
                $section->addText(htmlspecialchars('4.'.$i.' '.$e->categories->name.':'), $fontStyle);
                $i++;
            }
            if($e->count > 0)
            $section->addListItem(htmlspecialchars($e->name.'-'.$e->count),0,array(),$listStyle);  
            $lastID = $e->category_id;
        }
        
       $headers = [
	'Content-Description' => 'File Transfer',
	'Content-Description' => 'attachment; filename="Отчет по работам.docx"',
	'Content-Type'        => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	'Content-Transfer-Encoding' => 'binary',
	'Cache-Control'       => 'must-revalidate, post-check=0, pre-chek=0',
	'Express'             => '0',
];
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word,'Word2007');
	ob_start();
	$objWriter->save("php://output");
	$file = ob_get_clean();
	return response()->make($file,200,$headers);
    }
}
