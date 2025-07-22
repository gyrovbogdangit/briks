<?php

namespace App\Helpers;

class Seo
{
    public $title;
    public $description;

    public $ogTitle;
    public $ogDescription;
    public $ogImage;
    public $ogUrl;
    public $ogType;
    public $ogSiteName;

    /**
     * Create a new class instance.
     *
     * @param string $title
     * @param string $description
     * @param string $ogTitle
     * @param string $ogDescription
     * @param string $ogImage
     * @param string $ogUrl
     * @param string $ogType
     * @param string|null $ogSiteName
     */
    public function __construct(
        string $title,
        string $description,
        string $ogTitle,
        string $ogDescription,
        string $ogImage,
        string $ogUrl,
        string $ogType,
        string $ogSiteName = 'БРИКС'
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->ogTitle = $ogTitle;
        $this->ogDescription = $ogDescription;
        $this->ogImage = $ogImage;
        $this->ogUrl = $ogUrl;
        $this->ogType = $ogType;
        $this->ogSiteName = $ogSiteName;
    }
}
