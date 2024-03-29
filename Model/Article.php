<?php

declare(strict_types=1);

class Article
{
    public int $id;
    public string $title;
    public ?string $description;
    public ?string $publishDate;
    private ?string $imageUrl;

    public function __construct(int $id, string $title, ?string $description, ?string $publishDate, string $imageUrl = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->publishDate = $publishDate;
        $this->imageUrl = $imageUrl;
    }

    public function formatPublishDate($format = 'd-m-Y')
    {
        // return the date in the required format
        if ($this->publishDate === null) {
            return '';
        }

        $dateTime = new DateTime($this->publishDate);
        return $dateTime->format($format);
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

     public function getId(): int
    {
        return $this->id; // Replace with the actual property representing the article ID
    }
}