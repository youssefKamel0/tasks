<?php


namespace App\Requests;

class Media {

    private $file;

    private $newImageName;

    /**
     * Set the value of file
     */
    public function setFile(array $file): self
    {
        $this->file = $file;

        return $this;
    }


    public function upload($path) {

        $this->newImageName = uniqid() . '.' . $this->getExtension();
        return move_uploaded_file($this->file['tmp_name'], $path . $this->newImageName);

        
    }
    public function delete($path) {

        if (file_exists($path)) {

            return unlink($path);
        }

        return false;


    }

    public function getExtension() {

        return explode('/' ,$this->file['type'])[1];



    }







    /**
     * Get the value of newImageName
     */
    public function getNewImageName()
    {
        return $this->newImageName;
    }

    /**
     * Set the value of newImageName
     */
    public function setNewImageName($newImageName): self
    {
        $this->newImageName = $newImageName;

        return $this;
    }
}
