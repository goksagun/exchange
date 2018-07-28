<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Exchange
 *
 * @ORM\Table(name="exchange", uniqueConstraints={@UniqueConstraint(name="search_idx", columns={"provider", "code"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExchangeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Exchange implements TimestampsInterface
{
    use TimestampsTrait;

    const CURRENCY_SYMBOLS = [
        'GBPTRY' => '£',
        'USDTRY' => '$',
        'EURTRY' => '€',
    ];

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="provider", type="string", length=255)
     */
    private $provider;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="rate", type="decimal", precision=10, scale=4)
     */
    private $rate;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Exchange
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get provider
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set provider
     *
     * @param string $provider
     *
     * @return Exchange
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set rate
     *
     * @param string $rate
     *
     * @return Exchange
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->id;
    }
}

