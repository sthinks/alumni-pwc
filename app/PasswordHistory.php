<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\PasswordHistory
 *
 * @property int $id
 * @property int $user_id
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PasswordHistory newModelQuery()
 * @method static Builder|PasswordHistory newQuery()
 * @method static Builder|PasswordHistory query()
 * @method static Builder|PasswordHistory whereCreatedAt($value)
 * @method static Builder|PasswordHistory whereId($value)
 * @method static Builder|PasswordHistory wherePassword($value)
 * @method static Builder|PasswordHistory whereUpdatedAt($value)
 * @method static Builder|PasswordHistory whereUserId($value)
 * @mixin Builder
 */
class PasswordHistory extends Model
{
    protected $guarded = [];
}
