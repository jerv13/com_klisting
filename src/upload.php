<?php

class KListingUploadHandler
{
    const DEFAULT_MODE = 0655;
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function handle($data)
    {
        $this->config;
        echo $this->createListingFolder(
            $this->config['directoryListings'],
            $data['name'],
            $data['date']
        );
    }

    /**
     * @param $filePathInputImage
     * @param $filePathOutputImage
     * @param int $width
     * @param int $height
     * @return Imagick
     * @throws ImagickException
     */
    protected function imageResize($filePathInputImage, $filePathOutputImage, $width = 1024, $height = 768)
    {
        $image = new Imagick();
        $image->setColorspace(Imagick::COLORSPACE_RGB);
        //$image->setBackgroundColor(new ImagickPixel('rgb(255, 255, 255)'));
        //$image->setResolution(300,300);
        $image->readImage($filePathInputImage);
        $image->setImageAlphaChannel(Imagick::VIRTUALPIXELMETHOD_WHITE);
        $image->scaleImage($width, $height, true, true);
        $image->setImageFormat('jpeg');
        $image->writeImage($filePathOutputImage);

        return $image;
    }

    /**
     * @param $name
     * @return null|string|string[]
     */
    protected function nameToUrlName(
        $name
    ) {
        // Lower case everything
        $name = strtolower($name);
        // Make alphanumeric (removes all other characters)
        $name = preg_replace("/[^a-z0-9_\s-]/", "", $name);
        //Clean up multiple dashes or whitespaces
        $name = preg_replace("/[\s-]+/", " ", $name);
        //Convert whitespaces and underscore to dash
        return preg_replace("/[\s_]/", "-", $name);
    }

    /**
     * @param string $directoryListings
     * @param string $name
     * @param string $date
     * @param number $mode
     * @param int $mode
     * @return string
     */
    protected function createListingFolder(
        $directoryListings,
        $name,
        $date,
        $mode = self::DEFAULT_MODE
    ) {
        $name = $this->nameToUrlName($name);
        $directoryListing = $directoryListings . $date . '--' . $name;

        return $this->createFolderUnique($directoryListing, 0, $mode);
    }

    protected function createFolderUnique(
        $directory,
        $number = 0,
        $mode = self::DEFAULT_MODE
    ) {
        if (!is_dir($directory)) {
            mkdir($directory, $mode);
            return $directory;
        }

        $last = str_replace('.', '', strrchr($directory, '.'));

        if (is_numeric($last)) {
            $number = (int)$last;
            $len = strlen($last) + 1;
            $directory = substr_replace($directory, '', -$len, $len);
        } else {
            $number++;
            $directory = $directory . '.' . $number;
        }

        // must check each number iteration
        return $this->createFolderUnique(
            $directory,
            $number,
            $mode
        );
    }

    /**
     * @param $directoryUploads
     */
    protected function createResizeImages($directoryUploads)
    {
        $number = 1;

    }

    /**
     * @param $filePathPdf
     * @param array $filePathsImages
     * @param $directoryUploads
     * @param $directoryListing
     * @param array $imageSizes
     * @param int $mode
     */
    protected function createImages(
        $filePathPdf,
        array $filePathsImages,
        $directoryUploads,
        $directoryListing,
        array $imageSizes,
        $mode = self::DEFAULT_MODE
    ) {
        foreach ($imageSizes as $imageSize) {
            $directoryListingImages = $directoryListing . DIRECTORY_SEPARATOR . $imageSize['folder'];
            mkdir($directoryListingImages, $mode);
            $images = glob("" . $directoryListingImages . "{*.jpg,*.gif,*.png}", GLOB_BRACE);
        }
    }
}


$data = [
    'uploadId' => 'test',
    'categoryId' => 0, // article category
    'title' => 'test Title', // article title
    'name' => 'test some !!!name',
    'date' => 'Y-m-d', // ordering
    'pdf' => '', // file
    'images' => [],
];

$config = [
    'directoryUploads'
    => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
        . 'data' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR,
    'directoryListings'
    => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
        . 'data' . DIRECTORY_SEPARATOR . 'listing' . DIRECTORY_SEPARATOR,
    'imageSizes' => [
        [
            'folder' => 'large',
            'height' => 1024,
            'width' => 768,
        ],
        [
            'folder' => 'small',
            'height' => 160,
            'width' => 120,
        ],
    ],
];

//$filePathInputImage = realpath($config['directoryUpload'] . 'input2.pdf') . '[0]';
//$filePathOutputImage = $config['directoryListings'] . 'output.jpg';
//$filePathOutputImageLarge = __DIR__ . DIRECTORY_SEPARATOR . 'large.jpg';
//$filePathOutputImageSmall = __DIR__ . DIRECTORY_SEPARATOR . 'small.jpg';
//echo $filePathInputImage . "\n\n";

$handler = new KListingUploadHandler($config);

$handler->handle($data);

//imageResize(
//    $filePathInputImage,
//    $filePathOutputImage,
//    530,
//    800
//);
//
//imageResize(
//    $filePathOutputImage,
//    $filePathOutputImageLarge,
//    1024,
//    768
//);
//
//imageResize(
//    $filePathOutputImage,
//    $filePathOutputImageSmall,
//    160,
//    120
//);