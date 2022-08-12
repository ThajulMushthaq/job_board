<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class CandidatesModel extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    public function save_data($data = array())
    {
        try {
            $id = DB::table($this->table)->insertGetId($data);
            return $id;
        } catch (Exception $e) {
        }
    }

    
    function get_applied_candidates($job_id = 0)
    {
        try {
            if (@$job_id > 0) {
                $query = DB::table($this->table)
                    ->select('name', 'email', 'phone', 'resume', 'created_at')
                    ->where('job', $job_id)
                    ->get();
                return $query;
            }
        } catch (Exception $e) {
        }
    }
}
