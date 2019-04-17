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
                d.id_card , 
                d.birth , 
                d.sex , 
                d.nation , 
                d.valid_begin , 
                d.valid_end , 
                d.department , 
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
                e.quota , 
                f.education , 
                f.live_address , 
                f.detail_address , 
                f.industry , 
                f.work_nature , 
                f.corporate_name , 
                f.income , 
                f.liabilities , 
                f.contacts1_relation , 
                f.contacts1_fullname , 
                f.contacts1_mobile , 
                f.contacts2_relation , 
                f.contacts2_fullname , 
                f.contacts2_mobile 
                FROM borrower_repay as a 
                LEFT JOIN fy_account as b on a.uid = b.uid 
                LEFT JOIN users as c on a.uid = c.id 
                LEFT JOIN authentic as d on a.uid = d.uid 
                LEFT JOIN loan_apply as e on a.lid = e.id
                LEFT JOIN borrower as f on a.uid = f.uid
                WHERE a.`status` = 4 
                GROUP BY a.id";


        return DB::select($sql);
    }


}