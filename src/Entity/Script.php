<?php

declare(strict_types=1);

namespace FiftyDeg\SyliusScriptsPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\TranslatableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="fiftydeg_scripts_script")
 */
class Script implements ScriptInterface
{
    /**
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
     * @ORM\Column(type="integer")
     */
    protected int $id;

    use TranslatableTrait;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): ScriptTranslationInterface
    {
        return new ScriptTranslation();
    }
}
