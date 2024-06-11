<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmLogin extends Model
{
    use HasFactory;

    protected $table = 'admlogin';

    protected $fillable = ['email', 'senha'];
}