<?php
/**
 * Created by PhpStorm.
 * User: yancey
 * Date: 2019/2/15
 * Time: 14:34
 */

namespace App\Http\Controllers\Collection;


use App\Exports\CollectionExport;
use App\Http\Controllers\Controller;
use App\Services\Collection\CollectionService;
use Maatwebsite\Excel\Facades\Excel;


class CollectionController extends Controller{

    public function index(){

        //todo 做外壳页面
        return view('index');
    }

    public function export(){

        $CollectionService = new CollectionService();
        //文件名
        $fileName = $CollectionService->getFileName();
        //导出
        return Excel::download(new CollectionExport, $fileName);
    }

}