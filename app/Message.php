<?php

namespace App;

use App\Filters\HtmlAttributeFilter;
use App\Filters\ProfanityFilter;
use App\Filters\RemoveTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Carbon;

/**
 * Class Message
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property int $from
 * @property int $to
 * @property string $message
 * @property string $sender_ip
 * @property int $read
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static Builder|Message onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSenderIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static Builder|Message withTrashed()
 * @method static Builder|Message withoutTrashed()
 */
class Message extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Set message attribute
     *
     * @param string $value
     *
     * @return void
     */
    public function setMessageAttribute(string $value)
    {
        // pipeline for filtering message
        $value = html_entity_decode($value);
        $value = app(Pipeline::class)
            ->send($value)
            ->through([
                HtmlAttributeFilter::class,
                ProfanityFilter::class,
                RemoveTags::class,
            ])
            ->thenReturn();
        $value = trim($value);

        // replace value
        $this->attributes['message'] = $value;
    }
}
