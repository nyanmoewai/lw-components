<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Account extends Model
{
    public function filterResult(string $value, int $limit, int $offset): array
    {
        return self::query()
        ->where('reference_number', 'LIKE', "{$value}%")
        ->limit($limit)
        ->offset($offset)
        ->get()
        ->mapWithKeys(function($account, $key) {
            return [$account->id => $account->reference_number];
        })
        ->toArray();
    }
}
