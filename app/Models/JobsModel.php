<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class JobsModel extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    public function get_data()
    {
        try {
            $query = DB::table($this->table)
                ->select('id', 'company', 'phone', 'email', 'location', 'job_title', 'job_type', 'job_description')
                ->get();
            return $query;
        } catch (Exception $e) {
            // dd($e);
        }
    }


    public function save_data($data = array())
    {
        try {
            $id = DB::table($this->table)->insertGetId($data);
            return $id;
        } catch (Exception $e) {
        }
    }


    function get_row($id = 0)
    {
        try {
            if (@$id > 0) {
                $row = DB::table($this->table)
                    ->select('company', 'email', 'phone', 'location', 'job_title', 'job_type', 'job_description', 'created_at')
                    ->where('id', $id)
                    ->first();
                return $row;
            }
        } catch (Exception $e) {
        }
    }
}
