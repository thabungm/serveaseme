<?php
namespace App\Models;
use Kalnoy\Nestedset\Node as Node;
use Illuminate\Database\Eloquent\Model;
class Items  extends Node {
    protected $table = "category";
    protected $fillable = array('name', 'parent_id');

}
