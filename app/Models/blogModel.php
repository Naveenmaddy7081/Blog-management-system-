<?php
namespace App\Models;
use CodeIgniter\Model;

class blogModel extends Model{
    protected $table = "blogs";
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','title','content'];
    protected $useTimestamps = true;


   
}


?>
