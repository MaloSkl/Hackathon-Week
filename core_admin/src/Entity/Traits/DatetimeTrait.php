<?php

namespace App\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait DatetimeTrait
{
    #[ORM\Column(name: "created_at", type: "datetime", options: ["default" => "CURRENT_TIMESTAMP"])]
    protected DateTime $createdAt;

    #[ORM\Column(name: "updated_at", type: "datetime", options: ["default" => "CURRENT_TIMESTAMP"])]
    protected DateTime $updatedAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}