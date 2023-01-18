<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use App\Models\LikeCounter as LikeCounterTable;
use Illuminate\Support\Facades\Session;

class LikeCounter extends Component
{
    public $entry;
    public $apply;
    public $phone;

    public function call()
    {
        $res = LikeCounterTable::where('phone', '=', $this->phone)->get()->toArray();
        if (!empty($res)) { dd('Вы уже голосовали.'); } // Exception

        if (empty($this->phone)) { dd('Empty phone'); } // Exception

        $publicKey = 'mMMSurl9x15tyy7hSbGKGgFPUdCDHJo5';
        $guzzle = new Client(['base_uri' => 'https://api.ucaller.ru']);

        $raw_response = $guzzle->post('/v1.0/initCall', [
            'headers' => [
                'Authorization' => 'Bearer ' . $publicKey. '.655655',
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'phone' => (int)$this->phone
            ],
        ]);

        $response = $raw_response->getBody()->getContents();
        $data = json_decode($response);
        Session::put('like_code', $data->code);
        return $data->code;
    }

    public function like()
    {
        if (empty(Session::get('like_code'))) { dd('Вы уже голосовали.'); }

        if ($this->apply == Session::get('like_code')) {
            LikeCounterTable::create([
                'entry_id' => $this->entry->id,
                'phone' => $this->phone,
                'status' => 1,
                'data' => ''
            ]);
        }
    }

    public function mount($entry)
    {
        $this->entry = $entry;
    }

    public function render()
    {
        return view('livewire.like-counter');
    }
}
