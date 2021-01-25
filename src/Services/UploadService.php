<?php


namespace App\Services;


use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadService
{
    /**
     * @var string $targetDirectory
     */
    private $targetDirectory;
    /**
     * @var SluggerInterface $slugger
     */
    private $slugger;
    /**
     * @var Filesystem $fileSystem
     */
    private $fileSystem;

    /**
     * UploadService constructor.
     * @param $targetDirectory
     * @param SluggerInterface $slugger
     * @param Filesystem $fileSystem
     */
    public function __construct($targetDirectory, SluggerInterface $slugger, Filesystem $fileSystem)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
        $this->fileSystem = $fileSystem;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        $safeFilenam = $this->slugger->slug($originalFilename);
        $fileName = $safeFilenam.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(),$fileName);
        }
        catch (FileException $exception)
        {
           throw new Exception('No file to upload',404);
        }
        return $fileName;
    }

    /**
     * @param $path
     */
    public function removeFile($path)
    {
        $file = substr($path,54);
        $target = "C:/xampp/htdocs/GamesSite/BackEnd/public/Images/".$file;
        $this->fileSystem->remove([$target]);

    }
    /**
     * @return string
     */
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
