<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use Illuminate\Notifications\Action;
use Livewire\Component;

class TodoLists extends Component
{
    public $body, $activities, $countActivities;

    public function render()
    {
        $this->activities = Activity::orderBy('position', 'asc')->get();
        $this->countActivities = Activity::count();
        return view('livewire.todo-lists');
    }

    public function updateTaskOrder($activities)
    {
        foreach ($activities as $activity) {
            Activity::where('id', $activity['value'])->update(['position' => $activity['order']]);
        }
    }

    public function submit()
    {
        $this->validate([
            'body' => 'required'
        ]);

        Activity::create([
            'position' => $this->countActivities++,
            'body' => $this->body
        ]);

        $this->body = NULL;
    }

    public function delete($id)
    {
        $activity = Activity::find($id);
        $activity->delete();
    }

    public function deleteAll()
    {
        Activity::truncate();
    }

    public function done($id)
    {
        $activity = Activity::find($id);
        $activity->update([
            'is_done' => true
        ]);
    }
}
