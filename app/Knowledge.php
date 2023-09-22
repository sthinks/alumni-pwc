<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Knowledge
 *
 * @property int $id
 * @property string $knowledge_title
 * @property string $knowledge_abstract
 * @property string $knowledge_seo_url
 * @property string $knowledge_text
 * @property string $knowledge_poster
 * @property string|null $knowledge_file
 * @property string|null $knowledge_embed
 * @property int $knowledge_edit_by
 * @property int $knowledge_visible
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $knowledge_featured
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Collection|array<Gallery> $files
 * @property-read int|null $files_count
 * @method static Builder|Knowledge active()
 * @method static Builder|Knowledge featured(bool $isFeatured = true)
 * @method static Builder|Knowledge findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static Builder|Knowledge newModelQuery()
 * @method static Builder|Knowledge newQuery()
 * @method static Builder|Knowledge query()
 * @method static Builder|Knowledge whereCreatedAt($value)
 * @method static Builder|Knowledge whereId($value)
 * @method static Builder|Knowledge whereKnowledgeAbstract($value)
 * @method static Builder|Knowledge whereKnowledgeEditBy($value)
 * @method static Builder|Knowledge whereKnowledgeEmbed($value)
 * @method static Builder|Knowledge whereKnowledgeFeatured($value)
 * @method static Builder|Knowledge whereKnowledgeFile($value)
 * @method static Builder|Knowledge whereKnowledgePoster($value)
 * @method static Builder|Knowledge whereKnowledgeSeoUrl($value)
 * @method static Builder|Knowledge whereKnowledgeText($value)
 * @method static Builder|Knowledge whereKnowledgeTitle($value)
 * @method static Builder|Knowledge whereKnowledgeVisible($value)
 * @method static Builder|Knowledge whereUpdatedAt($value)
 * @mixin Builder
 */
class Knowledge extends Model
{
    use LogsActivity;
    use Sluggable;

    protected static bool $logUnguarded = true;

    protected $guarded = [];

    /**
     * Get active knowledge
     */
    public function scopeActive($query)
    {
        return $query->where('knowledge_visible', true);
    }

    /**
     * Get active knowledge
     *
     * @param $query
     * @param bool $isFeatured
     *
     * @return mixed
     */
    public function scopeFeatured($query, bool $isFeatured = true)
    {
        return $query->where('knowledge_featured', $isFeatured);
    }

    /**
     * A media can have many files
     *
     * @return MorphMany
     */
    public function files(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'galleryable');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'knowledge_seo_url' => [
                'source' => 'knowledge_title',
            ],
        ];
    }
}
