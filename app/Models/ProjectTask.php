<?php

namespace App\Models;

use App\Models\Interface\Model as InterfaceModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 *
 * @property string $title
 * @property stirng|null $description
 * @property int $project_id
 * @property int $status
 */
class ProjectTask extends Model implements InterfaceModel
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
            'title' => 'required|max:255',
            'description' => 'string',
            'status' => Rule::in(array_keys(ProjectTask::getStatusList()))
        ], [
            'max' => 'max panjang 255 karakter.',
            'required' => 'Field :attribute tidak boleh kosong.',
            'in' => 'Tidak valid',
            'string' => 'Tidak valid',
        ]);


        if ($validator->fails()) {
            return redirect($errorRedirectUrl)
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        return $validator->validated();
    }

    public function loadData($validated)
    {
        $this->title = $validated['title'];
        $this->description = $validated['description'];
        $this->status = $validated['status'];
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
