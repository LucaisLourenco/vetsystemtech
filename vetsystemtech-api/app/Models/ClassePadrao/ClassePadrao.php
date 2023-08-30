<?php

namespace App\Models\ClassePadrao;

/**
 *
 */
class ClassePadrao extends \stdClass
{

    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $descricao;

    public function __construct()
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }


}
