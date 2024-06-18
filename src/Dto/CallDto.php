<?php

namespace App\Dto;

class CallDto
{

    /**
     * @param string $from
     * @param string $to
     */
    public function __construct(
        protected string $from = '',
        protected string $to = '',
    )
    {
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $from
     * @return $this
     */
    public function setFrom(string $from): self
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return $this
     */
    public function setTo(string $to): self
    {
        $this->to = $to;
        return $this;
    }
}