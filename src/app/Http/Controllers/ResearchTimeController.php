<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Support\Facades\Auth;

class ResearchTimeController extends Controller
{
    /**
     * @param Time $time
     */
    public function __construct(Time $time)
    {
        $this->time = $time;
    }

    /**
     * 開始時間を登録
     *
     * @return void
     */
    public function storeStartTime()
    {
        $userId = Auth::id();
        $result = $this->time->storeTime($userId);
        if ($result) {
            return redirect('dashboard')->with('flash_message', '研究開始時間を打刻しました');
        } else {
            return redirect('dashboard')->with('flash_error_message', 'すでに開始しています');
        }
    }

    /**
     * 終了時間を登録
     */
    public function storeEndTime()
    {
        $userId = Auth::id();
        $result = $this->time->updateTime($userId);
        if ($result) {
            return redirect('dashboard')->with('flash_message', '研究終了時間を打刻しました');
        } else {
            return redirect('dashboard')->with('flash_error_message', 'まだ開始していません');
        }
    }
}
