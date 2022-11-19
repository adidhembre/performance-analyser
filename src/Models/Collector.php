<?php
namespace Aditya\PerformanceAnalyser\Models;

use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
    protected $table= 'analyser';

    protected $connection = 'mysql';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user','route','method','params',
        'referer','host','sqlcalls',
        'sqltime','starttime','endtime',
        'status','time'
    ];

    protected $columns = [
        'user','route','method','params',
        'referer','host','sqlcalls',
        'sqltime','starttime','endtime',
        'status','time'
    ];

    function __construct()
    {
        if(config('analyser.connection') != null){
            $this->connection = config('analyser.connection');
        }
    }
}