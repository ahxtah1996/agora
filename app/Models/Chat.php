<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Chat extends Model
{
    use SyncsWithFirebase;

	protected $table = "chats";
	protected $fillable = ['name', 'content', 'ip', 'type'];
}
