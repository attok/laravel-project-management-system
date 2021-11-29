<?php

namespace App\View\Components;

use App\Models\Project;
use Illuminate\View\Component;

class StatusProject extends Component
{
    public $status;

    public $class;

    public $text;


    public function __construct($status)
    {
        $this->status = $status;
        switch ($this->status) {
            case Project::STATUS_DONE:
                $this->class = 'bg-green-500';
                $this->text = 'Done';
                break;
            case Project::STATUS_ONPROGRESS:
                $this->class = 'bg-blue-500';
                $this->text = 'On Progress';
                break;
            default:
                $this->class = 'bg-gray-500';
                $this->text = 'Open';
        }
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.status-project');
    }
}
