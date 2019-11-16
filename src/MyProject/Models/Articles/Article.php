<?php
/**
 * Created by PhpStorm.
 * User: Nai
 * Date: 08.11.2019
 * Time: 23:00
 */

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Services\Db;

class Article extends ActiveRecordEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $text;

    /** @var string */
    protected $authorId;

    /** @var string */
    protected $createdAt;

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'articles';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return (int) $this->authorId;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function setId(int $id): Article
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return Article
     */
    public function setCreatedAt(string $createdAt): Article
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param string $name
     * @return Article
     */
    public function setName(string $name): Article
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $text
     * @return Article
     */
    public function setText(string $text): Article
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param string $authorId
     * @return Article
     */
    public function setAuthorId(string $authorId): Article
    {
        $this->authorId = $authorId;
        return $this;
    }

    /**
     * @param string $authorId
     * @return Article
     */
    public function setAuthor(User $author): Article
    {
        $this->authorId = $author->getId();
        return $this;
    }
}