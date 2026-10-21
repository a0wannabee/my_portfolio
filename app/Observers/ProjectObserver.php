<?php

namespace App\Observers;

use App\Models\Project;
use Illuminate\Support\Facades\Log;

class ProjectObserver
{
    /**
     * Handle the Project "creating" event.
     */
    public function creating(Project $project): void
    {
        // Status default jika tidak diisi
        $project->status ??= 'draft';
    }

    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        Log::info("Project dibuat: #{$project->id} {$project->title}");
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        Log::info("Project diperbarui: #{$project->id}", $project->getChanges());
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        Log::info("Project dipindah ke trash: #{$project->id} {$project->title}");
    }

    /**
     * Handle the Project "restored" event.
     */
    public function restored(Project $project): void
    {
        Log::info("Project dipulihkan: #{$project->id} {$project->title}");
    }

    /**
     * Handle the Project "force deleted" event.
     */
    public function forceDeleted(Project $project): void
    {
        Log::info("Project dihapus permanen: #{$project->id} {$project->title}");
    }
}