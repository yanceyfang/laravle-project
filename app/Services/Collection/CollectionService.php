<?php
/**
 * Created by PhpStorm.
 * User: yancey
 * Date: 2019/2/15
 * Time: 14:46
 */
namespace App\Services\Collection;


use App\Models\BorrowerRepay;

class CollectionService{

    //导出数据组装
    public function export(){

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
            'mobile' => $datum->mobile,
            'name' => $datum->full_name,
            'address' => $datum->address,
            'period' => $datum->period,
            'all_amt' => $this->shouldAlsoAmount($datum),
            'loan_time' => $datum->created_at,
            'quota' => $datum->quota/100,
            'repay_time' => date('Y-m-d',$datum->repay_time),
            'overdue_day' => $datum->overdue_day,
            'overdue_interest' => $datum->overdue_interest/100,
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

    //导出文件名
    public function getFileName(){
        //当前日期
        $nowTime = date('Y-m-d',time());
        $fileName = '催收数据导出'.$nowTime.'.xlsx';
        return $fileName;
    }

}