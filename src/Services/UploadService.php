<?php


namespace App\Services;


use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
     * UploadService constructor.
     * @param $targetDirectory
     * @param SluggerInterface $slugger
     */
    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

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

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
