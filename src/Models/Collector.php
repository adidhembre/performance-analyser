<?php
namespace Aditya\PerformanceAnalyser\Models;

use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
    protected $table= 'analyser';

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
}