<?php

namespace App\Handlers;

use Image;

class ImageUploadHandler
{
    /**
     * Allow upload file types.
     *
     * @var array
     */
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    /**
     * Save upload file to the server.
     *
     * @param  object  $file
     * @param  string  $folder
     * @param  string  $file_prefix
     * @param  string  $max_width
     * @return array
     */
    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        /**
         * Set upload file's folder path.
         * e.g. uploads/images/avatars/201709/21/
         *
         * @var string
         */
        $upload_path = "uploads/images/$folder/" . date("Ym", time()) . '/'.date("d", time()).'/';
        
        /**
         * Set upload file's physical path. 
         * e.g. /home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
         *
         * @var string
         */
        $physical_path = public_path() . '/' . $upload_path;

        /**
         * Set a default extension.
         * 
         * @var string
         */
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        /**
         * Set a new filename. Prefiex could be a model's id.
         * e.g. 1_1493521050_7BVc9v9ujP.png
         * 
         * @var string
         */
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        // Only pictures could be uploaded.
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // Move file to the server's physical folder
        $file->move($physical_path, $filename);

        // Tailor the avatar
        if ($max_width && $extension != 'gif') {
            $this->reduceSize($physical_path . '/' . $filename, $max_width);
        }

        // Return upload file's uri.
        return [
            'path' => config('app.url') . "/$upload_path/$filename"
        ];
    }

    /**
     * Cut the image into custom size.
     *
     * @param  string  $file_path
     * @param  string  $max_width
     * @return void
     */
    public function reduceSize($file_path, $max_width)
    {
        $image = Image::make($file_path);

        $image->resize($max_width, null, function($constraint) {

            // Set the constraint for image's height and width
            $constraint->aspectRatio();

            // Cut into smaller size 
            $constraint->upsize();
        });

        $image->save();
    }
}