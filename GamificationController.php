<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Member;
use App\Models\Challenge;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Auth;
class GamificationController extends Controller
{
    public function getLeaderboard(){

        $response = Http::post('http://api.tenenet.net/getLeaderboard?token=79ee4fb9f158e60ba55674ecb8ed249a&id=alpha_leaderboard');
        $leaderboardLength = sizeof($response['message']['data']) < 10 ? sizeof($response['message']['data']) : 10;
        $playerScoreList = array();
        $playerNameList = array();
        for($i = 0 ; $i < $leaderboardLength ; $i++){
            $playerInfo = Http::post('http://api.tenenet.net/getPlayer?token=79ee4fb9f158e60ba55674ecb8ed249a&alias='.$response['message']['data'][$i]['alias']);
            //Push the badge point
            $playerName = User::where('email', $response['message']['data'][$i]['alias'])->get()->first()->name;
            array_push($playerNameList, $playerName);
            array_push($playerScoreList, $playerInfo['message']['score'][1]['value']); 
        }
        $user = Auth::user();
        $challenge = Challenge::where('user_email', $user->email)->first();
        if(!$challenge->open_leaderboard){
            $challenge->open_leaderboard = true;
            Http::post('api.tenenet.net/insertPlayerActivity?token=79ee4fb9f158e60ba55674ecb8ed249a&alias='.$user->email.'&id=alpha_badge_point&operator=add&value=5');
            Http::post('api.tenenet.net/insertPlayerActivity?token=79ee4fb9f158e60ba55674ecb8ed249a&alias='.$user->email.'&id=alpha_reward&operator=add&value=5'); 
            $challenge->save();
        }
        
        return view('gamification/ranking_dashboard', ['nameList' => $playerNameList, 'scoreList' => $playerScoreList]);
    }
    public function rewardInfo(){
        $user = Auth::user();
        $playerInfo = Http::post('http://api.tenenet.net/getPlayer?token=79ee4fb9f158e60ba55674ecb8ed249a&alias='.$user->email);
        $rewardScore =  $playerInfo['message']['score'][2]['value'];
        return view('gamification/reward', ["user" => $user, "rewardPoint" => $rewardScore]);
    }
    public function achievementInfo(){
        $nowDate = date("Y-m-d");
        $nowTime = date("H:i:s");
        $user = Auth::user();
        $pastEventsCount = Member::join('events', 'events.Event_id', '=', 'members.Event_id')
                    ->select('members.*', 'events.*')
                    ->where('members.Member_id',auth()->user()->id)
                    ->where("Event_EndDate", "<", $nowDate)
                    ->orWhere([["events.Event_EndDate", $nowDate],["events.Event_EndTime", "<", $nowTime]])
                    ->count();
        $score = 0;
        if($user->login_days >= 100){
            $score += 25;
        }
        if($user->create_event_count >= 100 ){
            $score += 25;
        }
        if($pastEventsCount >= 100){
            $score += 25;
        }
        if($user->invitation_count >= 1000){
            $score += 25;
        }
        return view('gamification/achievement', ["user"=>$user, "finish_event"=>$pastEventsCount, "score" => $score]);
    }
    public function challengeInfo(){
        $user = Auth::user();
        $challenge = Challenge::where("user_email", $user->email)->first();
        return view('gamification/challenge', ['challenge' => $challenge]);
    }
    public function exchangeReward($id){
        $user = Auth::user();
        $playerInfo = Http::post('http://api.tenenet.net/getPlayer?token=79ee4fb9f158e60ba55674ecb8ed249a&alias='.$user->email);
        $rewardScore =  $playerInfo['message']['score'][2]['value'];
        if($id == 1){
            if($rewardScore < 1000){
                return redirect('gamification/reward')->with("message", "Reward point is not enough.");
            }
            Http::post('api.tenenet.net/insertPlayerActivity?token=79ee4fb9f158e60ba55674ecb8ed249a&alias='.$user->email.'&id=alpha_reward&operator=remove&value=1000'); 
        }else if($id == 2){
            if($rewardScore < 1500){
                return redirect('gamification/reward')->with("message", "Reward point is not enough.");
            }
            Http::post('api.tenenet.net/insertPlayerActivity?token=79ee4fb9f158e60ba55674ecb8ed249a&alias='.$user->email.'&id=alpha_reward&operator=remove&value=1500');
        }else{
            if($rewardScore < 3000){
                return redirect('gamification/reward')->with("message", "Reward point is not enough.");
            }
            Http::post('api.tenenet.net/insertPlayerActivity?token=79ee4fb9f158e60ba55674ecb8ed249a&alias='.$user->email.'&id=alpha_reward&operator=remove&value=3000');
        }
        $user->invitation_card_amount++;
        $user->save();
        return view('gamification/reward', ["user" => $user, "rewardPoint" => $rewardScore]);
    }
}
