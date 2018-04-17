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

      // dump($request);
        $job = $this->filters($request);
        $wordcollection = collect();
        foreach ($job['data'] as $ev) {
            $wordcollection->push(collect(['user' => $ev->users->name,
                'category' => $ev->event->categories->name,
                'event' => $ev->event->name,
                'count' => $ev->counts,
                'namecount' => $ev->event->nameCount,
                'date' => $ev->date,
                'time' => $ev->time,
                'comment' => $ev->comment,
                'room' => $ev->rooms->name]));
        }

        if ($request->input('weekly')) {
            $lastEvent='';
            $sum=0;
            $wordcollection = $wordcollection->sortBy('category')->groupBy('category');
           // dump($wordcollection);
            $final = [];
            foreach($wordcollection as $k =>$wc){
                foreach($wc->sortBy('event')->groupBy('event') as $key => $w){
                    foreach ($w as $e){
                        $sum += $e['count'];   
                    }   
                  $final[$k][$key]=['count'=>$sum.' '.$e['namecount']]; 
                  $sum=0;
                }
            }
            $word = $this->word($final,true);
        } else {
            $wordcollection = collect($wordcollection)->sortBy(function($event) {
                        return sprintf('%-12s%s', $event['date'], $event['event']);
                    })->groupBy('date');
            $final = collect();
            foreach ($wordcollection as $k => $wc) {
                $final->put($k, $wc->groupBy('user'));
            }
            $word = $this->word($final,false);
        }
        //dump($final);


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

    protected function word($events,$weekly) {

        $word = new \PhpOffice\PhpWord\PhpWord();
        $word->setDefaultFontName('Times New Roman');
        $word->setDefaultFontSize(14);
        $section = $word->addSection();
        
        if($weekly == true){
            $this->wordWeekly($section,$events);  
        } else
            $this->wordApart($section, $events);

        return $word;
    }

    protected function wordApart($section, $events) {
        $lastEvent = '';
        $fontStyle = array('bold' => true);
        $text = ['bold' => false];
        $listStyle = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED);


        $section->addText('ТЕХНИЧЕСКАЯ ДЕЯТЕЛЬНОСТЬ ЛИОТ');
        $section->addText('на период с ' . $events->keys()->first() . ' по ' . $events->keys()->last());

        foreach ($events as $date => $users) {
            $section->addText(htmlspecialchars('Дата ' . $date), $fontStyle);
            foreach ($users as $name => $ev) {
                $section->addText(htmlspecialchars($name), ['italic' => true, 'color' => '#17365d']);
                foreach ($ev as $e) {
                    if ($lastEvent != $e['event']) {
                        $section->addText(htmlspecialchars($e['event']), $fontStyle);
                    }
                    $section->addText(htmlspecialchars(' - затрачено времени '
                                    . $e['time'] . ' часа; сделано '
                                    . $e['count'] . ' ' . $e['namecount'] .
                                    '; комментарий: ' . $e['comment']), $text);
                }
                $section->addText("");
            }
        }
    }
    
    protected function wordWeekly($section,$categories){
        $i=0;
        $fontStyle = array('bold' => true);
        $text = ['bold' => false];
        $listStyle = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED);
        $section->addText('4. ТЕХНИЧЕСКАЯ ДЕЯТЕЛЬНОСТЬ', $fontStyle);
        foreach($categories as $kc => $c){
            $section->addText(htmlspecialchars('4.' . $i . ' ' . $kc . ':'), $fontStyle);
            foreach ($c as $ke => $d){
              $section->addListItem(htmlspecialchars($ke . ' - ' . $d['count']), 0, array(), $listStyle);
            }
            $i++;
        }
        
        return $section;
    }

    protected function filters($request) {
        $events = user_event::with('users', 'event.categories', 'rooms');
        // $nameDoc = "отчет ЛИОТ";
        //dump($request->input());
        if ($request->input('firstDate') !== NULL) {
            $fDate = $request->input('firstDate');
            $events->where('date', '>=', $fDate);
        }

        if ($request->input('secondDate') !== NULL) {
            $sDate = $request->input('secondDate');
            $events->where('date', '<=', $sDate);
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
            //dump($data);
            return $data;
        } else {
            $data['data'] = $events->join('event', 'users_event.event_id', '=', 'event.id')->orderBy('name')->get(['*', 'users_event.count as counts']);
            $data['filter'] = true;
            //dump($data);
            return $data;
        }
    }

}
