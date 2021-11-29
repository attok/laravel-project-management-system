<?php

namespace App\Models;

use App\Models\Interface\Model as InterfaceModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/***
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $startDate
 * @property string|null $endDate
 */
class Project extends Model implements InterfaceModel
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

    public function validate($request, $errorRedirectUrl)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'startDate' => 'date|required',
            'endDate' => 'date',
            'status' => Rule::in(array_keys(Project::getStatusList()))
        ], [
            'max' => 'max panjang 255 karakter.',
            'required' => 'Field :attribute tidak boleh kosong.',
            'date' => 'format tanggal tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect($errorRedirectUrl)
                ->withErrors($validator)
                ->withInput();
        }

        return $validator->validated();
    }

    public function loadData($validated)
    {
        $this->name = $validated['name'];
        $this->description = $validated['description'];
        $this->startDate = $validated['startDate'];
        $this->endDate = $validated['endDate'];
        $this->status = $validated['status'];
    }

    /**
     * Get the comments for the blog post.
     */
    public function projectTasks()
    {
        return $this->hasMany(ProjectTask::class);
    }
}
