<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
        'size'
    ];

    /**
     * Get the owner (user) of the file
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Upload file to specific folder
     *
     * @param UploadedFile $file
     * @param $folder
     * @return static
     */
    public static function upload(UploadedFile $file, $folder)
    {
        $model = static::create([
            'name' => $file->getClientOriginalName(),
            'size' => $file->getSize()
        ]);

        Storage::put(
            $path = sprintf('%s/%s', $folder, $model->id),
            file_get_contents($file->getRealPath())
        );

        $model->path = storage_path(sprintf('app/%s', $path));
        $model->save();

        return $model;
    }

    /**
     * Delete file in storage and its data
     *
     * @return static
     */
    public function delete()
    {
        $path = str_replace(storage_path('app'), '', $this->path);

        Storage::delete($path);

        return parent::delete();
    }

    /**
     * Get total files size
     *
     * @return mixed
     */
    public static function total()
    {
        return static::sum('size');
    }

    /**
     * Generate url download for the file
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function url()
    {
        return route('files.show', $this->id);
    }
}
