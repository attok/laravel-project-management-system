<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/***
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $startDate
 * @property string|null $endDate
 */
class Project extends Model
{
    use HasFactory;

    const STATUS_OPEN = 0;
    const STATUS_ONPROGRESS = 1;
    const STATUS_DONE = 2;

    public static function getStatusList()
    {
        return [
            self::STATUS_OPEN => 'Open',
            self::STATUS_ONPROGRESS => 'On Progress',
            self::STATUS_DONE => 'Done'
        ];
    }

    public function getStatusString()
    {
        return @self::getStatusList()[$this->status];
    }

    /**
     * Get the comments for the blog post.
     */
    public function projectTasks()
    {
        return $this->hasMany(ProjectTask::class);
    }
}
