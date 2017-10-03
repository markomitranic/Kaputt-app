<?php

namespace Model;

class InstaPost
{
    /**
     * @var string
     */
    private $imageUrl;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $id;

    /**
     * InstaPost constructor.
     * @param array $post
     */
    public function __construct(array $post)
    {
        $this->setImage($post['image']);
        $this->setCode($post['code']);
        $this->setLink($post['link']);
        $this->setId($post['id']);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'image' => $this->getImage(),
            'code'  => $this->getCode(),
            'link'  => $this->getLink(),
            'id'    =>$this->getId()
        ];
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImage(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

}
