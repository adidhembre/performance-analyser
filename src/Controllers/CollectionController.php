<?php

namespace Aditya\PerformanceAnalyser\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Aditya\PerformanceAnalyser\Models\Collector;

class CollectionController extends Controller
{
    protected $id = null;
    protected $route = null;
    protected $sqlcalls = 0;
    protected $sqltime = 0;
    protected $starttime = null;
    protected $endtime = null;
    protected $request = null;
    protected $collectors = null;

    private static $static_collectors = [
        'user','route','method','params','referer','host','status'
    ];

    private static $listners = [
        'sql'=>['sqlcalls','sqltime'],
        'time'=>['starttime','endtime','time'],
        'response'=>['status']
    ];

    function __construct(Request $request){
        $this->request = $request;
        $this->route = \Route::current();
        $this->collectors = config('analyser.collectors');
        $data = [];
        foreach(self::$static_collectors as $collector){
            $data[$collector] = $this->solveCollector($collector);
        }
        $this->starttime = microtime(true);
        $data['starttime'] = $this->getStarttime();
        $this->createLog($data);
        $this->startSqlListners();
        $this->starttime = microtime(true);
    }

    private function startSqlListners(){
        \DB::listen(function($sql) {
            $this->sqlcalls ++;
            $this->sqltime += $sql->time;
        });
    }

    private function createLog($data){
        $c = Collector::create($data);
        $this->id = $c->id;
    }

    private function endLog($response){
        $this->endtime = microtime(true);
        $c = Collector::find('id',$c->id);
        $data = [];
        foreach(self::$listners as $listner => $collectors){
            foreach($collectors as $collector){
                if($listner == 'response'){
                    $data[$collector] = $this->solveCollector($collector,$response);
                }
                else{
                    $data[$collector] = $this->solveCollector($collector);
                }
            }
        }
        $c->update($data);
        $c->save();
    }

    private function getUser(){
        return Auth::user()->id;
    }

    private function getRoute(){
        return  $this->route->uri;
    }

    private function getMethod(){
        return  $this->request->getMethod();
    }

    private function getParams(){
        return  json_encode($this->route->parameters);
    }

    private function getReferer(){
        return  $this->request->headers->get('referer');
    }

    private function getHost(){
        return  $this->request->getHttpHost();
    }

    private function getSqlcalls(){
        return  $this->sqlcalls;
    }

    private function getSqltime(){
        return  $this->sqltime;
    }

    private function getStarttime(){
        return  Carbon::parse($this->starttime);
    }

    private function getEndtime(){
        return  Carbon::parse($this->endtime);
    }

    private function getTime(){
        return  $this->endtime - $this->starttime;
    }

    private function getStatus($response = null){
        if($response == null){
            return 0;
        }
        else if($response->status() == 200){
            return 1;
        }
        else{
            return -1;
        }
    }

    private function solveCollector($collector,$pass=null){
        if($this->validateConfig($collector)){
            try{
                if($pass==null){
                    return $this->{Str::camel('get_'.$collector)}();
                }
                else{
                    return $this->{Str::camel('get_'.$collector)}($pass);
                }
            }
            catch(Exception $e){
                return null;
            }
        }
    }

    private function validateConfig($collector){
        return isset($this->collectors[$collector]) && $this->collectors[$collector];
    }
}