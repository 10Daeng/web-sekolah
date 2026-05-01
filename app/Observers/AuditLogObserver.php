<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Models\Registration;
use App\Models\Student;
use App\Models\Post;

class AuditLogObserver
{
    public function created($model): void
    {
        AuditLog::log('create', $model, 'Data baru dibuat: ' . $model->name ?? $model->title ?? '#'.$model->id);
    }

    public function updated($model): void
    {
        $changes = $model->getChanges();
        unset($changes['updated_at']);
        
        if (!empty($changes)) {
            AuditLog::log(
                'update', 
                $model, 
                'Data diperbarui: ' . ($model->name ?? $model->title ?? '#'.$model->id),
                array_intersect_key($model->getOriginal(), $changes),
                $changes
            );
        }
    }

    public function deleted($model): void
    {
        AuditLog::log('delete', $model, 'Data dihapus: ' . ($model->name ?? $model->title ?? '#'.$model->id));
    }
}
