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
                $section->addText('4.'.$i.' '.$e->categories->name.':', $fontStyle);
                $i++;
            }
            $section->addListItem($e->name.'-'.$e->count,0,array(),$listStyle);  
            $lastID = $e->category_id;
        }
        
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="first.docx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
        $objWriter->save("php://output");
        
        return back();
    }
}
