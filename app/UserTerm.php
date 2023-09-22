<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserTerm
 *
 * @property int $id
 * @property int $user_id
 * @property int $term_condition_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserTerm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTerm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTerm query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTerm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTerm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTerm whereTermConditionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTerm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTerm whereUserId($value)
 * @mixin \Eloquent
 */
class UserTerm extends Model
{
    //
}
