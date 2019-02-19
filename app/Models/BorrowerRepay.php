<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class BorrowerRepay extends Model
{

    const BORROWER_REPAY_DATA_ALREADY = '还款计划数据已存在';

    protected $table = 'borrower_repay';


    public function getCollection(){


        $sql = "SELECT 
                a.uid , 
                c.mobile , 
                b.full_name , 
                d.address , 
                a.corpus , 
                a.interest , 
                a.pre_loan_service_fee , 
                a.after_loan_service_fee , 
                a.platform_service_fee , 
                a.period , 
                a.overdue_day , 
                a.overdue_interest , 
                a.repay_time , 
                e.created_at , 
                e.quota 
                FROM borrower_repay as a 
                JOIN fy_account as b on a.uid = b.uid 
                JOIN users as c on a.uid = c.id 
                JOIN user_locations as d on a.uid = d.uid
                JOIN loan_apply as e on a.lid = e.id
                WHERE a.`status` = 4 
                GROUP BY a.id";


        return DB::select($sql);
    }


}