<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AdminStatisticRepositoryInterface;

class StatisticController extends Controller
{
    private $adminStatisticRepository;

    public function __construct(AdminStatisticRepositoryInterface $adminStatisticRepository)
    {
        $this->adminStatisticRepository = $adminStatisticRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statisticByBrands = $this->adminStatisticRepository->statisticByOption('brands');
        $statisticByCategories = $this->adminStatisticRepository->statisticByOption('categories');
        $statisticByTotalOrder = $this->parseToJson($this->adminStatisticRepository->statisticByOrder('total'));
        $statisticByCancelOrder = $this->parseToJson($this->adminStatisticRepository->statisticByOrder('cancel'));
        $statisticByToTalIncome = $this->parseToJson($this->adminStatisticRepository->statisticByProduct('income'));
        $statisticByProducts = $this->adminStatisticRepository->statisticByProduct('amount');
        
        return view(
            'admin.statistic.index',
            compact('statisticByBrands', 'statisticByCategories', 'statisticByTotalOrder', 'statisticByCancelOrder', 'statisticByToTalIncome', 'statisticByProducts')
        );
    }

    /**
     * get products that are sold in large to small quantities
     */
    public function parseToJson($data)
    {
        $array = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($data as $item) {
            $array[$item->month - 1] = $item->total;
        }
        
        return json_encode($array, JSON_NUMERIC_CHECK);
    }
}
