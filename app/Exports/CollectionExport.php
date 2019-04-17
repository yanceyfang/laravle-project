<?php

namespace App\Exports;

use App\Models\BorrowerRepay;
use App\Services\Collection\CollectionService;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
class CollectionExport implements FromArray, WithHeadings , ShouldAutoSize , WithColumnFormatting
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
            '逾期级别',
            '期数',
            '手机号',
            '姓名',
            '身份证地址',

            '应还所有金额',
            '借款申请时间',
            '借款金额',
            '应还时间',
            '逾期天数',
            '逾期罚息',
            '身份证号',
            '出生日期',
            '性别',
            '民族',
            '身份证签发日期',
            '身份证失效日期',
            '身份证签发机关',
            '学历',
            '居住地址',
            '详细地址',
            '单位所属行业',
            '工作性质',
            '公司名称',
            '收入情况',
            '负债情况',
            '联系人1关系',
            '联系人1姓名',
            '联系人1手机号',
            '联系人2关系',
            '联系人2姓名',
            '联系人2手机号',
        //    '聚立信链接',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'L' => NumberFormat::FORMAT_TEXT,

        ];
    }


}
