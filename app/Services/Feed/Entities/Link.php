<?php

namespace App\Services\Feed\Entities;

class Link
{
    protected string $id;

    protected string $title;

    protected string $content;

    protected string $url;

    protected string $publishedAt;

    protected ?string $image = null;

    public function setId(string $value): self
    {
        $this->id = $value;

        return $this;
    }

    public function setTitle(string $value): self
    {
        $this->title = $value;

        return $this;
    }

    public function setContent(string $value): self
    {
        $this->content = $value;

        return $this;
    }

    public function setUrl(string $value): self
    {
        $this->url = $value;

        return $this;
    }

    public function setPublishedAt(string $value): self
    {
        $this->publishedAt = $value;

        return $this;
    }

    public function setImage(?string $value): self
    {
        $this->image = null !== $value ? $value : '';

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPublishedAt(): string
    {
        return $this->publishedAt;
    }

    public function getImage(): ?string
    {
        return $this->image ?: null;
    }
}
