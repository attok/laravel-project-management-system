<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property string $title
 * @property stirng|null $description
 * @property int $project_id
 * @property int $status
 */
class ProjectTask extends Model
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

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
