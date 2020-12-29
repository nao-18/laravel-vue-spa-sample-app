<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * Class Photo
 * @package App
 * @method static where(string $string, string $id)
 */
class Photo extends Model
{
    /** プライマリキーの型 */
    protected $keyType = 'string';

    /** IDの桁数 */
    const ID_LENGTH = 12;

    /** JSONに含める属性 */
    protected $appends = [
        'url',
    ];

    /** JSONに含める属性 */
    protected $visible = [
        'id', 'owner', 'url',
    ];

    protected $perPage = 10; // この値を少なくすれば動作確認しやすいですね

    /**
     * リレーションシップ - usersテーブル
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }

    /**
     * Photo constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (! Arr::get($this->attributes, 'id')) {
            $this->setId();
        }
    }

    /**
     * ランダムなID血をid属性に代入する
     */
    private function setId()
    {
        $this->attributes['id'] = $this->getRandomId();
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getRandomId()
    {
        $characters = array_merge(
            range(0, 9), range('a', 'z'),
            range('A', 'Z', ['-', '_'])
        );
        $length = count($characters);
        $id = "";
        for ($i = 0; $i < self::ID_LENGTH; $i++) {
            $id .= $characters[random_int(0, $length - 1)];
        }
        return $id;
    }

    /**
     * アクセサ - url
     * @return string
     */
    public function getUrlAttribute()
    {
        return Storage::cloud()->url($this->attributes['filename']);
    }
}
