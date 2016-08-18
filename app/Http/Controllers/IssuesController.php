<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use App\Issue;
use App\DomainStatus;
use App\Note;
//use Illuminate\Http\Request;
use Request;
use App\Http\Requests;
use App\Http\Requests\CreateIssueRequest;
use App\Http\Requests\EditIssueRequest;
use App\Http\Controllers\Controller;
use App\Response;
use Auth;


class IssuesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $issues = Issue::all();
        //return $issues;
        return view('pages.issues.index', compact('issues'));
    }

    public function show($id)
    {
        $issue = Issue::find($id);

        $domainStatus = $issue->domainStatus()->groupBy('domain_id')->get();
    
        $notes = $issue->notes()->orderBy('created_date', 'DESC')->with('user')->get();


        foreach($domainStatus as $ds)
        {
            // run through and make an array
            $domain[] = array('name'        => $ds['domain'],
                              'farm'        => $ds['farm'],
                              'end_time'    => $ds['end_time'],
                              'id'          => $ds['id'],
                              'domain_id'   => $ds['domain_id']

                );

            //$domain[$ds['domain']]['end_time'] = $ds['end_time'];
            //$domain[$ds['domain']]['id'] = $ds['domain_id'];
        }

        //$domainStatus = DB::table('domain_status')->where('issue_id','=',$id)->groupBy('domain')->get();

        

        $domain_hosts = DB::table('issues_domainhosts')->where('issue_id', '=', $issue['id'])->get();

        //return $domain_hosts;

        $services = explode(",", $issue['services']);
        foreach($services as $s)
        {
            $services[$s] = true;
        }

        foreach($domain_hosts as $dh)
        {
            // cycle through and make an array of used domain host ids
            $usedDomainHostIds[] = $dh->domain_host_id;
        }

        //return $usedDomainHostIds;

        $domainHostsTable = DB::table('DomainDomainHostId')->select(['DomainHostID','DomainHost'])->whereNotNull('DomainHost')->orderby('DomainHost','asc')->groupby('DomainHost')->get();


        // pull all the domain hosts from the table that are not part of this issue
        $availableDomainHosts = array();
        foreach($domainHostsTable as $dh)
        {

            if(!in_array($dh->DomainHostID, $usedDomainHostIds))
                $availableDomainHosts[$dh->DomainHostID] = $dh->DomainHost;
                // not found in the array so add to our available domain hosts table
        }

        $cannedResponses = Response::all();

        return view('pages.issues.edit')->with([
                'issue'                 => $issue,
                'domainHosts'           => $domain_hosts,
                'services'              => $services,
                'domainStatus'          => $domain,
                'notes'                 => $notes,
                'availableDomainHosts'  => $availableDomainHosts,
                'cannedResponses'       => $cannedResponses
            ]);


    }

    /**
     *  @param CreateArticleRequest $request
     *  @return Resposne
     *
     */
    public function store(CreateIssueRequest $request) 
    //public function store()
    {
        //returns the information given on the form
        $input = $request->all();

        $input['user_id'] = Auth::id();
        $input['open_date'] .= " ".$input['open_time'];
        $input['close_date'] .= " ".$input['close_time'];

       // $hosts = ;
        $services = $input['services'];

        $input['services'] = implode(',', $input['services']);
    

        if(!strlen(trim($input['close_date'])))
            unset($input['close_date']);
        $issue = Issue::create($input);

        $note = [
            "note"          => $input['details'], 
            "created_date"  => $input['open_date'],
            "user_id"       => Auth::id()
        ];

        $issue->notes()->create($note); // add the first note as the details
        //return $issue->id;

        if(empty($input['domain_hosts']))
        {
            // no domain hosts found so were rocking the domains individually
            $domains = DB::table('DomainDomainHostId')->whereIn('DomainId', $input['domains'])->get();
            $domainHostsArr = DB::table("DomainDomainHostId")->select('DomainHostID')->whereIn('DomainId', $input['domains'])->groupBy('DomainHostID')->get();
            foreach($domainHostsArr as $d)
            {
                $domainHosts[] = $d->DomainHostID;
            }
        } else
        {
            $domains = DB::table('DomainDomainHostId')->whereIn('DomainHostID', $input['domain_hosts'])->get();
            $domainHosts = $input['domain_hosts'];
        }


        $status = new DomainStatus;
        foreach($domains as $d)
        {
            //foreach($input['services'] as $service)
            foreach($services as $service)
            {
                $newstatus = array('issue_id'=>$issue->id,'domain'=>$d->DomainName,'domain_id'=>$d->DomainId, 'farm'=>$d->farmName, 'start_time'=>$input['open_date'], 'service' => $service);
            
                $status->create($newstatus);
            }

            $domainHost[$d->DomainHostID] = $d->DomainHost; 
            
        }



        foreach($domainHosts as $dh)
        {
            $issues_dhs[] = array('issue_id' => $issue->id, 'domain_host_id' => $dh, 'domain_host' => $domainHost[$dh]);
        }
        DB::table('issues_domainhosts')->insert($issues_dhs);


        flash()->success('Record Saved!');
        return redirect('admin/issues');
    }





    public function add()
    {
        //$domainHosts = DB::table('DomainDH')->groupBy('DH')->get();
        //$domainHostsTable = DB::table('DomainDH')->orderby('DH','asc')->orderby('domain','asc')->get();

        $domainHostsTable = DB::table('DomainDomainHostId')->select(['DomainHostID','DomainHost','farmID', 'farmName'])->whereNotNull('DomainHost')->orderby('DomainHost','asc')->groupby('DomainHost')->get();
       
     
        //return $domainHostsTable;
        $domainHostsOnly = array();
        foreach($domainHostsTable as $dh)
        {
            //if(!in_array($domainHosts, $dh['DH']))
            //$domainHosts[$dh->domainHost][] = $dh->domain;
            //$domainHosts[$dh->DH][] = $dh->domain;

            //if(!in_array($dh->DH, $domainHostsOnly))
                //$domainHostsOnly[$dh->DH] = $dh->DH;

            $domainHostsOnly[$dh->DomainHostID] = $dh->DomainHost;
        }

        $dhJson = json_encode($domainHostsOnly);

        $domainFarmsOnly = array();
        foreach ($domainHostsTable as $dhf)
        {
            $domainFarmsOnly[$dhf->farmID] = $dhf->farmName;
        }
        $dhfJson = json_encode($domainFarmsOnly);
        var_dump($domainFarmsOnly);

        // get all domains
        $allDomains = DB::table('DomainDomainHostId')->select(['DomainName','DomainId'])->whereNotNull('DomainHost')->orderby('DomainName','asc')->groupby('DomainId')->get();
        foreach($allDomains as $d)
        {
            // create an array for the drop down picker
            $allDomainsOnly[$d->DomainId] = $d->DomainName;
        }

        $cannedResponses = Response::all();
        

        return view('pages.issues.add')->with([
                'domainHosts'       => $domainHostsOnly,
                'domainFarms'       => $domainFarmsOnly,
                'dhJson'            => $dhJson,
                'dhfJson'           => $dhfJson,
                'domainHostsTable'  => $domainHostsOnly,
                'cannedResponses'   => $cannedResponses,
                'allDomains'        => $allDomainsOnly,
                'allDomainsJson'    => json_encode($allDomains),
            ]);
    }

    public function gr(Request $input)
    {
        $input = Request::all();


        if(strlen($input['domainName']) && strlen($input['issueId']))
        {
            // we have a GR closure
            $input['close_date'] .= " ".$input['close_time'];
            DB::table("domain_status")->where('issue_id',$input['issueId'])->where('domain', $input['domainName'])->update(['end_time' => Carbon::createFromFormat('m/d/Y H:i A',$input['close_date']) ]);

            //$domainName = DB::table('domain_status')->where('id',$input['domainIssueId'])->value('domain');
            flash()->success('Issue closed for domain: '.$input['domainName']);
            
        }
        return redirect()->back();
    }

    public function edit($id, EditIssueRequest $request)
    {

        $issue = Issue::find($id);


        $input = $request->all();


        //return $input;

        // check if this is closed 
        if(strlen($input['close_date']))
        {
            $input['close_date'] .= " ".$input['close_time'];
            DB::table('domain_status')->where('issue_id', $id)->whereNull('end_time')->update(['end_time'=> Carbon::createFromFormat('m/d/Y H:i A',$input['close_date']) ]);
        }
        else 
        {
            unset($input['close_date']);
        }

        $issue->update($input);



        

        flash()->success('Record Saved!');

        // Session::flash('message', 'Record Saved!');
        // Session::flash('alert-class', 'alert-success');
        return redirect()->back();
        
    }

    public function addDomainHost(Request $request)
    {
        $input = $request::all();

        $issue = Issue::find($input['issue_id']);


        $domains = DB::table('DomainDomainHostId')->whereIn('DomainHostID', $input['new_domain_hosts'])->get();

        $services = explode(",",$issue->services);
        $status = new DomainStatus;
        foreach($domains as $d)
        {
            //foreach($input['services'] as $service)
            foreach($services as $service)
            {
                $newstatus = array('issue_id'=>$issue->id,'domain'=>$d->DomainName,'domain_id'=>$d->DomainId, 'start_time'=>Carbon::parse($issue->open_date)->format('m/d/Y h:i:s A'), 'service' => $service);
            
                $status->create($newstatus);
            }

            $domainHost[$d->DomainHostID] = $d->DomainHost; 
            
        }


        foreach($input['new_domain_hosts'] as $dh)
        {
            $issues_dhs[] = array('issue_id' => $issue->id, 'domain_host_id' => $dh, 'domain_host' => $domainHost[$dh]);
        }
        DB::table('issues_domainhosts')->insert($issues_dhs);

        flash()->success('Domain Hosts added to this issue successfully');
        return redirect()->back();
    }

    public function delDomainHost(Request $request)
    {
        // dropping domain host and all associated domains from issue
        $input = $request::all();

        $issue = Issue::find($input['issue_id']);


        // check if this is the last domain host
        $domainHostsLeft = DB::table('issues_domainhosts')->where('issue_id','=', $issue->id)->where('domain_host_id','!=',$input['host_id'])->count();
        if($domainHostsLeft == 0)
        {
            //last domain host so fail to delete
            flash()->error("Cannot remove the last domain host");
            return redirect()->back();
        }

        $domains = DB::table('DomainDomainHostId')->where('DomainHostID', '=', $input['host_id'])->get();

        

        foreach($domains as $d)
        {
            $domain_ids[] = $d->DomainId;
        }

        
        // drop all the records where issue_id and domain_id match in that array
        DB::table('domain_status')->where('issue_id','=',$issue->id)->whereIn('domain_id', $domain_ids)->delete();

        DB::table('issues_domainhosts')->where('issue_id','=', $issue->id)->where('domain_host_id','=',$input['host_id'])->delete();

        flash()->success('Domain Host removed from issue');
        return redirect()->back();
    }

    public function addDomain(Request $request)
    {
        $input = $request::all();

        $issue = Issue::find($input['issue_id']);

        $domains = $input['newDomains'];


        //$domains = DB::table('DomainDomainHostId')->whereIn('DomainHostID', $input['new_domain_hosts'])->get();

        $services = explode(",",$issue->services);
        $status = new DomainStatus;
        foreach($domains as $d)
        {
            // check to see if this domain is already on the issue
            $check = DomainStatus::where('issue_id','=',$issue->id)->where('domain_id','=',$d)->first();
            if(!empty($check))
            {
                // we found a match so this domain is already on the issue, continue to the next domain
                continue;
            } else
            {
                // we didn't find the domain so let's grab the domain host 
                $dHost = DB::table('DomainDomainHostId')->where('DomainId', '=', $d)->first();
            }


            //foreach($input['services'] as $service)
            foreach($services as $service)
            {
                $newstatus = array('issue_id'=>$issue->id,'domain'=>$dHost->DomainName,'domain_id'=>$d, 'start_time'=>Carbon::parse($issue->open_date)->format('m/d/Y h:i:s A'), 'service' => $service);
            
                $status->create($newstatus);
            }

            $domainHost[$dHost->DomainHostID] = $dHost->DomainHost; 
            
        }


        foreach($domainHost as $dhId => $dh)
        {
            // check to see if this domain host is already on the issue
            $check = DB::table('issues_domainhosts')->where('issue_id','=',$issue->id)->where('domain_host_id','=',$dhId)->first();
            if(empty($check))
            {
                // no entry found so insert
                $issues_dhs[] = array('issue_id' => $issue->id, 'domain_host_id' => $dhId, 'domain_host' => $dh);    
            }
            
        }
        if(!empty($issues_dhs))
        {
            DB::table('issues_domainhosts')->insert($issues_dhs);
        }

        flash()->success('Domains added to this issue successfully');
        return redirect()->back();
    }

    public function delDomain(Request $request)
    {
        
        // dropping domain host and all associated domains from issue
        $input = $request::all();

        $issue = Issue::find($input['issue_id']);

        $domain = DB::table('DomainDomainHostId')->where('DomainId', '=', $input['domain_id'])->first();

        // check if this is the last domain
        $domainsLeft = DB::table('domain_status')->where('issue_id','=',$issue->id)->where('domain_id','!=',$input['domain_id'])->count();
        if($domainsLeft == 0)
        {
            //last domain host so fail to delete
            flash()->error("Cannot remove the last domain");
            return redirect()->back();
        }

        
        // drop all the records where issue_id and domain_id match in that array
        DB::table('domain_status')->where('issue_id','=',$issue->id)->where('domain_id', $input['domain_id'])->delete();

        // check if there are any domains left from this host on the issue
        $domainsOnHost = DB::table('DomainDomainHostId')->select('DomainId')->where('DomainHostID',$domain->DomainHostID)->get();
        foreach($domainsOnHost as $dH)
        {
            $hostDomains[] = $dH->DomainId;
        }
        $domainsOnIssueAndHost = DB::table("domain_status")->where('issue_id','=',$issue->id)->whereIn('domain_id', $hostDomains)->count();

        if($domainsOnIssueAndHost == 0)
        {
            // no domains from this host left on the issue so drop it
            DB::table('issues_domainhosts')->where('issue_id','=', $issue->id)->where('domain_host_id','=',$domain->DomainHostID)->delete();
        }

        

        flash()->success('Domain removed from issue');
        return redirect()->back();
    }


    public function closeDomain(Request $request)
    {
        $input = $request::all();

        $issue = Issue::find($input['issue_id']);

        //return $issue;
        //return $issue->id;

        // check if were using the domain or domain host
        if(!empty($input['domainHostId']))
        {
            // we are pulling a domain host so let's collect all the domains
            $domains = DB::table('DomainDomainHostId')
                            ->join('domain_status', function($join) use($issue) {

                                $join->on('DomainDomainHostId.DomainId', '=', 'domain_status.domain_id')
                                     ->where('domain_status.issue_id', '=', $issue->id)
                                     ->whereNull('domain_status.end_time');
                                 })
                            ->where('DomainDomainHostId.DomainHostID',$input['domainHostId'])
                            ->get(['domain_status.id','domain_status.domain_id','domain_status.domain']);

            //return $domains;

                            
        } else 
        {
            $domains = DB::table('domain_status')
                            ->where('issue_id', '=', $issue->id)
                            ->where('domain_id', '=', $input['domainId'])
                            ->get(['domain_status.id','domain_status.domain_id','domain_status.domain']);

        }

        

        // let's create a note for each domain
   
        $close_date = $input['close_date'] ." ".$input['close_time'];
        $note = [
            "note"          => $input['note'], 
            "created_date"  => Carbon::createFromFormat('m/d/Y H:i A',$close_date),
            "user_id"       => Auth::id(),
            "issue_id"      => null // we keep this null so it doesn't get included on regular issue display, since it only applies to this domain
        ];

        foreach($domains as $d) 
        {
            // drop the note in
            $note_id = DB::table('notes')->insertGetId($note);

            // drop the relationship in
            $rel = [
                "domain_id"         => $d->domain_id,
                "issue_id"          => $issue->id,
                "note_id"           => $note_id,
                "domain_status_id"  => $d->id
            ];

            DB::table('notes_domains')->insert($rel);

            // now close the domain status
            DB::table('domain_status')
                ->where('issue_id', $issue->id)
                ->where('id', $d->id)
                ->whereNull('end_time')
                ->update(['end_time'=> Carbon::createFromFormat('m/d/Y H:i A',$close_date) ]);
        }

        flash()->success('Issue closed for selected domains');
        return redirect()->back();
    }
}
