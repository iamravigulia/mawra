<?php
namespace Edgewizz\Mawra\Models;

use Illuminate\Database\Eloquent\Model;

class MawraQues extends Model{
    public function answers(){
        return $this->hasMany('Edgewizz\Mawra\Models\MawraAns', 'question_id');
    }
    protected $table = 'fmt_mawra_ques';
}