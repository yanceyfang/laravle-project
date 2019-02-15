<?php

namespace App\Exports;

use App\Models\BorrowerRepay;
use App\Services\Collection\CollectionService;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class CollectionExport implements FromArray, WithHeadings , ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array():array
    {
        $dataServices = new CollectionService();
        return $dataServices->export();
    }
    public function headings(): array
    {
        return [
            '手机号',
            '姓名',
            '地址',
            '期数',
            '应还所有金额',
            '借款申请时间',
            '借款金额',
            '应还时间',
            '逾期天数',
            '逾期罚息',
        ];
    }


}
