<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JournalEvent as event;
use App\JournalUser_Event as user_event;
use App\JournalCategory as category;
use App\Http\Controllers\JournalHomeController as data;

class JournalExportController extends Controller {

    public function show() {
        return view('journalWord', ['categories' => data::getCategories(),
            'events' => data::getEvents(),
            'users' => data::getUsers(),
            'rooms' => data::getRooms()]);
    }

    public function export(request $request) {
        
        $events = $this->filters($request);
       // dump($events);

        $word = $this->word($events);
        
        $headers = [
            'Content-Description' => 'File Transfer',
            'Content-Description' => 'attachment; filename="Отчет по работам.docx"',
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Transfer-Encoding' => 'binary',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-chek=0',
            'Express' => '0',
        ];
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
        ob_start();
        $objWriter->save("php://output");
        $file = ob_get_clean();
        return response()->make($file, 200, $headers);
    }

    protected function word($events) {
        $i = 1;
        $word = new \PhpOffice\PhpWord\PhpWord();
        $word->setDefaultFontName('Times New Roman');
        $word->setDefaultFontSize(14);

        $fontStyle = array('bold' => true);
        $listStyle = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED);

        $section = $word->addSection();

        $lastID = -1;
        $section->addText('4. ТЕХНИЧЕСКАЯ ДЕЯТЕЛЬНОСТЬ', $fontStyle);
        if ($events['filter']==true) {
            foreach ($events['data'] as $e) {
                $id = $e->event->category_id;
                if ($lastID != $id) {
                    $section->addText(htmlspecialchars('4.' . $i . ' ' . $e->event->categories->name . ':'), $fontStyle);
                    $i++;
                }
                if ($e->event->count > 0)
                    $section->addListItem(htmlspecialchars($e->event->name . '-' . $e->counts . ' (' . $e->users->name . ' ' . $e->date . ')'), 0, array(), $listStyle);
                $lastID = $e->event->category_id;
            }
        } else{
            foreach ($events['data'] as $e) {
                $id = $e->category_id;
                if ($lastID != $id) {
                    $section->addText(htmlspecialchars('4.' . $i . ' ' . $e->categories->name . ':'), $fontStyle);
                    $i++;
                }
                if ($e->count > 0)
                    $section->addListItem(htmlspecialchars($e->name . '-' . $e->count), 0, array(), $listStyle);
                $lastID = $e->category_id;
            }
        }

        return $word;
    }

    protected function filters($request) {
        $events = user_event::with('users', 'event.categories', 'rooms');
        // $nameDoc = "отчет ЛИОТ";
        
        if($request->input('firstDate')){
            $fDate = $request->input('firstDate');
            $events->where('date','>=',$fDate);
        }
        
        if($request->input('secondDate')){
            $sDate = $request->input('secondDate');
            $events->where('date','<=',$sDate);
        }
        
        
        if ($request->input("idRoom")) {
            $room = $request->input("idRoom");
            $events->where(function($q) use($room) {
                foreach ($room as $k => $v) {
                    $q->orWhere('room_id', '=', $v);
                }
            });
        } if ($request->input("idEvent")) {
            $event = $request->input("idEvent");
            $events->where(function($q) use($event) {
                foreach ($event as $k => $v) {
                    $q->orWhere('event_id', '=', $v);
                }
            });
        } if ($request->input('idCategory')) {
            $category = $request->input('idCategory');
            $events->WhereHas('event', function ($q) use($category) {
                $q->Where(function($q)use($category) {
                    foreach ($category as $k => $v) {
                        $q->orWhere('category_id', $v);
                    }
                });
            });
        } if ($request->input('idUser')) {
            $user = $request->input('idUser');
            $events->where(function($q) use($user) {
                foreach ($user as $k => $v) {
                    $q->orWhere('user_id', '=', $v);
                }
            });
        }
       
        if (count($request->input()) == 1) {
            $data['data'] = event::orderBy('category_id')->get();
            $data['filter'] = false;
            return $data;
        } else{
            $data['data']=$events->join('event', 'users_event.event_id', '=', 'event.id')->orderBy('category_id')->get(['*', 'users_event.count as counts']);
            $data['filter'] = true;
            return $data;
        }

        
    }

}
