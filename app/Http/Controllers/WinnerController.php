<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prize;
use App\Winner;
use App\Respondent;

class WinnerController extends Controller
{
    public function index()
    {
        $respondent = request()->session()->get('respondent');
        $respondent = Respondent::where('id', $respondent['id'])->first();
        $has_prize = Winner::where('respondent_id', $respondent['id'])->exists();
        $prizes = Prize::where('qty', '>', 0)->count();

        return view('free-gift.index', compact('has_prize', 'prizes'));
    }

    public function drawPrize()
    {
        $all_prizes = Prize::get();
        $prizes = Prize::where('qty', '>', 0)->get();
        $total_prizes_qty = Prize::sum('qty');
        $lucky_number = floor(rand(1, ($total_prizes_qty > 360) ? 360 : $total_prizes_qty));
        $include_range = [];
        $exclude_range = [];

        for ($i = 0; $i < count($all_prizes); $i++) {
            $prize = $all_prizes[$i];

            if ($prize['qty'] <= 0) {
                switch ($prize['id']) {
                    case 1: // Pen
                        array_push($exclude_range, range(1, 90));
                        break;
                    case 2: // Notebook
                        array_push($exclude_range, range(181, 270));
                        break;
                    case 3: // Mug
                        array_push($exclude_range, range(271, 360));
                        break;
                    case 4: // Bag
                        array_push($exclude_range, range(91, 180));
                        break;
                    default:
                        break;
                }
            }

            if ($prize['qty'] > 0) {
                switch ($prize['id']) {
                    case 1: // Pen
                        array_push($include_range, range(1, 90));
                        break;
                    case 2: // Notebook
                        array_push($include_range, range(181, 270));
                        break;
                    case 3: // Mug
                        array_push($include_range, range(271, 360));
                        break;
                    case 4: // Bag
                        array_push($include_range, range(91, 180));
                        break;
                    default:
                        break;
                }
            }
        }

        if (count($include_range) > 0) {
            $include_range = array_merge(...$include_range);
            sort($include_range);
        } else {
            return response()->json(['success' => false, 'message' => 'Prizes have run out already']);
        }

        if (count($exclude_range) > 0) {
            $exclude_range = array_merge(...$exclude_range);
            sort($exclude_range);
        }

        do {
            $lucky_number = floor(rand(1, ($total_prizes_qty > 360) ? 360 : max($include_range)));
        } while (in_array($lucky_number, $exclude_range));

        // return [$lucky_number, $include_range, 'Include Range' => [min($include_range), max($include_range)], 'Exclude Range' => [min($exclude_range), max($exclude_range)]];

        $prize_result = [];
        for ($i = 0; $i < count($prizes); $i++) {
            $prize = $prizes[$i];

            switch ($prize['id']) {
                case 1: // Pen
                    $min_range = 1;
                    $max_range = 90;
                    break;
                case 2: // Notebook
                    $min_range = 181;
                    $max_range = 270;
                    break;
                case 3: // Mug
                    $min_range = 271;
                    $max_range = 360;
                    break;
                case 4: // Bag
                    $min_range = 91;
                    $max_range = 180;
                    break;
                default:
                    $min_range = 1;
                    $max_range = $total_prizes_qty;
                    break;
            }

            array_push($prize_result, [
                'prize_id' => $prize['id'],
                'prize_name' => $prize['name'],
                'range' => [
                    'min' => $min_range,
                    'max' => $max_range
                ]
            ]);
        }

        $prize = array_filter($prize_result, function($prize) use ($lucky_number) {
            return ($lucky_number >= $prize['range']['min'] && $lucky_number <= $prize['range']['max']);
        });
        $prize = array_merge($prize);

        $respondent = request()->session()->get('respondent');
        Winner::create([
            'respondent_id' => $respondent['id'],
            'prize_id' => $prize[0]['prize_id']
        ]);
        Prize::where('id', $prize[0]['prize_id'])->decrement('qty');

        return response()->json(['success' => true, 'luckyNumber' => $lucky_number, 'prize' => $prize]);
    }

    public function thankYou()
    {
        return view('free-gift.thankyou');
    }

    public function clearSurveySession()
    {
        request()->session()->forget(['respondent', 'answers']);

        return view('home');
    }
}
