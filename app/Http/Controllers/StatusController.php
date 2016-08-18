<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use App\DomainStatus;
//use App\Issue;
//use App\Note;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // check for session variable, if not send to login
        if(Session::has('domainName'))
        {
            $data['domain'] = Session::get('domainName');
        } else
        {
            return redirect('login')->withError('message', 'Please login');
        }

        // lets grab domain details
        $data['domain_details'] = DB::table('DomainDomainHostId')->where('domainName', '=', $data['domain'])->first();

    
        $data['social'] = ($data['domain_details']->SOCOCARE_CHAT_ENABLED || $data['domain_details']->SOCOCARE_EMAIL_ENABLED || $data['domain_details']->SOCOCARE_SOCIAL_ENABLED) ? true: false;
        $data['plusDesktop'] = ($data['domain_details']->FREEDOM_ENABLED) ? true: false;
   
        
        $status = array();

        //$incidents->

        $stats = DomainStatus::where('domain', '=', $data['domain'])
            ->where(function ($query) {
                $query->where('start_time', '>=', Carbon::now()->subDays(1)->toDateTimeSTring()) // only get things that started in the last day
                ->orWhere('end_time', '>=', Carbon::now()->subDays(1)->toDateTimeSTring()) // have an end time within the last day
                ->orWhereNull('end_time'); // or do not have an end time
            })->with(['issue.notes' => function ($query) { $query->orderBy('created_date','DESC'); }])->orderBy('start_time', 'DESC')->get();
        //return $stats;

        //return $stats;
        $now = Carbon::now();

        $currentIssue = array();

        foreach($stats as $key => $s)
        {
            $created = new Carbon($s['start_time']);
            $s['width'] = floor(($created->diffInMinutes() / 1440 ) * 100);
            $s['left'] = 0;

    

            if(strlen($s['end_time']))
            {
                $end = new Carbon($s['end_time']);
                $s['width'] = floor(($created->diffInMinutes($end) / 1440 ) * 100);
                $s['left'] = floor(($end->diffInMinutes() / 1440 ) * 100);

                

                foreach($s['issue']['notes'] as $note_id => $note)
                {
                    //return $note;
                    // drop all the notes that are too new
                    //if(!is_array($note)) {continue;}
                    $note_date = new Carbon($note['created_date']);

                    if($note_date->gt($end))
                    {
                        // drop this note
                        unset($stats[$key]['issue']['notes'][$note_id]);
                    }
                }
                

                $finalNote = DB::table('notes_domains')
                                    ->join('notes', 'notes_domains.note_id', '=', 'notes.id')
                                    ->where('notes_domains.domain_status_id', '=', $s->id)->select('notes.*')->first();

                                    
                                    
                if(!empty($finalNote))
                {
                    // attach final note if it exists
                    $stats[$key]['issue']['finalNote'] = $finalNote;
                    //array_unshift($stats[$key]['issue']['notes'], $finalNote);
                    //return $finalNote[0]['id'];
                    //unset($finalNote);
                }
                
            } 

           // return $stats;
            
           
            $s['class'] = $s['issue']['type'] == 'Service Down' ? 'down' : null;

            if(!isset($currentIssue[$s['service']]) && $s['left'] == 0)
            {
                // if we have a current issue meaning left is 0 because it's still happening we need to trigger the color on the main part
                $currentIssue[$s['service']] = array('issue_id' => $s['id'],
                                      'class' => $s['class']
                                );
            }
            
            $status[$s['service']][] = $s;


        }

        //return $status;

        
        return view('pages.status')->with([
                'data' => $data,
                'status' => $status,
                'currentIssue' => $currentIssue
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
