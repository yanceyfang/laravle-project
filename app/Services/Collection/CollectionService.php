<?php
/**
 * Created by PhpStorm.
 * User: yancey
 * Date: 2019/2/15
 * Time: 14:46
 */
namespace App\Services\Collection;


use App\Models\BorrowerRepay;
use Vinkla\Hashids\Facades\Hashids;

class CollectionService{

    //导出数据组装
    public function export(){
//        $hash = Hashids::encode('222555000000000020180218');
//        var_dump($hash);die;
        $models = new BorrowerRepay();
        $data = $models->getCollection();
        $data = $this->collectionRetreatment($data);
        return $data;

    }

    //再处理数据
    public function collectionRetreatment($data){

        //再处理数据总集
        $retreatmentData = [];
        //遍历处理
        foreach ($data as $datum){
            $collectionItem = $this->dataAssembly($datum);
            array_push($retreatmentData,$collectionItem);
        }

        return $retreatmentData;
    }


    //数据组装
    private function dataAssembly($datum){
        //组装excel数据
        $collectionItem = [
            'lv'=>$this->getUserLV($datum->overdue_day),
            'period' => "第".$datum->period."期",
            'mobile' => $datum->mobile,
            'name' => $datum->full_name,
            'address' => $datum->address,

            'all_amt' => $this->shouldAlsoAmount($datum),
            'loan_time' => $datum->created_at,
            'quota' => $datum->quota/100,
            'repay_time' => date('Y-m-d',$datum->repay_time),
            'overdue_day' => $datum->overdue_day,
            'overdue_interest' => $datum->overdue_interest/100,
            'id_card'=>$datum->id_card."\t",
            'birth'=>$datum->birth,
            'sex'=>$datum->sex == 1? "男":"女",
            'nation'=>$datum->nation,
            'valid_begin'=>$datum->valid_begin,
            'valid_end'=>$datum->valid_end,
            'department'=>$datum->department,
            'education'=>$datum->education,
            'live_address'=>$datum->live_address,
            'detail_address'=>$datum->detail_address,
            'industry'=>$datum->industry,
            'work_nature'=>$datum->work_nature,
            'corporate_name'=>$datum->corporate_name,
            'income'=>$datum->income,
            'liabilities'=>$datum->liabilities,
            'contacts1_relation'=>$datum->contacts1_relation,
            'contacts1_fullname'=>$datum->contacts1_fullname,
            'contacts1_mobile'=>$datum->contacts1_mobile,
            'contacts2_relation'=>$datum->contacts2_relation,
            'contacts2_fullname'=>$datum->contacts2_fullname,
            'contacts2_mobile'=>$datum->contacts2_mobile,
          //  'juxinli' => $this->juxinliUrl($datum->uid),
        ];
        return $collectionItem;
    }

    //应还金额计算
    public function shouldAlsoAmount($data){
        //所有应还金额 本金+利息+服务费+罚息 /100 得出单位 元
        $all_amt = ($data->corpus
                + $data->interest
                + $data->pre_loan_service_fee
                + $data->after_loan_service_fee
                + $data->platform_service_fee
                + $data->overdue_interest)/100;

        return $all_amt;
    }

    //聚信立URL加密
    public function juxinliUrl($uid){
        $url      = config('juxinli.url');
        $validity = date("Ymd",time());
        $hash = Hashids::encode($uid."0000000000".$validity);
        return $url.$hash;
    }
    //用户逾期级别
    public function getUserLV($day){
        switch ($day){
            case $day<=10:return "S1";
            case $day>=11&&$day<=30:return "S2";
            case $day>=31&&$day<=60:return "M1";
            case $day>=61&&$day<=90:return "M2";
            case $day>=90:return "M3";
        }
    }

    //导出文件名
    public function getFileName(){
        //当前日期
        $nowTime = date('Y-m-d',time());
        $fileName = '催收数据导出'.$nowTime.'.xlsx';
        return $fileName;
    }

}