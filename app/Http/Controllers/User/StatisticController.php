<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\UserStatisticRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    private $userStatisticRepository;

    public function __construct(UserStatisticRepositoryInterface $userStatisticRepository)
    {
        $this->userStatisticRepository = $userStatisticRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $statisticByProduct = $this->userStatisticRepository->getStatisticByProduct('product', $userId);
        $statisticByBrand = $this->userStatisticRepository->getStatisticByProduct('brand', $userId);
        $statisticByCategory = $this->userStatisticRepository->getStatisticByProduct('category', $userId);
        $statisticOfTotalIncomeByMonth = $this->userStatisticRepository->getStatisticOfTotalIncomeByMonth($userId);
        $dataDonutChart = [];
        $labelDonutChart = [];
        $totalIncome = 0;
        $dataBarChart = array_fill(0, 12, 0);
        foreach ($statisticOfTotalIncomeByMonth as $item) {
            $dataBarChart[$item->month - 1] = $item->total_income;
        }
        foreach ($statisticByProduct as $item) {
            $totalIncome += $item->total_money;
            $dataDonutChart[] = $item->total_money;
            $labelDonutChart[] = $item->name;
        }

        return view(
            'user.statistic.index',
            [
                'statisticByProduct' => $statisticByProduct,
                'statisticByBrand' => $statisticByBrand,
                'statisticByCategory' => $statisticByCategory,
                'dataBarChart' => json_encode($dataBarChart),
                'totalIncome' => number_format($totalIncome, 3),
                'dataDonutChart' => json_encode($dataDonutChart),
                'labelDonutChart' => json_encode($labelDonutChart)
            ]
        );
    }
}
