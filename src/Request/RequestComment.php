<?php

namespace JiraRestApi\Request;

/**
 * @deprecated Use ServiceDesk\Comment
 */
class RequestComment implements \JsonSerializable
{
    /** @var string */
    public $id;

    /** @var string */
    public $body;

    /** @var bool */
    public $public;

    /** @var Author */
    public $author;

    /** @var \DateTimeInterface The type is wrong, json mapper will simply create the current date and add some fields to it */
    public $created;

    /**
     * @param string $body
     *
     * @return $this
     */
    public function setBody(string $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param bool $public True for is public, false otherwise
     *
     * @return $this
     */
    public function setIsPublic(bool $public)
    {
        $this->public = $public;

        return $this;
    }

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this), function ($var) {
            return $var !== null;
        });
    }
}
