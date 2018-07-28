<?php

namespace AppBundle\Exchange\Adapter;

interface ProviderInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @param string $url
     */
    public function setUrl(string $url): void;

    /**
     * @param array $data
     * @return array
     */
    public function transform(array $data): array;
}